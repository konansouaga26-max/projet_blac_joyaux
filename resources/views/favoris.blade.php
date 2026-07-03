@extends('layouts.app')

@section('title', 'Mes Favoris — Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="font-titre text-3xl mb-1">Mes Favoris</h1>
    <p class="text-sm text-bj-noir/50 mb-8">3 articles sauvegardés</p>

    <div class="space-y-4">
        @php
            $favoris = [
                ['nom' => "L'Élan",      'desc' => 'Élégance adaptable',     'prix' => 75000, 'image' => 'sac-elan.jpeg'],
                ['nom' => "L'Héritière", 'desc' => 'Le sac de la lady boss', 'prix' => 95000, 'image' => 'sac-heritiere.jpeg'],
                ['nom' => "La Promesse", 'desc' => 'Intemporelle chic',      'prix' => 55000, 'image' => 'sac-promesse.jpeg'],
            ];
        @endphp

        @foreach ($favoris as $fav)
        <div class="flex gap-4 bg-white rounded-sm shadow-sm p-3 items-center">
            <img src="{{ asset('images/'.$fav['image']) }}" alt="{{ $fav['nom'] }}"
                 class="w-20 h-20 object-cover rounded-sm">
            <div class="flex-1">
                <h3 class="font-titre text-lg leading-tight">{{ $fav['nom'] }}</h3>
                <p class="text-xs text-bj-noir/50">{{ $fav['desc'] }}</p>
                <p class="text-bj-cuir font-semibold text-sm mt-1">{{ number_format($fav['prix'], 0, ',', ' ') }} FCFA</p>
            </div>
            <div class="flex flex-col gap-2">
                <button class="text-xs text-bj-noir/50 hover:text-red-500 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    Retirer
                </button>
                <button class="bg-bj-noir text-bj-creme text-[11px] uppercase tracking-wide px-4 py-2.5 rounded-sm hover:bg-bj-cuir transition-colors">
                    Ajouter au panier
                </button>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="bg-bj-cuir text-bj-creme mt-6">
    <div class="max-w-2xl mx-auto px-4 py-12 text-center">
        <img src="{{ asset('images/logo-blac-joyaux.jpeg') }}" alt="Blac Joyaux"
             class="w-14 h-14 rounded-full object-cover mx-auto mb-4 border border-bj-or">
        <h2 class="font-titre text-2xl tracking-widest uppercase mb-2">Blac Joyaux</h2>
        <p class="text-sm mb-1">Rejoignez l'univers Blac Joyaux</p>
        <p class="text-bj-or text-sm mb-6">Inscrivez-vous et recevez 10% de réduction sur votre première commande.</p>

        <form onsubmit="event.preventDefault();" class="flex max-w-sm mx-auto">
            <input type="email" placeholder="Votre e-mail" required
                   class="flex-1 rounded-l-sm px-4 py-3 text-sm text-bj-noir focus:outline-none">
            <button class="bg-bj-noir px-5 rounded-r-sm hover:bg-bj-or hover:text-bj-noir transition-colors" aria-label="S'inscrire">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5-5 5M6 12h12"/>
                </svg>
            </button>
        </form>

        <div class="grid grid-cols-3 gap-4 mt-10 text-xs divide-x divide-bj-creme/20">
            <p>Fabriqué à la main<br>en Côte d'Ivoire</p>
            <p>Livraison à Abidjan<br>en 1 à 3 jours</p>
            <p>Qualité premium<br>et authentique</p>
        </div>
    </div>
</section>

@endsection
