<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Page d'accueil : les 3 produits de la collection.
     */
    public function accueil()
    {
        $produits = Produit::with('imagePrincipale')
            ->where('disponible', true)
            ->orderBy('prix', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('produits'));
    }

    /**
     * Page boutique : tous les produits, filtrables par catégorie.
     */
    public function boutique(?string $categorieSlug = null)
    {
        $categories = Categorie::all();

        $query = Produit::with('imagePrincipale', 'categorie');

        $categorieActive = null;
        if ($categorieSlug) {
            $categorieActive = Categorie::where('slug', $categorieSlug)->firstOrFail();
            $query->where('categorie_id', $categorieActive->id);
        }

        if ($recherche = request('q')) {
            $query->where('nom', 'like', '%' . $recherche . '%');
        }

        $produits = $query->orderBy('id')->get();

        return view('boutique', compact('produits', 'categories', 'categorieActive'));
    }

    /**
     * Page détail d'un produit.
     */
    public function show(string $slug)
    {
        $produit = Produit::with('images', 'couleurs', 'avis.user', 'categorie')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('produit', compact('produit'));
    }

    /**
     * Suggestions de recherche en direct (JSON), avec image et prix.
     */
    public function rechercheSuggestions()
    {
        $terme = trim((string) request('q'));

        if ($terme === '') {
            return response()->json([]);
        }

        $produits = Produit::with('imagePrincipale', 'categorie')
            ->where('nom', 'like', '%' . $terme . '%')
            ->take(5)
            ->get()
            ->map(fn ($p) => [
                'nom'        => $p->nom,
                'prix'       => number_format($p->prix, 0, ',', ' ') . ' FCFA',
                'image'      => asset($p->imagePrincipale?->url ?? 'images/sac-hero.jpeg'),
                'lien'       => route('produit.show', $p->slug),
                'categorie'  => $p->categorie?->slug,
            ]);

        return response()->json($produits);
    }
}
