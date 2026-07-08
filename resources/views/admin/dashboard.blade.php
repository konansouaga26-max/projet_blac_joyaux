@extends('layouts.app')

@section('title', 'Administration — Blac Joyaux')

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">

    @if (session('succes'))
    <div class="bg-green-100 text-green-800 text-sm rounded-sm px-4 py-3 mb-6">{{ session('succes') }}</div>
    @endif

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-titre text-3xl">Administration</h1>
            <p class="text-sm text-bj-noir/50">Tableau de bord Blac Joyaux</p>
        </div>
        <span class="bg-bj-violet/15 text-bj-violet text-xs uppercase tracking-wide px-3 py-1.5 rounded-full">Admin</span>
    </div>

    {{-- Statistiques réelles --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-sm shadow-sm p-5">
            <p class="text-xs uppercase tracking-widest text-bj-noir/50 mb-1">Commandes</p>
            <p class="font-titre text-2xl text-bj-violet">{{ $stats['commandes'] }}</p>
        </div>
        <div class="bg-white rounded-sm shadow-sm p-5">
            <p class="text-xs uppercase tracking-widest text-bj-noir/50 mb-1">Chiffre d'affaires</p>
            <p class="font-titre text-2xl text-bj-violet">{{ number_format($stats['chiffreAffaires'], 0, ',', ' ') }}</p>
            <p class="text-xs text-bj-noir/40">FCFA</p>
        </div>
        <div class="bg-white rounded-sm shadow-sm p-5">
            <p class="text-xs uppercase tracking-widest text-bj-noir/50 mb-1">Produits</p>
            <p class="font-titre text-2xl text-bj-violet">{{ $stats['produits'] }}</p>
        </div>
        <div class="bg-white rounded-sm shadow-sm p-5">
            <p class="text-xs uppercase tracking-widest text-bj-noir/50 mb-1">Clients</p>
            <p class="font-titre text-2xl text-bj-violet">{{ $stats['clients'] }}</p>
        </div>
    </div>

    {{-- Produits (vraies données, avec stock à jour) --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-titre text-xl">Produits</h2>
        <a href="{{ route('admin.produit.creer') }}"
            class="bg-bj-violet text-white text-xs uppercase tracking-wide px-5 py-2.5 rounded-full hover:bg-bj-violet-fonce transition-colors">
            + Ajouter un produit
        </a>
    </div>
    <div class="overflow-x-auto bg-white rounded-sm shadow-sm mb-10">
        <table class="w-full text-sm text-left">
            <thead class="bg-bj-noir text-bj-creme text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3">Produit</th>
                    <th class="px-4 py-3">Prix</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-bj-sable">
                @foreach ($produits as $produit)
                <tr>
                    <td class="py-3 pl-4 pr-10">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($produit->imagePrincipale?->url ?? 'images/sac-hero.jpeg') }}"
                                class="w-10 h-10 object-cover rounded-sm shrink-0" alt="{{ $produit->nom }}">
                            <span class="font-medium whitespace-nowrap">{{ $produit->nom }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
                    <td class="px-4 py-3">{{ $produit->stock }}</td>
                    <td class="px-4 py-3">
                        <span
                            class="text-xs px-2.5 py-1 rounded-full {{ $produit->stock > 0 && $produit->disponible ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $produit->stock > 0 && $produit->disponible ? 'Disponible' : 'Rupture' }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex gap-3 items-center">
                            <a href="{{ route('admin.produit.modifier', $produit) }}"
                                class="text-bj-violet hover:text-bj-violet-fonce text-xs uppercase">Modifier</a>
                            <form method="POST" action="{{ route('admin.produit.supprimer', $produit) }}"
                                onsubmit="return confirm('Supprimer {{ $produit->nom }} ? Cette action est définitive.');">
                                @csrf
                                <button type="submit"
                                    class="text-red-400 hover:text-red-600 text-xs uppercase">Supprimer</button>
                            </form>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Dernières commandes (vraies données) --}}
    <h2 class="font-titre text-xl mb-4">Dernières commandes</h2>
    <div class="overflow-x-auto bg-white rounded-sm shadow-sm">
        <table class="w-full text-sm text-left">
            <thead class="bg-bj-noir text-bj-creme text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3">Référence</th>
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Paiement</th>
                    <th class="px-4 py-3">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-bj-sable">
                @forelse ($commandes as $commande)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $commande->reference }}</td>
                    <td class="px-4 py-3">{{ $commande->user->prenom }} {{ $commande->user->name }}</td>
                    <td class="px-4 py-3">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                    <td class="px-4 py-3">{{ str_replace('_', ' ', ucfirst($commande->mode_paiement)) }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2.5 py-1 rounded-full
                            @if ($commande->statut === 'livree') bg-green-100 text-green-700
                            @elseif ($commande->statut === 'en_livraison') bg-blue-100 text-blue-700
                            @elseif ($commande->statut === 'annulee') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ str_replace('_', ' ', ucfirst($commande->statut)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-3 text-bj-noir/50">Aucune commande pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

@endsection
