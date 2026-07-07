@extends('layouts.app')

@section('title', 'Mon Panier — Blac Joyaux')

@section('content')

<section class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="font-titre text-3xl mb-8">Mon Panier</h1>

    @if (session('succes'))
    <div class="bg-green-100 text-green-800 text-sm rounded-sm px-4 py-3 mb-6">{{ session('succes') }}</div>
    @endif
    @if (session('erreur'))
    <div class="bg-red-100 text-red-800 text-sm rounded-sm px-4 py-3 mb-6">{{ session('erreur') }}</div>
    @endif

    @if (empty($panier))
        <div class="text-center py-16">
            <p class="text-bj-noir/50 mb-6">Votre panier est vide.</p>
            <a href="{{ route('boutique') }}"
               class="inline-block bg-bj-noir text-bj-creme uppercase tracking-wide text-sm px-8 py-3.5 rounded-sm hover:bg-bj-cuir transition-colors">
                Découvrir la boutique
            </a>
        </div>
    @else

    <div class="space-y-4 mb-8">
        @foreach ($panier as $cle => $article)
        <div class="flex gap-4 bg-white rounded-sm shadow-sm p-3">
            <img src="{{ asset($article['image']) }}" alt="{{ $article['nom'] }}"
                 class="w-24 h-24 object-cover rounded-sm">
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-titre text-lg leading-tight">{{ $article['nom'] }}</h3>
                        @if ($article['couleur'])
                        <p class="text-xs text-bj-noir/50">{{ $article['couleur'] }}</p>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('panier.supprimer', $cle) }}">
                        @csrf
                        <button type="submit" aria-label="Supprimer" class="text-bj-noir/40 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m1 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="flex justify-between items-end mt-2">
                    <p class="text-bj-cuir font-semibold text-sm">{{ number_format($article['prix'], 0, ',', ' ') }} FCFA</p>
                    <div class="flex items-center border border-bj-noir/20 rounded-sm">
                        <form method="POST" action="{{ route('panier.quantite', $cle) }}">
                            @csrf
                            <input type="hidden" name="delta" value="-1">
                            <button type="submit" class="px-3 py-1.5 hover:bg-bj-sable">−</button>
                        </form>
                        <span class="px-3 text-sm">{{ $article['quantite'] }}</span>
                        <form method="POST" action="{{ route('panier.quantite', $cle) }}">
                            @csrf
                            <input type="hidden" name="delta" value="1">
                            <button type="submit" class="px-3 py-1.5 hover:bg-bj-sable">+</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('panier.codepromo') }}" class="flex gap-2 mb-8">
        @csrf
        <input type="text" name="code" placeholder="Code promo" value="{{ session('code_promo') }}"
               class="flex-1 border border-bj-noir/20 rounded-sm px-4 py-3 text-sm bg-white focus:outline-none focus:border-bj-or">
        <button type="submit" class="bg-bj-sable text-bj-noir uppercase text-xs tracking-wide px-6 rounded-sm hover:bg-bj-or transition-colors">
            Appliquer
        </button>
    </form>

    <div class="bg-white rounded-sm shadow-sm p-5 space-y-3 text-sm mb-8">
        <div class="flex justify-between">
            <span>Sous-total</span>
            <span class="font-medium">{{ number_format($sousTotal, 0, ',', ' ') }} FCFA</span>
        </div>
        @if ($reduction > 0)
        <div class="flex justify-between text-green-700">
            <span>Réduction ({{ $codeApplique->code }})</span>
            <span class="font-medium">− {{ number_format($reduction, 0, ',', ' ') }} FCFA</span>
        </div>
        @endif
        <div class="flex justify-between">
            <span>Livraison (Abidjan, 1 à 3 jours)</span>
            <span class="font-medium">{{ number_format($fraisLivraison, 0, ',', ' ') }} FCFA</span>
        </div>
        <div class="border-t border-bj-sable pt-3 flex justify-between text-base">
            <span class="font-semibold uppercase tracking-wide">Total</span>
            <span class="font-titre text-xl text-bj-cuir">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
        </div>
    </div>

    <a href="{{ route('commande') }}"
       class="block w-full text-center bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-4 rounded-sm hover:bg-bj-cuir transition-colors">
        Valider ma commande
    </a>
    <a href="{{ route('boutique') }}" class="block text-center mt-4 text-sm text-bj-noir/60 hover:text-bj-cuir">
        ← Continuer mes achats
    </a>

    @endif
</section>

@endsection
