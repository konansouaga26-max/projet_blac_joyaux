<nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-bj-sable border-t border-bj-cuir/10">
    <div class="grid grid-cols-5 text-center">
        <a href="{{ url('/') }}"
           class="flex flex-col items-center gap-0.5 py-2.5 {{ request()->is('/') ? 'text-bj-violet' : 'text-bj-cuir/70' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0L22.25 12M4.5 9.75V21a.75.75 0 00.75.75H9.75V15a1.5 1.5 0 011.5-1.5h1.5a1.5 1.5 0 011.5 1.5v6.75h4.5a.75.75 0 00.75-.75V9.75" />
            </svg>
            <span class="text-[10px] uppercase tracking-wide font-medium">Accueil</span>
        </a>
        <a href="{{ url('/boutique') }}"
           class="flex flex-col items-center gap-0.5 py-2.5 {{ request()->is('boutique') ? 'text-bj-violet' : 'text-bj-cuir/70' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m-3 9h13.5a1.5 1.5 0 001.5-1.5V12a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v6a1.5 1.5 0 001.5 1.5z" />
            </svg>
            <span class="text-[10px] uppercase tracking-wide font-medium">Boutique</span>
        </a>
        <a href="{{ url('/favoris') }}"
           class="flex flex-col items-center gap-0.5 py-2.5 {{ request()->is('favoris') ? 'text-bj-violet' : 'text-bj-cuir/70' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            <span class="text-[10px] uppercase tracking-wide font-medium">Favoris</span>
        </a>
        <a href="{{ url('/panier') }}"
           class="relative flex flex-col items-center gap-0.5 py-2.5 {{ request()->is('panier') ? 'text-bj-violet' : 'text-bj-cuir/70' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.5l2.1 12.3a1.5 1.5 0 001.48 1.2h9.94a1.5 1.5 0 001.47-1.17L20.7 7.5H5.1M9 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm8.25 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
            <span class="text-[10px] uppercase tracking-wide font-medium">Panier</span>
            @if (array_sum(array_column(session('panier', []), 'quantite')) > 0)
            <span class="absolute top-1 right-1/4 bg-bj-violet text-white text-[9px] font-bold rounded-full w-3.5 h-3.5 flex items-center justify-center">
                {{ array_sum(array_column(session('panier', []), 'quantite')) }}
            </span>
            @endif
        </a>
        <a href="{{ url('/compte') }}"
           class="flex flex-col items-center gap-0.5 py-2.5 {{ request()->is('compte') ? 'text-bj-violet' : 'text-bj-cuir/70' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
            </svg>
            <span class="text-[10px] uppercase tracking-wide font-medium">Compte</span>
        </a>
    </div>
</nav>
