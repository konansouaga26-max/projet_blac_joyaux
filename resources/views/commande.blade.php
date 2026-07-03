@extends('layouts.app')


@section('title', 'Validation de commande — Blac Joyaux')


@section('content')


<section class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="font-titre text-3xl mb-1">Validation de commande</h1>
    <p class="text-sm text-bj-noir/60 mb-8">Veuillez compléter vos informations</p>


    <form onsubmit="event.preventDefault();" class="space-y-8">


        <div>
            <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-4">Informations</h2>
            <div class="space-y-4">
                <input type="text" placeholder="Nom complet" required
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-or">
                <div class="flex">
                    <span class="flex items-center px-3 border border-r-0 border-bj-noir/20 rounded-l-sm bg-bj-sable text-sm">+225</span>
                    <input type="tel" placeholder="Téléphone" required
                           class="flex-1 border border-bj-noir/20 rounded-r-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-or">
                </div>
                <input type="text" placeholder="Adresse de livraison" required
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-or">
                <select class="w-full border border-bj-noir/20 rounded-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-or">
                    <option value="">Ville</option>
                    <option>Abidjan — Cocody</option>
                    <option>Abidjan — Plateau</option>
                    <option>Abidjan — Marcory</option>
                    <option>Abidjan — Yopougon</option>
                    <option>Abidjan — Treichville</option>
                    <option>Autre ville (Côte d'Ivoire)</option>
                </select>
            </div>
        </div>


        <div>
            <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-4">Mode de paiement</h2>
            <div class="space-y-3">
                @foreach ([['carte', 'Carte bancaire'], ['mobile_money', 'Mobile Money (Orange, MTN, Wave)'], ['livraison', 'Paiement à la livraison']] as $i => $mode)
                <label class="flex items-center gap-3 bg-white border border-bj-noir/10 rounded-sm px-4 py-4 cursor-pointer hover:border-bj-or transition-colors">
                    <input type="radio" name="paiement" value="{{ $mode[0] }}" {{ $i === 0 ? 'checked' : '' }}
                           class="w-4 h-4 text-bj-cuir focus:ring-bj-or">
                    <span class="text-sm">{{ $mode[1] }}</span>
                </label>
                @endforeach
            </div>
        </div>


        <div class="bg-white rounded-sm shadow-sm p-5">
            <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-3">Récapitulatif</h2>
            <div class="flex justify-between items-center">
                <span class="font-semibold uppercase tracking-wide text-sm">Total</span>
                <span class="font-titre text-2xl text-bj-cuir">171 000 FCFA</span>
            </div>
            <p class="text-xs text-bj-noir/50 mt-2">Livraison estimée : 1 à 3 jours ouvrés à Abidjan</p>
        </div>


        <button type="submit" data-modal-target="modal-confirmation" data-modal-toggle="modal-confirmation"
                class="w-full bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-4 rounded-sm hover:bg-bj-cuir transition-colors">
            Confirmer ma commande
        </button>
    </form>
</section>


<div id="modal-confirmation" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <div class="relative bg-bj-creme rounded-sm shadow-xl p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-bj-or/20 flex items-center justify-center">
                <svg class="w-8 h-8 text-bj-or" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="font-titre text-2xl mb-2">Merci !</h3>
            <p class="text-sm text-bj-noir/70 mb-1">Votre commande <strong>#BJ-2026-001</strong> est confirmée.</p>
            <p class="text-xs text-bj-noir/50 mb-5">Vous recevrez une confirmation par WhatsApp. Livraison sous 1 à 3 jours.</p>
            <a href="{{ url('/') }}" class="block bg-bj-noir text-bj-creme text-sm uppercase tracking-wide py-3 rounded-sm hover:bg-bj-cuir">
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>


@endsection
