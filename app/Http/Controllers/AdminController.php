<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Dashboard admin : vraies statistiques et données de la base.
     * Réservé au rôle admin.
     */
    public function dashboard()
    {
        // Seul l'admin peut accéder au dashboard
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('compte');
        }

        $stats = [
            'commandes'       => Commande::count(),
            'chiffreAffaires' => (float) Commande::sum('total'),
            'produits'        => Produit::count(),
            'clients'         => User::where('role', 'client')->count(),
        ];

        $produits = Produit::with('imagePrincipale')->orderBy('nom')->get();

        $commandes = Commande::with('user')
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'produits', 'commandes'));
    }
}
