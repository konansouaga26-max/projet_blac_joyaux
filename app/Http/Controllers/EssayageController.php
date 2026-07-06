<?php

namespace App\Http\Controllers;

use App\Models\StyleEssayage;

class EssayageController extends Controller
{
    /**
     * Page essayage virtuel : les styles viennent de la table styles_essayage.
     */
    public function index()
    {
        $styles = StyleEssayage::with('produit.couleurs')->orderBy('id')->get();

        // Données préparées pour le carrousel JavaScript
        $stylesJson = [];
        foreach ($styles as $style) {
            $couleurs = [];
            foreach ($style->produit->couleurs as $couleur) {
                $couleurs[] = ['nom' => $couleur->nom, 'hex' => $couleur->code_hex];
            }

            $stylesJson[] = [
                'nom'      => $style->nom,
                'image'    => asset($style->image_url),
                'produit'  => $style->produit->nom,
                'prix'     => number_format($style->produit->prix, 0, ',', ' ') . ' FCFA',
                'lien'     => route('produit.show', $style->produit->slug),
                'couleurs' => $couleurs,
            ];
        }

        return view('essayage', compact('styles', 'stylesJson'));
    }
}
