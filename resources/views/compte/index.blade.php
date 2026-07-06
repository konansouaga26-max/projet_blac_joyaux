@extends('layouts.app')

@section('title', 'Mon Compte — Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">

    {{-- Profil (utilisateur réellement connecté) --}}
    <div class="text-center mb-10">
        <div class="w-24 h-24 mx-auto rounded-full bg-bj-sable border-2 border-bj-or flex items-center justify-center mb-3 overflow-hidden">
            <svg class="w-12 h-12 text-bj-cuir" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"/>
            </svg>
        </div>
        <h1 class="font-titre text-2xl">{{ $user->prenom }} {{ $user->name }}</h1>
        <p class="text-sm text-bj-noir/50">{{ $user->email }}</p>
        @if ($user->role === 'admin')
        <a href="{{ route('admin.dashboard') }}"
           class="inline-block mt-2 bg-bj-or/20 text-bj-cuir text-xs uppercase tracking-wide px-3 py-1.5 rounded-full hover:bg-bj-or/40">
            Accéder à l'administration
        </a>
        @endif
    </div>

    {{-- Historique des commandes --}}
    <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-3">Mes commandes ({{ $commandes->count() }})</h2>
    <div class="space-y-3 mb-8">
        @forelse ($commandes as $commande)
        <div class="bg-white rounded-sm shadow-sm p-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-medium text-sm">{{ $commande->reference }}</p>
                    <p class="text-xs text-bj-noir/50">{{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <span class="text-xs px-2.5 py-1 rounded-full
                    @if ($commande->statut === 'livree') bg-green-100 text-green-700
                    @elseif ($commande->statut === 'en_livraison') bg-blue-100 text-blue-700
                    @elseif ($commande->statut === 'annulee') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700 @endif">
                    {{ str_replace('_', ' ', ucfirst($commande->statut)) }}
                </span>
            </div>
            <ul class="text-xs text-bj-noir/60 mb-2">
                @foreach ($commande->lignes as $ligne)
                <li>{{ $ligne->produit->nom }} × {{ $ligne->quantite }}</li>
                @endforeach
            </ul>
            <p class="text-sm font-semibold text-bj-cuir">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</p>
        </div>
        @empty
        <p class="text-sm text-bj-noir/50 bg-white rounded-sm shadow-sm p-4">Aucune commande pour le moment.</p>
        @endforelse
    </div>

    {{-- Informations personnelles --}}
    <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-3">Mes informations</h2>
    <div class="bg-white rounded-sm shadow-sm p-4 text-sm space-y-2 mb-8">
        <p><span class="text-bj-noir/50">Nom :</span> {{ $user->name }}</p>
        <p><span class="text-bj-noir/50">Prénom :</span> {{ $user->prenom }}</p>
        <p><span class="text-bj-noir/50">E-mail :</span> {{ $user->email }}</p>
        <p><span class="text-bj-noir/50">Téléphone :</span> {{ $user->telephone ?? 'Non renseigné' }}</p>
    </div>

    {{-- Paramètres --}}
    <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-3">Paramètres</h2>
    <div class="space-y-2 mb-10">
        <a href="https://wa.me/2250000000000" target="_blank" rel="noopener"
           class="flex items-center justify-between bg-white rounded-sm shadow-sm px-4 py-4 text-sm hover:shadow-md transition-shadow">
            Contacter le support WhatsApp
            <svg class="w-4 h-4 text-bj-noir/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full bg-bj-cuir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-noir transition-colors">
            Se déconnecter
        </button>
    </form>
</section>

@endsection
