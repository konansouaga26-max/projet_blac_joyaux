@extends('layouts.app')


@section('title', 'Mon Panier — Blac Joyaux')


@section('content')


<section class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="font-titre text-3xl mb-8">Mon Panier</h1>


    <div class="space-y-4 mb-8">
        @php
            $articles = [
                ['nom' => "L'Héritière", 'couleur' => 'Beige',  'prix' => 95000, 'image' => 'sac-heritiere.jpeg'],
                ['nom' => "L'Élan",      'couleur' => 'Marron', 'prix' => 75000, 'image' => 'sac-elan.jpeg'],
            ];
        @endphp


        @foreach ($articles as $article)
        <div class="flex gap-4 bg-white rounded-sm shadow-sm p-3">
            <img src="{{ asset('images/'.$article['image']) }}" alt="{{ $article['nom'] }}"
                 class="w-24 h-24 object-cover rounded-sm">
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-titre text-lg leading-tight">{{ $article['nom'] }}</h3>
                        <p class="text-xs text-bj-noir/50">{{ $article['couleur'] }}</p>
                    </div>
                    <button aria-label="Supprimer" class="text-bj-noir/40 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m1 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex justify-between items-end mt-2">
                    <p class="text-bj-cuir font-semibold text-sm">{{ number_format($article['prix'], 0, ',', ' ') }} FCFA</p>
                    <div class="flex items-center border border-bj-noir/20 rounded-sm">
                        <button class="px-3 py-1.5 hover:bg-bj-sable" onclick="changerQte(this, -1)">−</button>
                        <span class="px-3 text-sm qte">1</span>
                        <button class="px-3 py-1.5 hover:bg-bj-sable" onclick="changerQte(this, 1)">+</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <div class="flex gap-2 mb-8">
        <input type="text" placeholder="Code promo"
               class="flex-1 border border-bj-noir/20 rounded-sm px-4 py-3 text-sm bg-white focus:outline-none focus:border-bj-or">
        <button class="bg-bj-sable text-bj-noir uppercase text-xs tracking-wide px-6 rounded-sm hover:bg-bj-or transition-colors">
            Appliquer
        </button>
    </div>


    <div class="bg-white rounded-sm shadow-sm p-5 space-y-3 text-sm mb-8">
        <div class="flex justify-between">
            <span>Sous-total</span>
            <span class="font-medium">170 000 FCFA</span>
        </div>
        <div class="flex justify-between">
            <span>Livraison (Abidjan, 1 à 3 jours)</span>
            <span class="font-medium">1 000 FCFA</span>
        </div>
        <div class="border-t border-bj-sable pt-3 flex justify-between text-base">
            <span class="font-semibold uppercase tracking-wide">Total</span>
            <span class="font-titre text-xl text-bj-cuir">171 000 FCFA</span>
        </div>
    </div>


    <a href="{{ url('/commande') }}"
       class="block w-full text-center bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-4 rounded-sm hover:bg-bj-cuir transition-colors">
        Valider ma commande
    </a>
    <a href="{{ url('/boutique') }}" class="block text-center mt-4 text-sm text-bj-noir/60 hover:text-bj-cuir">
        ← Continuer mes achats
    </a>
</section>


@push('scripts')
<script>
    function changerQte(btn, delta) {
        const span = btn.parentElement.querySelector('.qte');
        span.textContent = Math.max(1, parseInt(span.textContent) + delta);
    }
</script>
@endpush


@endsection
