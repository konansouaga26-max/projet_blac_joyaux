<?php

use Illuminate\Support\Facades\Route;

/*
| Routes Web — PHASE FRONT-END (vues statiques)
| Ces Route::view seront remplacées par des controllers en phase back-end.
*/

Route::view('/', 'home')->name('home');
Route::view('/boutique', 'boutique')->name('boutique');
Route::view('/produit/{slug}', 'produit')->name('produit.show');
Route::view('/panier', 'panier')->name('panier');
Route::view('/commande', 'commande')->name('commande');
Route::view('/connexion', 'auth.connexion')->name('login');
Route::view('/inscription', 'auth.inscription')->name('register');
Route::view('/compte', 'compte.index')->name('compte');
Route::view('/favoris', 'favoris')->name('favoris');
Route::view('/essayage', 'essayage')->name('essayage');
Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
