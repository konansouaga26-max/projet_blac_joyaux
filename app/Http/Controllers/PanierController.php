<?php

namespace App\Http\Controllers;

use App\Models\CodePromo;
use App\Models\Produit;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    private const FRAIS_LIVRAISON = 1000;

    public function index()
    {
        $panier = session('panier', []);
        $totaux = self::calculerTotaux($panier);

        return view('panier', array_merge(compact('panier'), $totaux));
    }

    public function ajouter(Request $request, string $slug)
    {
        $produit = Produit::with('imagePrincipale')->where('slug', $slug)->firstOrFail();

        $couleur = $request->input('couleur', '');
        $cle = $produit->id . '-' . $couleur;

        $panier = session('panier', []);

        if (isset($panier[$cle])) {
            $panier[$cle]['quantite']++;
        } else {
            $panier[$cle] = [
                'produit_id' => $produit->id,
                'slug'       => $produit->slug,
                'nom'        => $produit->nom,
                'prix'       => (float) $produit->prix,
                'couleur'    => $couleur,
                'image'      => $produit->imagePrincipale?->url ?? 'images/sac-hero.jpeg',
                'quantite'   => 1,
            ];
        }

        session(['panier' => $panier]);

        return redirect()->route('panier')->with('succes', $produit->nom . ' a été ajouté à votre panier.');
    }

    public function modifierQuantite(Request $request, string $cle)
    {
        $panier = session('panier', []);

        if (isset($panier[$cle])) {
            $panier[$cle]['quantite'] += (int) $request->input('delta', 0);
            if ($panier[$cle]['quantite'] < 1) {
                $panier[$cle]['quantite'] = 1;
            }
            session(['panier' => $panier]);
        }

        return redirect()->route('panier');
    }

    public function supprimer(string $cle)
    {
        $panier = session('panier', []);
        unset($panier[$cle]);
        session(['panier' => $panier]);

        return redirect()->route('panier');
    }

    public function appliquerCodePromo(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $codePromo = CodePromo::where('code', strtoupper(trim($request->code)))->first();

        if (! $codePromo || ! $codePromo->estValide()) {
            return redirect()->route('panier')->with('erreur', 'Ce code promo est invalide ou expiré.');
        }

        session(['code_promo' => $codePromo->code]);

        return redirect()->route('panier')->with('succes', 'Code ' . $codePromo->code . ' appliqué !');
    }

    public static function calculerTotaux(array $panier): array
    {
        $sousTotal = 0;
        foreach ($panier as $ligne) {
            $sousTotal += $ligne['prix'] * $ligne['quantite'];
        }

        $reduction = 0;
        $codeApplique = null;
        if (session('code_promo')) {
            $codePromo = CodePromo::where('code', session('code_promo'))->first();
            if ($codePromo && $codePromo->estValide()) {
                $codeApplique = $codePromo;
                $reduction = $codePromo->reduction_pct
                    ? round($sousTotal * $codePromo->reduction_pct / 100)
                    : (float) $codePromo->reduction_fixe;
            }
        }

        $fraisLivraison = count($panier) > 0 ? self::FRAIS_LIVRAISON : 0;
        $total = max(0, $sousTotal - $reduction + $fraisLivraison);

        return compact('sousTotal', 'reduction', 'codeApplique', 'fraisLivraison', 'total');
    }
}
