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
     * catégories, couleurs, les 3 sacs de la collection (Boïba, Métamorphose, Kôrô),
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
        $bureau      = Categorie::create(['nom' => 'Bureau',  'slug' => 'bureau']);
        $accessoires = Categorie::create(['nom' => 'Soirée',  'slug' => 'soiree']);
        $bandouliere = Categorie::create(['nom' => 'Voyage',  'slug' => 'voyage']);

        // ------- Couleurs -------
        $beige  = Couleur::create(['nom' => 'Beige',  'code_hex' => '#C8A97E']);
        $marron = Couleur::create(['nom' => 'Marron', 'code_hex' => '#5C3A21']);
        $noir   = Couleur::create(['nom' => 'Noir',   'code_hex' => '#1A1A1A']);
        $bleu   = Couleur::create(['nom' => 'Bleu',   'code_hex' => '#1E3A8A']);

        // ------- Produits : ordre imposé par la marque : Boïba, Métamorphose, Kôrô -------
        $boiba = Produit::create([
            'categorie_id' => $bureau->id,
            'nom'          => 'Boïba',
            'slug'         => 'boiba',
            'description'  => "Inspiré de la nouvelle génération d'entrepreneures, Boïba est conçu pour transporter votre ordinateur et vos documents avec élégance et organisation.",
            'histoire'     => "Le sac de la lady boss élégante, à l'effigie de la poupée Joyaux de Bla.",
            'prix'         => 56000,
            'matiere'      => 'Cuir pleine fleur',
            'dimensions'   => '40 x 30 x 12 cm',
            'stock'        => 8,
            'disponible'   => true,
        ]);

        $metamorphose = Produit::create([
            'categorie_id' => $accessoires->id,
            'nom'          => 'Métamorphose',
            'slug'         => 'metamorphose',
            'description'  => "Intemporelle et chic, Métamorphose accompagne chaque moment précieux de votre vie avec raffinement.",
            'histoire'     => "Un hommage à l'héritage transmis de mère en fille.",
            'prix'         => 35000,
            'matiere'      => 'Cuir lisse',
            'dimensions'   => '26 x 18 x 8 cm',
            'stock'        => 15,
            'disponible'   => true,
        ]);

        $koro = Produit::create([
            'categorie_id' => $bandouliere->id,
            'nom'          => 'Kôrô',
            'slug'         => 'koro',
            'description'  => "L'élégance du quotidien : un sac adaptable qui vous suit du bureau aux sorties, avec la finesse de l'artisanat ivoirien.",
            'histoire'     => "Symbole du mouvement et de l'ambition de la femme moderne.",
            'prix'         => 65000,
            'matiere'      => 'Cuir grainé',
            'dimensions'   => '32 x 24 x 10 cm',
            'stock'        => 12,
            'disponible'   => true,
        ]);

        // ------- Couleurs disponibles par produit (avec stock par couleur) -------
        $boiba->couleurs()->attach([
            $beige->id  => ['stock_couleur' => 3],
            $marron->id => ['stock_couleur' => 3],
            $noir->id   => ['stock_couleur' => 2],
        ]);
        $metamorphose->couleurs()->attach([
            $marron->id => ['stock_couleur' => 5],
            $noir->id   => ['stock_couleur' => 5],
            $bleu->id   => ['stock_couleur' => 5],
        ]);
        $koro->couleurs()->attach([
            $beige->id  => ['stock_couleur' => 6],
            $marron->id => ['stock_couleur' => 6],
        ]);

        // ------- Images (celles de public/images) -------
        ImageProduit::create(['produit_id' => $boiba->id,        'url' => 'images/sac-boiba.jpeg',        'principale' => true, 'ordre' => 1]);
        ImageProduit::create(['produit_id' => $metamorphose->id, 'url' => 'images/sac-metamorphose.jpeg', 'principale' => true, 'ordre' => 1]);
        ImageProduit::create(['produit_id' => $koro->id,         'url' => 'images/sac-koro.jpeg',         'principale' => true, 'ordre' => 1]);

        // ------- Styles d'essayage -------
        \App\Models\StyleEssayage::create(['produit_id' => $boiba->id,        'nom' => 'Style minimaliste',  'image_url' => 'images/sac-boiba.jpeg']);
        \App\Models\StyleEssayage::create(['produit_id' => $metamorphose->id, 'nom' => 'Style chic',         'image_url' => 'images/sac-metamorphose.jpeg']);
        \App\Models\StyleEssayage::create(['produit_id' => $koro->id,         'nom' => 'Style décontracté',  'image_url' => 'images/sac-koro.jpeg']);

        // ------- Avis de test -------
        Avis::create(['user_id' => $client->id, 'produit_id' => $boiba->id, 'note' => 5, 'commentaire' => 'Sublime, la qualité du cuir est incroyable !', 'created_at' => now()]);
        Avis::create(['user_id' => $client->id, 'produit_id' => $koro->id,  'note' => 4, 'commentaire' => 'Très beau sac, livraison rapide à Cocody.',    'created_at' => now()]);

        // ------- Code promo de test -------
        CodePromo::create([
            'code'            => 'BIENVENUE10',
            'reduction_pct'   => 10,
            'actif'           => true,
            'date_expiration' => now()->addMonths(6)->toDateString(),
        ]);
    }
}
