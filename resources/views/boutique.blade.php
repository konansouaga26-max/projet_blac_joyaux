@extends('layouts.app')

@section('title', 'Boutique — Blac Joyaux')

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="text-center mb-6">
        <h1 class="font-titre text-3xl md:text-4xl uppercase">Collection Héritage en mouvement</h1>
        <p class="text-sm text-bj-noir/60 mt-1">Pour chaque rythme de vie, un héritage à porter.</p>
    </div>

    {{-- Filtres par catégorie (dynamiques) --}}
    <div class="flex gap-2 overflow-x-auto pb-3 mb-8 md:justify-center">
        <a href="{{ route('boutique') }}"
           class="whitespace-nowrap px-5 py-2 rounded-full text-sm border transition-colors
                  {{ !isset($categorieActive) || !$categorieActive ? 'bg-bj-violet text-white border-bj-violet' : 'border-bj-noir/20 text-bj-noir/70 hover:border-bj-violet hover:text-bj-violet' }}">
            Tous
        </a>
        @foreach ($categories as $categorie)
        <a href="{{ route('boutique', $categorie->slug) }}"
           class="whitespace-nowrap px-5 py-2 rounded-full text-sm border transition-colors
                  {{ isset($categorieActive) && $categorieActive && $categorieActive->id === $categorie->id ? 'bg-bj-violet text-white border-bj-violet' : 'border-bj-noir/20 text-bj-noir/70 hover:border-bj-violet hover:text-bj-violet' }}">
            {{ $categorie->nom }}
        </a>
        @endforeach
    </div>

    @if ($produits->isEmpty())
        <p class="text-center text-bj-noir/50 py-10">Aucun produit dans cette catégorie pour le moment.</p>
    @endif

    {{-- Liste verticale sur mobile, grille sur desktop --}}
    <div class="flex flex-col md:flex-row md:flex-wrap md:justify-center gap-5 md:gap-6">
        @foreach ($produits as $produit)
        <div class="group bg-white rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-shadow flex md:block md:w-[30%] md:min-w-70">

            <a href="{{ route('produit.show', $produit->slug) }}" class="block w-2/5 md:w-full aspect-square md:aspect-4/5 overflow-hidden relative shrink-0">
                <img src="{{ asset($produit->imagePrincipale?->url ?? 'images/sac-hero.jpeg') }}" alt="{{ $produit->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @unless ($produit->disponible)
                <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] uppercase tracking-wide px-2 py-1 rounded-sm">Rupture</span>
                @endunless
            </a>

            <div class="flex-1 p-4 flex flex-col justify-center md:text-center">
                <h3 class="font-titre text-lg md:text-xl mb-1">{{ $produit->nom }}</h3>
                <p class="text-xs text-bj-noir/60 mb-2">{{ $produit->categorie->nom }}</p>
                <p class="text-bj-violet font-semibold text-base mb-3">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                <a href="{{ route('produit.show', $produit->slug) }}"
                   class="inline-block md:w-full bg-bj-violet text-white text-xs uppercase tracking-wide px-6 py-2.5 rounded-full hover:bg-bj-violet-fonce transition-colors text-center">
                    Voir
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
