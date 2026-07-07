<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Vérifie que l'utilisateur est admin (appelé au début de chaque méthode).
     */
    private function verifierAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé à l\'administration.');
        }
    }

    /**
     * Dashboard : statistiques et données réelles.
     */
    public function dashboard()
    {
        $this->verifierAdmin();

        $stats = [
            'commandes'       => Commande::count(),
            'chiffreAffaires' => (float) Commande::sum('total'),
            'produits'        => Produit::count(),
            'clients'         => User::where('role', 'client')->count(),
        ];

        $produits = Produit::with('imagePrincipale')->orderBy('nom')->get();

        $commandes = Commande::with('user')
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'produits', 'commandes'));
    }

    /**
     * Formulaire d'ajout d'un produit.
     */
    public function creerProduit()
    {
        $this->verifierAdmin();

        $categories = Categorie::all();

        return view('admin.produit-form', ['produit' => null, 'categories' => $categories]);
    }

    /**
     * Enregistre un nouveau produit.
     */
    public function enregistrerProduit(Request $request)
    {
        $this->verifierAdmin();

        $donnees = $this->validerProduit($request);
        $donnees['slug'] = Str::slug($donnees['nom']);

        Produit::create($donnees);

        return redirect()->route('admin.dashboard')->with('succes', 'Produit ajouté avec succès.');
    }

    /**
     * Formulaire de modification d'un produit.
     */
    public function modifierProduit(Produit $produit)
    {
        $this->verifierAdmin();

        $categories = Categorie::all();

        return view('admin.produit-form', compact('produit', 'categories'));
    }

    /**
     * Met à jour un produit.
     */
    public function mettreAJourProduit(Request $request, Produit $produit)
    {
        $this->verifierAdmin();

        $donnees = $this->validerProduit($request);
        $donnees['slug'] = Str::slug($donnees['nom']);
        $donnees['disponible'] = $request->boolean('disponible');

        $produit->update($donnees);

        return redirect()->route('admin.dashboard')->with('succes', 'Produit modifié avec succès.');
    }

    /**
     * Supprime un produit.
     */
    public function supprimerProduit(Produit $produit)
    {
        $this->verifierAdmin();

        $produit->delete();

        return redirect()->route('admin.dashboard')->with('succes', 'Produit supprimé.');
    }

    /**
     * Règles de validation communes ajout/modification.
     */
    private function validerProduit(Request $request): array
    {
        return $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom'          => 'required|string|max:255',
            'description'  => 'nullable|string',
            'histoire'     => 'nullable|string',
            'prix'         => 'required|numeric|min:0',
            'matiere'      => 'nullable|string|max:255',
            'dimensions'   => 'nullable|string|max:255',
            'stock'        => 'required|integer|min:0',
        ], [
            'required' => 'Ce champ est obligatoire.',
            'numeric'  => 'Ce champ doit être un nombre.',
            'integer'  => 'Ce champ doit être un nombre entier.',
            'min'      => 'La valeur ne peut pas être négative.',
        ]);
    }
}
