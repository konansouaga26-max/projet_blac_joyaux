@extends('layouts.app')

@section('title', 'Validation de commande — Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="font-titre text-3xl mb-1">Validation de commande</h1>
    <p class="text-sm text-bj-noir/60 mb-8">Veuillez compléter vos informations</p>

    {{-- Erreurs de validation --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-800 text-sm rounded-sm px-4 py-3 mb-6">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $erreur)
            <li>{{ $erreur }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('commande.enregistrer') }}" class="space-y-8">
        @csrf

        <div>
            <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-4">Informations</h2>
            <div class="space-y-4">
                <input type="text" name="nom_destinataire" placeholder="Nom complet" required value="{{ old('nom_destinataire') }}"
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-violet">
                <div class="flex">
                    <span class="flex items-center px-3 border border-r-0 border-bj-noir/20 rounded-l-sm bg-bj-sable text-sm">+225</span>
                    <input type="tel" name="telephone_livraison" placeholder="Téléphone" required value="{{ old('telephone_livraison') }}"
                           class="flex-1 border border-bj-noir/20 rounded-r-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-violet">
                </div>
                <input type="text" name="adresse_livraison" placeholder="Adresse de livraison" required value="{{ old('adresse_livraison') }}"
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-violet">
                <select name="ville_livraison" required
                        class="w-full border border-bj-noir/20 rounded-sm px-4 py-3.5 text-sm bg-white focus:outline-none focus:border-bj-violet">
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
               <label class="flex items-center gap-3 bg-white border border-bj-noir/10 rounded-sm px-4 py-4 cursor-pointer hover:border-bj-violet transition-colors">
                    <input type="radio" name="mode_paiement" value="{{ $mode[0] }}" {{ $i === 0 ? 'checked' : '' }}
                        class="w-4 h-4 text-bj-violet focus:ring-bj-violet">
                    <span class="text-sm">{{ $mode[1] }}</span>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Récapitulatif (vrais totaux du panier) --}}
        <div class="bg-white rounded-sm shadow-sm p-5 space-y-3 text-sm">
            <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-1">Récapitulatif</h2>
            @foreach ($panier as $article)
            <div class="flex justify-between text-bj-noir/70">
                <span>{{ $article['nom'] }}{{ $article['couleur'] ? ' — ' . $article['couleur'] : '' }} × {{ $article['quantite'] }}</span>
                <span>{{ number_format($article['prix'] * $article['quantite'], 0, ',', ' ') }} FCFA</span>
            </div>
            @endforeach
            @if ($reduction > 0)
            <div class="flex justify-between text-green-700">
                <span>Réduction ({{ $codeApplique->code }})</span>
                <span>− {{ number_format($reduction, 0, ',', ' ') }} FCFA</span>
            </div>
            @endif
            <div class="flex justify-between text-bj-noir/70">
                <span>Livraison</span>
                <span>{{ number_format($fraisLivraison, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="border-t border-bj-sable pt-3 flex justify-between items-center">
                <span class="font-semibold uppercase tracking-wide">Total</span>
                <span class="font-titre text-2xl text-bj-violet">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
            </div>
            <p class="text-xs text-bj-noir/50">Livraison estimée : 1 à 3 jours ouvrés à Abidjan</p>
        </div>

       <button type="submit"
                class="w-full bg-bj-violet text-white uppercase tracking-wide text-sm py-4 rounded-full hover:bg-bj-violet-fonce transition-colors">
            Confirmer ma commande
        </button>
    </form>
</section>

@endsection
