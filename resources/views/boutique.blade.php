@extends('layouts.app')


@section('title', 'Boutique — Blac Joyaux')


@section('content')


<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="text-center mb-8">
        <p class="uppercase tracking-[0.25em] text-bj-cuir text-xs mb-2">Nos créations</p>
        <h1 class="font-titre text-3xl md:text-4xl">La Boutique</h1>
    </div>


    <div class="flex gap-2 overflow-x-auto pb-3 mb-8 md:justify-center">
        @foreach (['Tous', 'Sacs à main', 'Sacs de bureau', 'Pochettes', 'Accessoires'] as $i => $cat)
        <button class="whitespace-nowrap px-5 py-2 rounded-full text-sm border transition-colors
                       {{ $i === 0 ? 'bg-bj-noir text-bj-creme border-bj-noir' : 'border-bj-noir/30 hover:border-bj-or hover:text-bj-cuir' }}">
            {{ $cat }}
        </button>
        @endforeach
    </div>


    @php
        $produits = [
            ['nom' => "L'Héritière", 'desc' => 'Le sac de bureau signature', 'prix' => 95000, 'image' => 'sac-heritiere.jpeg', 'slug' => 'l-heritiere'],
            ['nom' => "L'Élan",      'desc' => "L'élégance du quotidien",    'prix' => 75000, 'image' => 'sac-elan.jpeg',      'slug' => 'l-elan'],
            ['nom' => "La Promesse", 'desc' => 'Le charme intemporel',       'prix' => 55000, 'image' => 'sac-promesse.jpeg',  'slug' => 'la-promesse'],
            ['nom' => "L'Héritière", 'desc' => 'Édition beige sable',        'prix' => 95000, 'image' => 'sac-hero.jpeg',      'slug' => 'l-heritiere'],
        ];
    @endphp


    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        @foreach ($produits as $produit)
        <div class="group bg-white rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-shadow">
            <a href="{{ url('/produit/'.$produit['slug']) }}" class="block aspect-[4/5] overflow-hidden relative">
                <img src="{{ asset('images/'.$produit['image']) }}" alt="{{ $produit['nom'] }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <button class="absolute top-2 right-2 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center text-bj-noir hover:text-red-500 transition-colors"
                        aria-label="Ajouter aux favoris" onclick="event.preventDefault(); this.classList.toggle('text-red-500')">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </button>
            </a>
            <div class="p-3 md:p-4 text-center">
                <h3 class="font-titre text-base md:text-lg">{{ $produit['nom'] }}</h3>
                <p class="text-xs text-bj-noir/60 mb-1 hidden md:block">{{ $produit['desc'] }}</p>
                <p class="text-bj-cuir font-semibold text-sm md:text-base">{{ number_format($produit['prix'], 0, ',', ' ') }} FCFA</p>
                <a href="{{ url('/produit/'.$produit['slug']) }}"
                   class="mt-2 inline-block w-full bg-bj-noir text-bj-creme text-xs uppercase tracking-wide py-2.5 rounded-sm hover:bg-bj-cuir transition-colors">
                    Voir le produit
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>


@endsection
