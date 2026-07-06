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

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 text-sm rounded-sm px-4 py-3 mb-6">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $erreur)
            <li>{{ $erreur }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-4 bg-white rounded-sm shadow-sm p-6">
        @csrf
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">E-mail</label>
            <input type="email" name="email" placeholder="vous@exemple.com" required value="{{ old('email') }}"
                class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>
        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Mot de passe</label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="••••••••" required
                    class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 pr-11 text-sm focus:outline-none focus:border-bj-or">
                <button type="button" onclick="basculerMdp('password', this)" aria-label="Afficher le mot de passe"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-bj-noir/40 hover:text-bj-cuir">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="w-3.5 h-3.5 text-bj-cuir focus:ring-bj-or rounded-sm">
                Se souvenir de moi
            </label>
        </div>
        <button type="submit"
            class="w-full bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-cuir transition-colors">
            Se connecter
        </button>
    </form>

    <p class="text-center text-sm mt-6 text-bj-noir/60">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="text-bj-cuir font-medium hover:text-bj-or">Créer un compte</a>
    </p>
</section>

@push('scripts')
<script>
    function basculerMdp(id, btn) {
        const champ = document.getElementById(id);
        const visible = champ.type === 'password';
        champ.type = visible ? 'text' : 'password';

        // Icône : œil barré quand le mot de passe est visible
        btn.innerHTML = visible
            ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>'
            : '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>';
    }
</script>
@endpush

@endsection
