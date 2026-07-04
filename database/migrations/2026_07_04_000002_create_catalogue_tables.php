<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables du catalogue : categories, couleurs, produits,
     * produit_couleur (pivot avec stock), images_produit, styles_essayage.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
        });

        Schema::create('couleurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code_hex')->nullable();
        });

        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnDelete();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('histoire')->nullable();
            $table->decimal('prix', 10, 2);
            $table->string('matiere')->nullable();
            $table->string('dimensions')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });

        Schema::create('produit_couleur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
            $table->foreignId('couleur_id')->constrained('couleurs')->cascadeOnDelete();
            $table->integer('stock_couleur')->default(0);
        });

        Schema::create('images_produit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
            $table->string('url');
            $table->boolean('principale')->default(false);
            $table->integer('ordre')->default(0);
        });

        Schema::create('styles_essayage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
            $table->string('nom');
            $table->string('image_url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('styles_essayage');
        Schema::dropIfExists('images_produit');
        Schema::dropIfExists('produit_couleur');
        Schema::dropIfExists('produits');
        Schema::dropIfExists('couleurs');
        Schema::dropIfExists('categories');
    }
};
