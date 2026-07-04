<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables commandes : codes_promo, commandes, lignes_commande,
     * commande_code_promo (pivot).
     */
    public function up(): void
    {
        Schema::create('codes_promo', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('reduction_pct')->nullable();
            $table->decimal('reduction_fixe', 10, 2)->nullable();
            $table->boolean('actif')->default(true);
            $table->date('date_expiration')->nullable();
        });

        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('adresse_id')->nullable()->constrained('adresses')->nullOnDelete();
            $table->string('reference')->unique();
            $table->string('statut')->default('en_attente'); // en_attente | confirmee | en_livraison | livree | annulee
            $table->decimal('total', 10, 2);
            $table->decimal('frais_livraison', 10, 2)->default(0);
            $table->string('mode_paiement');
            $table->string('operateur_mobile')->nullable();
            $table->string('numero_mobile')->nullable();
            $table->string('mode_livraison')->default('domicile');
            $table->string('nom_destinataire');
            $table->string('telephone_livraison');
            $table->string('adresse_livraison');
            $table->string('ville_livraison');
            $table->string('commune_livraison')->nullable();
            $table->integer('delai_livraison')->default(3);
            $table->boolean('whatsapp_envoye')->default(false);
            $table->timestamps();
        });

        Schema::create('lignes_commande', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
            $table->foreignId('couleur_id')->nullable()->constrained('couleurs')->nullOnDelete();
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('sous_total', 10, 2);
        });

        Schema::create('commande_code_promo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('code_promo_id')->constrained('codes_promo')->cascadeOnDelete();
            $table->decimal('reduction_appliquee', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commande_code_promo');
        Schema::dropIfExists('lignes_commande');
        Schema::dropIfExists('commandes');
        Schema::dropIfExists('codes_promo');
    }
};
