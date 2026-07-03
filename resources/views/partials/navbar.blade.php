<header class="sticky top-0 z-40 bg-bj-noir text-bj-creme shadow-md">
    <nav class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <button data-collapse-toggle="menu-mobile" type="button"
                class="md:hidden inline-flex items-center p-2 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-bj-or"
                aria-controls="menu-mobile" aria-expanded="false">
            <span class="sr-only">Ouvrir le menu</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/logo-blac-joyaux.jpeg') }}" alt="Logo Blac Joyaux"
                 class="w-9 h-9 rounded-full object-cover border border-bj-or">
            <span class="font-titre text-xl tracking-widest uppercase">Blac <span class="text-bj-or">Joyaux</span></span>
        </a>
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium uppercase tracking-wide">
            <li><a href="{{ url('/') }}" class="hover:text-bj-or transition-colors">Accueil</a></li>
            <li><a href="{{ url('/boutique') }}" class="hover:text-bj-or transition-colors">Boutique</a></li>
            <li><a href="{{ url('/essayage') }}" class="hover:text-bj-or transition-colors">Essayage</a></li>
            <li><button data-modal-target="modal-histoire" data-modal-toggle="modal-histoire"
                        class="uppercase hover:text-bj-or transition-colors">Notre Histoire</button></li>
        </ul>
        <div class="flex items-center gap-4">
            <a href="{{ url('/compte') }}" class="hover:text-bj-or transition-colors" aria-label="Mon compte">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"/></svg>
            </a>
            <a href="{{ url('/panier') }}" class="relative hover:text-bj-or transition-colors" aria-label="Mon panier">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.5l2.1 12.3a1.5 1.5 0 001.48 1.2h9.94a1.5 1.5 0 001.47-1.17L20.7 7.5H5.1M9 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm8.25 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>
                <span id="badge-panier" class="absolute -top-2 -right-2 bg-bj-or text-bj-noir text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">0</span>
            </a>
        </div>
    </nav>
    <div id="menu-mobile" class="hidden md:hidden bg-bj-noir border-t border-white/10">
        <ul class="flex flex-col px-4 py-3 gap-1 text-sm uppercase tracking-wide">
            <li><a href="{{ url('/') }}" class="block py-2.5 px-2 rounded hover:bg-white/10">Accueil</a></li>
            <li><a href="{{ url('/boutique') }}" class="block py-2.5 px-2 rounded hover:bg-white/10">Boutique</a></li>
            <li><a href="{{ url('/essayage') }}" class="block py-2.5 px-2 rounded hover:bg-white/10">Essayage virtuel</a></li>
            <li><button data-modal-target="modal-histoire" data-modal-toggle="modal-histoire"
                        class="block w-full text-left py-2.5 px-2 rounded uppercase hover:bg-white/10">Notre Histoire</button></li>
            <li><a href="{{ url('/connexion') }}" class="block py-2.5 px-2 rounded text-bj-or hover:bg-white/10">Connexion</a></li>
        </ul>
    </div>
</header>
