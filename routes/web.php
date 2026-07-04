<?php

use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

/*
| Routes Web — Blac Joyaux
| Le catalogue est désormais dynamique (ProduitController).
| Les autres pages passeront en controllers aux prochaines étapes.
*/

// Catalogue (dynamique)
Route::get('/', [ProduitController::class, 'accueil'])->name('home');
Route::get('/boutique/{categorieSlug?}', [ProduitController::class, 'boutique'])->name('boutique');
Route::get('/produit/{slug}', [ProduitController::class, 'show'])->name('produit.show');

// Pages encore statiques (prochaines étapes)
Route::view('/panier', 'panier')->name('panier');
Route::view('/commande', 'commande')->name('commande');
Route::view('/connexion', 'auth.connexion')->name('login');
Route::view('/inscription', 'auth.inscription')->name('register');
Route::view('/compte', 'compte.index')->name('compte');
Route::view('/favoris', 'favoris')->name('favoris');
Route::view('/essayage', 'essayage')->name('essayage');
Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
