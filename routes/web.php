<?php

use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;
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

// Pages encore statiques (prochaines étapes)
Route::get('/commande', [CommandeController::class, 'formulaire'])->name('commande');
Route::post('/commande', [CommandeController::class, 'enregistrer'])->name('commande.enregistrer');
Route::view('/connexion', 'auth.connexion')->name('login');
Route::view('/inscription', 'auth.inscription')->name('register');
Route::view('/compte', 'compte.index')->name('compte');
Route::view('/favoris', 'favoris')->name('favoris');
Route::view('/essayage', 'essayage')->name('essayage');
Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
