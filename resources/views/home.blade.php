@extends('layouts.app')

@section('title', 'Blac Joyaux — Accueil')

@section('content')

<section class="relative h-[70vh] md:h-[90vh] flex items-end md:items-center overflow-hidden">
    <img src="{{ asset('images/sac-hero.jpeg') }}" alt="Sac Blac Joyaux"
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-linear-to-t from-bj-noir/85 via-bj-noir/30 to-transparent"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 pb-10 md:pb-0 w-full text-center md:text-left">
        <h1 class="font-titre text-4xl md:text-6xl text-bj-creme leading-tight mb-1">
            L'avenir en main
        </h1>
        <p class="uppercase tracking-[0.3em] text-bj-or text-xs md:text-sm mb-4">Own the future</p>
        <p class="text-bj-creme/85 text-sm md:text-base max-w-md mx-auto md:mx-0 mb-6">
            Des sacs pensées pour chaque moment de votre vie, inspirés de notre héritage
            et fabriqué avec passion en Côte d'Ivoire
        </p>
        <a href="{{ route('boutique') }}"
           class="inline-block text-center bg-bj-violet text-white font-semibold uppercase tracking-wide text-sm px-10 py-3.5 rounded-full hover:bg-bj-violet-fonce transition-colors">
            Découvrir
        </a>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
    <div class="order-2 md:order-1">
        <p class="uppercase tracking-[0.25em] text-bj-cuir text-xs mb-2">Notre histoire</p>
        <p class="text-sm leading-relaxed text-bj-noir/80 mb-5">
            Blac joyaux est une marque de maroquinerie ivoirienne qui célèbre l'héritage
            culturel à travers la poupée Bla et le savoir faire des artisans made in Côte d'ivoire.
        </p>
        <button data-modal-target="modal-histoire" data-modal-toggle="modal-histoire"
                class="inline-block text-center bg-bj-violet text-white uppercase tracking-wide text-sm px-8 py-3 rounded-full hover:bg-bj-violet-fonce transition-colors">
            En savoir plus
        </button>
    </div>
    <div class="order-1 md:order-2 aspect-4/3 rounded-sm overflow-hidden">
        <img src="{{ asset('images/banniere-blac-joyaux.jpeg') }}" alt="Notre histoire — Blac Joyaux"
             class="w-full h-full object-cover">
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="text-center mb-10">
        <h2 class="font-titre text-2xl md:text-3xl uppercase">Trois sacs, trois moments de vie,</h2>
        <p class="font-titre text-2xl md:text-3xl uppercase text-bj-violet">un seul héritage</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($produits as $produit)
        <a href="{{ route('produit.show', $produit->slug) }}"
           class="group bg-white rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-shadow">
            <div class="aspect-4/5 overflow-hidden">
                <img src="{{ asset($produit->imagePrincipale?->url ?? 'images/sac-hero.jpeg') }}" alt="{{ $produit->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-5 text-center">
                <h3 class="font-titre text-xl mb-1">{{ $produit->nom }}</h3>
                <p class="text-bj-or font-semibold">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                <span class="inline-block mt-3 text-xs uppercase tracking-widest text-bj-violet border-b border-bj-violet pb-0.5">Voir le produit</span>
            </div>
        </a>
        @endforeach
    </div>
    <p class="text-center font-titre text-lg uppercase tracking-[0.2em] text-bj-cuir mt-10">L'avenir en main</p>
</section>

<section class="bg-bj-noir text-bj-creme py-10">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
        <div>
            <p class="font-titre text-2xl text-bj-or mb-1">1 à 3 jours</p>
            <p class="text-sm text-bj-creme/70 uppercase tracking-wide">Livraison à Abidjan</p>
        </div>
        <div>
            <p class="font-titre text-2xl text-bj-or mb-1">Fait main</p>
            <p class="text-sm text-bj-creme/70 uppercase tracking-wide">Artisanat 100% ivoirien</p>
        </div>
        <div>
            <p class="font-titre text-2xl text-bj-or mb-1">Mobile Money</p>
            <p class="text-sm text-bj-creme/70 uppercase tracking-wide">Paiement flexible</p>
        </div>
    </div>
</section>

@endsection
