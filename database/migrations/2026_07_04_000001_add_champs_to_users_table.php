<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute les champs du MCD à la table users existante de Laravel.
     * NB : le champ "name" de Laravel joue le rôle de "nom" du MCD.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->nullable()->after('name');
            $table->string('telephone')->nullable()->after('email');
            $table->string('role')->default('client')->after('telephone'); // client | admin
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'telephone', 'role']);
        });
    }
};
