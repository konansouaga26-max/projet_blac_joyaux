<?php

namespace Database\Seeders;

use App\Models\Avis;
use App\Models\Categorie;
use App\Models\CodePromo;
use App\Models\Couleur;
use App\Models\ImageProduit;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Remplit la base avec les données réelles de Blac Joyaux :
     * catégories, couleurs, les 3 sacs de la collection Éclat d'Héritage,
     * un compte admin, un compte client de test et un code promo.
     */
    public function run(): void
    {
        // ------- Utilisateurs -------
        User::create([
            'name'      => 'Kouadio',
            'prenom'    => 'Manuela',
            'email'     => 'admin@blacjoyaux.ci',
            'telephone' => '+2250000000000',
            'role'      => 'admin',
            'password'  => Hash::make('admin1234'),
        ]);

        $client = User::create([
            'name'      => 'Kouadio',
            'prenom'    => 'Fatou',
            'email'     => 'fatou.kouadio@email.com',
            'telephone' => '+2250101010101',
            'role'      => 'client',
            'password'  => Hash::make('client1234'),
        ]);

        // ------- Catégories -------
        $sacsMain    = Categorie::create(['nom' => 'Sacs à main',    'slug' => 'sacs-a-main']);
        $sacsBureau  = Categorie::create(['nom' => 'Sacs de bureau', 'slug' => 'sacs-de-bureau']);

        // ------- Couleurs -------
        $beige  = Couleur::create(['nom' => 'Beige',  'code_hex' => '#C8A97E']);
        $marron = Couleur::create(['nom' => 'Marron', 'code_hex' => '#5C3A21']);
        $noir   = Couleur::create(['nom' => 'Noir',   'code_hex' => '#1A1A1A']);
        $bleu   = Couleur::create(['nom' => 'Bleu',   'code_hex' => '#1E3A8A']);

        // ------- Produits : collection Éclat d'Héritage -------
        $heritiere = Produit::create([
            'categorie_id' => $sacsBureau->id,
            'nom'          => "L'Héritière",
            'slug'         => 'l-heritiere',
            'description'  => "Inspiré de la nouvelle génération d'entrepreneures, L'Héritière est conçu pour transporter votre ordinateur et vos documents avec élégance et organisation.",
            'histoire'     => "Le sac de la lady boss élégante, à l'effigie de la poupée Joyaux de Bla.",
            'prix'         => 95000,
            'matiere'      => 'Cuir pleine fleur',
            'dimensions'   => '40 x 30 x 12 cm',
            'stock'        => 8,
            'disponible'   => true,
        ]);

        $elan = Produit::create([
            'categorie_id' => $sacsMain->id,
            'nom'          => "L'Élan",
            'slug'         => 'l-elan',
            'description'  => "L'élégance du quotidien : un sac adaptable qui vous suit du bureau aux sorties, avec la finesse de l'artisanat ivoirien.",
            'histoire'     => "Symbole du mouvement et de l'ambition de la femme moderne.",
            'prix'         => 75000,
            'matiere'      => 'Cuir grainé',
            'dimensions'   => '32 x 24 x 10 cm',
            'stock'        => 12,
            'disponible'   => true,
        ]);

        $promesse = Produit::create([
            'categorie_id' => $sacsMain->id,
            'nom'          => 'La Promesse',
            'slug'         => 'la-promesse',
            'description'  => "Intemporelle et chic, La Promesse accompagne chaque moment précieux de votre vie avec raffinement.",
            'histoire'     => "Un hommage à l'héritage transmis de mère en fille.",
            'prix'         => 55000,
            'matiere'      => 'Cuir lisse',
            'dimensions'   => '26 x 18 x 8 cm',
            'stock'        => 15,
            'disponible'   => true,
        ]);

        // ------- Couleurs disponibles par produit (avec stock par couleur) -------
        $heritiere->couleurs()->attach([
            $beige->id  => ['stock_couleur' => 3],
            $marron->id => ['stock_couleur' => 3],
            $noir->id   => ['stock_couleur' => 2],
        ]);
        $elan->couleurs()->attach([
            $beige->id  => ['stock_couleur' => 6],
            $marron->id => ['stock_couleur' => 6],
        ]);
        $promesse->couleurs()->attach([
            $marron->id => ['stock_couleur' => 5],
            $noir->id   => ['stock_couleur' => 5],
            $bleu->id   => ['stock_couleur' => 5],
        ]);

        // ------- Images (celles de public/images) -------
        ImageProduit::create(['produit_id' => $heritiere->id, 'url' => 'images/sac-heritiere.jpeg', 'principale' => true,  'ordre' => 1]);
        ImageProduit::create(['produit_id' => $heritiere->id, 'url' => 'images/sac-hero.jpeg',      'principale' => false, 'ordre' => 2]);
        ImageProduit::create(['produit_id' => $elan->id,      'url' => 'images/sac-elan.jpeg',      'principale' => true,  'ordre' => 1]);
        ImageProduit::create(['produit_id' => $promesse->id,  'url' => 'images/sac-promesse.jpeg',  'principale' => true,  'ordre' => 1]);

        // ------- Avis de test -------
        // ------- Styles d'essayage -------
        // ------- Styles d'essayage -------
        // ------- Styles d'essayage -------
        \App\Models\StyleEssayage::create(['produit_id' => $heritiere->id, 'nom' => 'Style chic',         'image_url' => 'images/sac-promesse.jpeg']);
        \App\Models\StyleEssayage::create(['produit_id' => $elan->id,      'nom' => 'Style minimaliste', 'image_url' => 'images/sac-elan.jpeg']);
        \App\Models\StyleEssayage::create(['produit_id' => $promesse->id,  'nom' => 'Style décontracté', 'image_url' => 'images/sac-heritiere.jpeg']);
        Avis::create(['user_id' => $client->id, 'produit_id' => $heritiere->id, 'note' => 5, 'commentaire' => 'Sublime, la qualité du cuir est incroyable !', 'created_at' => now()]);
        Avis::create(['user_id' => $client->id, 'produit_id' => $elan->id,      'note' => 4, 'commentaire' => 'Très beau sac, livraison rapide à Cocody.',    'created_at' => now()]);

        // ------- Code promo de test -------
        CodePromo::create([
            'code'            => 'BIENVENUE10',
            'reduction_pct'   => 10,
            'actif'           => true,
            'date_expiration' => now()->addMonths(6)->toDateString(),
        ]);
    }
}
