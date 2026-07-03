@extends('layouts.app')

@section('title', 'Administration — Blac Joyaux')

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-titre text-3xl">Administration</h1>
            <p class="text-sm text-bj-noir/50">Tableau de bord Blac Joyaux</p>
        </div>
        <span class="bg-bj-or/20 text-bj-cuir text-xs uppercase tracking-wide px-3 py-1.5 rounded-full">Admin</span>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @foreach ([
            ['Commandes', '24', 'ce mois'],
            ['Chiffre d affaires', '1 850 000', 'FCFA'],
            ['Produits', '12', 'en catalogue'],
            ['Clients', '48', 'inscrits'],
        ] as $stat)
        <div class="bg-white rounded-sm shadow-sm p-5">
            <p class="text-xs uppercase tracking-widest text-bj-noir/50 mb-1">{{ $stat[0] }}</p>
            <p class="font-titre text-2xl text-bj-cuir">{{ $stat[1] }}</p>
            <p class="text-xs text-bj-noir/40">{{ $stat[2] }}</p>
        </div>
        @endforeach
    </div>

    <div class="flex items-center justify-between mb-4">
        <h2 class="font-titre text-xl">Produits</h2>
        <button class="bg-bj-noir text-bj-creme text-xs uppercase tracking-wide px-5 py-2.5 rounded-sm hover:bg-bj-cuir transition-colors">
            + Ajouter un produit
        </button>
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
                @foreach ([
                    ["L'Héritière", '95 000', 8,  true,  'sac-heritiere.jpeg'],
                    ["L'Élan",      '75 000', 12, true,  'sac-elan.jpeg'],
                    ["La Promesse", '55 000', 0,  false, 'sac-promesse.jpeg'],
                ] as $p)
                <tr>
                    <td class="px-4 py-3 flex items-center gap-3">
                        <img src="{{ asset('images/'.$p[4]) }}" class="w-10 h-10 object-cover rounded-sm" alt="{{ $p[0] }}">
                        <span class="font-medium">{{ $p[0] }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $p[1] }} FCFA</td>
                    <td class="px-4 py-3">{{ $p[2] }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $p[3] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $p[3] ? 'Disponible' : 'Rupture' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button class="text-bj-cuir hover:text-bj-or text-xs uppercase">Modifier</button>
                            <button class="text-red-400 hover:text-red-600 text-xs uppercase">Supprimer</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
                @foreach ([
                    ['BJ-2026-001', 'Kouadio Fatou',   '171 000', 'Mobile Money',    'En livraison', 'bg-blue-100 text-blue-700'],
                    ['BJ-2026-002', 'Traoré Aminata',  '95 000',  'Carte',           'Livrée',       'bg-green-100 text-green-700'],
                    ['BJ-2026-003', 'Koné Mariam',     '55 000',  'À la livraison',  'En attente',   'bg-yellow-100 text-yellow-700'],
                ] as $c)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $c[0] }}</td>
                    <td class="px-4 py-3">{{ $c[1] }}</td>
                    <td class="px-4 py-3">{{ $c[2] }} FCFA</td>
                    <td class="px-4 py-3">{{ $c[3] }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $c[5] }}">{{ $c[4] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
