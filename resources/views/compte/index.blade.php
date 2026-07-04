@extends('layouts.app')

@section('title', 'Mon Compte — Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">

    <div class="text-center mb-10">
        <div class="w-24 h-24 mx-auto rounded-full bg-bj-sable border-2 border-bj-or flex items-center justify-center mb-3 overflow-hidden">
            <svg class="w-12 h-12 text-bj-cuir" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"/>
            </svg>
        </div>
        {{-- Sera dynamique avec auth()->user() en phase back-end --}}
        <h1 class="font-titre text-2xl">Kouadio Fatou</h1>
        <p class="text-sm text-bj-noir/50">fatou.kouadio@email.com</p>
    </div>

    <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-3">Mon compte</h2>
    <div class="space-y-2 mb-8">
        @foreach ([
            ['Mes informations personnelles', '#'],
            ['Mes commandes', '#'],
            ['Mes favoris', url('/favoris')],
            ['Mes adresses de livraison', '#'],
        ] as $item)
        <a href="{{ $item[1] }}"
           class="flex items-center justify-between bg-white rounded-sm shadow-sm px-4 py-4 text-sm hover:shadow-md transition-shadow">
            {{ $item[0] }}
            <svg class="w-4 h-4 text-bj-noir/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @endforeach
    </div>

    <h2 class="uppercase text-xs tracking-widest text-bj-cuir mb-3">Paramètres</h2>
    <div class="space-y-2 mb-10">
        @foreach ([
            ['Notifications', '#'],
            ['Sécurité & mot de passe', '#'],
            ['Contacter le support WhatsApp', 'https://wa.me/2250000000000'],
        ] as $item)
        <a href="{{ $item[1] }}"
           class="flex items-center justify-between bg-white rounded-sm shadow-sm px-4 py-4 text-sm hover:shadow-md transition-shadow">
            {{ $item[0] }}
            <svg class="w-4 h-4 text-bj-noir/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @endforeach
    </div>

   <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full bg-bj-cuir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-noir transition-colors">
        Se déconnecter
    </button>
</form>
</section>

@endsection
