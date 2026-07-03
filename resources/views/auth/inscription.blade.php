@extends('layouts.app')

@section('title', 'Inscription — Blac Joyaux')

@section('content')

<section class="max-w-md mx-auto px-4 py-14">
    <div class="text-center mb-8">
        <h1 class="font-titre text-3xl">Créer un compte</h1>
        <p class="text-sm text-bj-noir/60 mt-1">Rejoignez l'univers Blac Joyaux</p>
    </div>

    <form onsubmit="event.preventDefault();" class="space-y-4 bg-white rounded-sm shadow-sm p-6">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Nom</label>
                <input type="text" required
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Prénom</label>
                <input type="text" required
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
        </div>
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">E-mail</label>
            <input type="email" required
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Téléphone</label>
            <div class="flex">
                <span class="flex items-center px-3 border border-r-0 border-bj-noir/20 rounded-l-sm bg-bj-sable text-sm">+225</span>
                <input type="tel" required
                       class="flex-1 border border-bj-noir/20 rounded-r-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
        </div>
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Mot de passe</label>
            <input type="password" required minlength="8" placeholder="8 caractères minimum"
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Confirmer le mot de passe</label>
            <input type="password" required minlength="8"
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>
        <button type="submit"
                class="w-full bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-cuir transition-colors">
            Créer mon compte
        </button>
    </form>

    <p class="text-center text-sm mt-6 text-bj-noir/60">
        Déjà un compte ?
        <a href="{{ url('/connexion') }}" class="text-bj-cuir font-medium hover:text-bj-or">Se connecter</a>
    </p>
</section>

@endsection
