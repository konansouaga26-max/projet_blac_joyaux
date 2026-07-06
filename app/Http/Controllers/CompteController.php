<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
    /**
     * Espace client : profil + historique des commandes.
     */
    public function index()
    {
        $user = Auth::user();

        $commandes = Commande::with('lignes.produit')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('compte.index', compact('user', 'commandes'));
    }
}
