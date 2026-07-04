@extends('layouts.app')

@section('title', 'Blac Joyaux — Accueil')

@section('content')

<section class="relative h-[85vh] md:h-[90vh] flex items-end md:items-center overflow-hidden">
    <img src="{{ asset('images/sac-hero.jpeg') }}" alt="Sac Blac Joyaux"
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-bj-noir/90 via-bj-noir/40 to-transparent"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 pb-14 md:pb-0 w-full">
        <p class="uppercase tracking-[0.3em] text-bj-or text-xs md:text-sm mb-3">Maroquinerie ivoirienne</p>
        <h1 class="font-titre text-4xl md:text-6xl text-bj-creme leading-tight mb-4">
            L'avenir en main
        </h1>
        <p class="text-bj-creme/80 text-sm md:text-base max-w-md mb-6">
            Des sacs pensés pour chaque moment de votre vie, inspirés de notre héritage
            et fabriqués avec passion en Côte d'Ivoire.
        </p>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('boutique') }}"
               class="inline-block text-center bg-bj-or text-bj-noir font-semibold uppercase tracking-wide text-sm px-8 py-3.5 rounded-sm hover:bg-bj-creme transition-colors">
                Découvrir
            </a>
            <button data-modal-target="modal-histoire" data-modal-toggle="modal-histoire"
                    class="inline-block text-center border border-bj-creme/60 text-bj-creme uppercase tracking-wide text-sm px-8 py-3.5 rounded-sm hover:border-bj-or hover:text-bj-or transition-colors">
                Notre histoire
            </button>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-14">
    <div class="text-center mb-10">
        <p class="uppercase tracking-[0.25em] text-bj-cuir text-xs mb-2">Trois sacs, trois moments de vie</p>
        <h2 class="font-titre text-3xl md:text-4xl">Un seul héritage</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($produits as $produit)
        <a href="{{ route('produit.show', $produit->slug) }}"
           class="group bg-white rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-shadow">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="{{ asset($produit->imagePrincipale?->url ?? 'images/sac-hero.jpeg') }}" alt="{{ $produit->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-5 text-center">
                <h3 class="font-titre text-xl mb-1">{{ $produit->nom }}</h3>
                <p class="text-bj-cuir font-semibold">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                <span class="inline-block mt-3 text-xs uppercase tracking-widest text-bj-or border-b border-bj-or pb-0.5">Voir le produit</span>
            </div>
        </a>
        @endforeach
    </div>
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

<div id="modal-histoire" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-bj-creme rounded-sm shadow-xl">
            <div class="flex items-center justify-between p-5 border-b border-bj-sable">
                <h3 class="font-titre text-2xl">Notre Histoire</h3>
                <button type="button" data-modal-hide="modal-histoire"
                        class="text-bj-noir/60 hover:text-bj-noir rounded-lg w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 12 12M13 1 1 13"/></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <div class="p-5 space-y-4 text-sm leading-relaxed">
                <p>Fondée en 2024 par <strong>Manuela Kouadio</strong>, diplômée en Communication et graphisme, Blac Joyaux est une marque de maroquinerie ivoirienne.</p>
                <p>Inspirée par la <strong>poupée Joyaux de Bla</strong> — symbole de fécondité ashanti — chaque sac célèbre l'héritage africain avec élégance et modernité.</p>
                <p>Fabriqués artisanalement à Abidjan, nos sacs sont pensés pour la femme africaine d'aujourd'hui.</p>
            </div>
            <div class="p-5 border-t border-bj-sable">
                <a href="{{ route('boutique') }}"
                   class="block w-full text-center bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-3 rounded-sm hover:bg-bj-cuir transition-colors">
                    Découvrir la collection
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
