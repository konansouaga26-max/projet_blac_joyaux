<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Couleur;
use App\Models\LigneCommande;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Affiche le formulaire de validation de commande.
     */
    public function formulaire()
    {
        $panier = session('panier', []);

        // Panier vide → retour boutique
        if (empty($panier)) {
            return redirect()->route('boutique');
        }

        $totaux = PanierController::calculerTotaux($panier);

        return view('commande', array_merge(compact('panier'), $totaux));
    }

    /**
     * Enregistre la commande en base puis affiche la confirmation.
     */
    public function enregistrer(Request $request)
    {
        $panier = session('panier', []);

        if (empty($panier)) {
            return redirect()->route('boutique');
        }

        // Validation du formulaire
        $donnees = $request->validate([
            'nom_destinataire'    => 'required|string|max:255',
            'telephone_livraison' => 'required|string|max:20',
            'adresse_livraison'   => 'required|string|max:255',
            'ville_livraison'     => 'required|string|max:100',
            'mode_paiement'       => 'required|in:carte,mobile_money,livraison',
        ], [
            'required' => 'Ce champ est obligatoire.',
            'in'       => 'Mode de paiement invalide.',
        ]);

        $totaux = PanierController::calculerTotaux($panier);

        // Création de la commande
        // NB : user_id = 2 (client de test) tant que l'authentification
        // n'est pas branchée — ce sera auth()->id() à l'étape B7.
        $commande = Commande::create([
            'user_id'             => 2,
            'reference'           => Commande::genererReference(),
            'statut'              => 'en_attente',
            'total'               => $totaux['total'],
            'frais_livraison'     => $totaux['fraisLivraison'],
            'mode_paiement'       => $donnees['mode_paiement'],
            'mode_livraison'      => 'domicile',
            'nom_destinataire'    => $donnees['nom_destinataire'],
            'telephone_livraison' => $donnees['telephone_livraison'],
            'adresse_livraison'   => $donnees['adresse_livraison'],
            'ville_livraison'     => $donnees['ville_livraison'],
            'delai_livraison'     => 3,
        ]);

        // Lignes de commande + déduction du stock
        foreach ($panier as $ligne) {
            $couleur = $ligne['couleur']
                ? Couleur::where('nom', $ligne['couleur'])->first()
                : null;

            LigneCommande::create([
                'commande_id'   => $commande->id,
                'produit_id'    => $ligne['produit_id'],
                'couleur_id'    => $couleur?->id,
                'quantite'      => $ligne['quantite'],
                'prix_unitaire' => $ligne['prix'],
                'sous_total'    => $ligne['prix'] * $ligne['quantite'],
            ]);

            // Déduire le stock du produit
            Produit::where('id', $ligne['produit_id'])->decrement('stock', $ligne['quantite']);
        }

        // Lier le code promo si utilisé
        if ($totaux['codeApplique']) {
            $commande->codesPromo()->attach($totaux['codeApplique']->id, [
                'reduction_appliquee' => $totaux['reduction'],
            ]);
        }

        // Vider le panier
        session()->forget(['panier', 'code_promo']);

        return view('commande-confirmation', compact('commande'));
    }
}
