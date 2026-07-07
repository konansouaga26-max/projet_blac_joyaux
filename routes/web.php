<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\EssayageController;
use Illuminate\Support\Facades\Route;

// Catalogue (dynamique)
Route::get('/', [ProduitController::class, 'accueil'])->name('home');
Route::get('/boutique/{categorieSlug?}', [ProduitController::class, 'boutique'])->name('boutique');
Route::get('/produit/{slug}', [ProduitController::class, 'show'])->name('produit.show');

// Panier (session)
Route::get('/panier', [PanierController::class, 'index'])->name('panier');
Route::post('/panier/ajouter/{slug}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::post('/panier/quantite/{cle}', [PanierController::class, 'modifierQuantite'])->name('panier.quantite');
Route::post('/panier/supprimer/{cle}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::post('/panier/code-promo', [PanierController::class, 'appliquerCodePromo'])->name('panier.codepromo');

// Authentification (visiteurs non connectés uniquement)
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'formulaireConnexion'])->name('login');
    Route::post('/connexion', [AuthController::class, 'connecter'])->name('login.post');
    Route::get('/inscription', [AuthController::class, 'formulaireInscription'])->name('register');
    Route::post('/inscription', [AuthController::class, 'inscrire'])->name('register.post');
});

// Pages réservées aux utilisateurs connectés
Route::middleware('auth')->group(function () {
    Route::post('/deconnexion', [AuthController::class, 'deconnecter'])->name('logout');
    Route::get('/commande', [CommandeController::class, 'formulaire'])->name('commande');
    Route::post('/commande', [CommandeController::class, 'enregistrer'])->name('commande.enregistrer');
    Route::get('/compte', [CompteController::class, 'index'])->name('compte');
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/produit/nouveau', [AdminController::class, 'creerProduit'])->name('admin.produit.creer');
    Route::post('/admin/produit', [AdminController::class, 'enregistrerProduit'])->name('admin.produit.enregistrer');
    Route::get('/admin/produit/{produit}/modifier', [AdminController::class, 'modifierProduit'])->name('admin.produit.modifier');
    Route::post('/admin/produit/{produit}', [AdminController::class, 'mettreAJourProduit'])->name('admin.produit.majour');
    Route::post('/admin/produit/{produit}/supprimer', [AdminController::class, 'supprimerProduit'])->name('admin.produit.supprimer');
});

// Pages encore statiques (derniere etape)
Route::view('/favoris', 'favoris')->name('favoris');
Route::get('/essayage', [EssayageController::class, 'index'])->name('essayage');
