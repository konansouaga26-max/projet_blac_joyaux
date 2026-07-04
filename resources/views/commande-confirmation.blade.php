@extends('layouts.app')

@section('title', 'Commande confirmée — Blac Joyaux')

@section('content')

<section class="max-w-md mx-auto px-4 py-20 text-center">
    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-bj-or/20 flex items-center justify-center">
        <svg class="w-10 h-10 text-bj-or" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
    </div>

    <h1 class="font-titre text-3xl mb-3">Merci !</h1>
    <p class="text-bj-noir/70 mb-1">
        Votre commande <strong>{{ $commande->reference }}</strong> est confirmée.
    </p>
    <p class="text-sm text-bj-noir/50 mb-2">
        Total : <span class="font-semibold text-bj-cuir">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
    </p>
    <p class="text-xs text-bj-noir/50 mb-8">
        Vous recevrez une confirmation par WhatsApp.<br>
        Livraison estimée sous {{ $commande->delai_livraison }} jours à {{ $commande->ville_livraison }}.
    </p>

    <a href="https://wa.me/2250000000000?text={{ urlencode('Bonjour, je viens de passer la commande ' . $commande->reference) }}"
       target="_blank" rel="noopener"
       class="block w-full text-center border-2 border-green-500 text-green-600 uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-green-500 hover:text-white transition-colors mb-3">
        Confirmer via WhatsApp
    </a>
    <a href="{{ route('home') }}"
       class="block w-full text-center bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-cuir transition-colors">
        Retour à l'accueil
    </a>
</section>

@endsection
