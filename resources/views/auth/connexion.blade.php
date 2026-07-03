@extends('layouts.app')

@section('title', 'Connexion — Blac Joyaux')

@section('content')

<section class="max-w-md mx-auto px-4 py-14">
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo-blac-joyaux.jpeg') }}" alt="Blac Joyaux"
             class="w-16 h-16 rounded-full object-cover mx-auto mb-4 border-2 border-bj-or">
        <h1 class="font-titre text-3xl">Connexion</h1>
        <p class="text-sm text-bj-noir/60 mt-1">Ravie de vous revoir</p>
    </div>

    <form onsubmit="event.preventDefault();" class="space-y-4 bg-white rounded-sm shadow-sm p-6">
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">E-mail</label>
            <input type="email" placeholder="vous@exemple.com" required
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Mot de passe</label>
            <input type="password" placeholder="••••••••" required minlength="8"
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>
        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2">
                <input type="checkbox" class="w-3.5 h-3.5 text-bj-cuir focus:ring-bj-or rounded-sm">
                Se souvenir de moi
            </label>
            <a href="#" class="text-bj-cuir hover:text-bj-or">Mot de passe oublié ?</a>
        </div>
        <button type="submit"
                class="w-full bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-cuir transition-colors">
            Se connecter
        </button>
    </form>

    <p class="text-center text-sm mt-6 text-bj-noir/60">
        Pas encore de compte ?
        <a href="{{ url('/inscription') }}" class="text-bj-cuir font-medium hover:text-bj-or">Créer un compte</a>
    </p>
</section>

@endsection
