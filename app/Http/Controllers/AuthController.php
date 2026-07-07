<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function formulaireConnexion()
    {
        return view('auth.connexion');
    }

    /**
     * Traite la connexion.
     */
    public function connecter(Request $request)
    {
        $identifiants = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => "L'adresse e-mail est obligatoire.",
            'email.email'       => "L'adresse e-mail est invalide.",
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (Auth::attempt($identifiants, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // L'admin va au dashboard, le client à son compte
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('compte'));
        }

        return back()->withErrors([
            'email' => 'E-mail ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Affiche le formulaire d'inscription.
     */
    public function formulaireInscription()
    {
        return view('auth.inscription');
    }

    /**
     * Traite l'inscription puis connecte l'utilisateur.
     */
    public function inscrire(Request $request)
    {
        $donnees = $request->validate([
            'name'      => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'password'  => 'required|min:8|confirmed',
        ], [
            'required'        => 'Ce champ est obligatoire.',
            'email.unique'    => 'Un compte existe déjà avec cet e-mail.',
            'password.min'    => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $user = User::create([
            'name'      => $donnees['name'],
            'prenom'    => $donnees['prenom'],
            'email'     => $donnees['email'],
            'telephone' => $donnees['telephone'],
            'role'      => 'client',
            'password'  => Hash::make($donnees['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('compte');
    }

    /**
     * Déconnexion.
     */
    public function deconnecter(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
