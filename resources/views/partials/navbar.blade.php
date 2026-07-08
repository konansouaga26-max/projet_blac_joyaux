<header id="site-header"
    class="sticky top-0 z-40 bg-bj-creme border-b border-bj-sable transition-transform duration-300">
    <nav class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <button data-collapse-toggle="menu-mobile" type="button"
            class="md:hidden inline-flex items-center p-2 rounded-lg hover:bg-bj-sable focus:outline-none focus:ring-2 focus:ring-bj-violet"
            aria-controls="menu-mobile" aria-expanded="false">
            <span class="sr-only">Ouvrir le menu</span>
            <svg class="w-6 h-6 text-bj-noir" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <a href="{{ url('/') }}" class="flex items-center gap-2 md:mr-auto">
            <img src="{{ asset('images/logo-blac-joyaux.jpeg') }}" alt="Logo Blac Joyaux"
                class="w-9 h-9 rounded-full object-cover border border-bj-violet hidden md:block">
            <span class="font-titre text-xl md:text-2xl tracking-widest uppercase text-bj-violet">Blac Joyaux</span>
        </a>

        <ul class="hidden md:flex items-center gap-8 text-sm font-medium uppercase tracking-wide text-bj-noir mr-6">
            <li><a href="{{ url('/') }}" class="hover:text-bj-violet transition-colors">Accueil</a></li>
            <li><a href="{{ url('/boutique') }}" class="hover:text-bj-violet transition-colors">Boutique</a></li>
            <li><a href="{{ url('/essayage') }}" class="hover:text-bj-violet transition-colors">Essayage</a></li>
            <li><button data-modal-target="modal-histoire" data-modal-toggle="modal-histoire"
                    class="uppercase hover:text-bj-violet transition-colors">Notre Histoire</button></li>
            @auth
            @if (auth()->user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}"
                    class="text-bj-violet hover:text-bj-cuir transition-colors">Admin</a></li>
            @endif
            @endauth
        </ul>

        <div class="flex items-center gap-4 text-bj-cuir relative">
            <div class="relative">
                <button aria-label="Notifications"
                    onclick="document.getElementById('dropdown-notifs').classList.toggle('hidden'); document.getElementById('barre-recherche').classList.add('hidden')"
                    class="hover:text-bj-violet transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
                <div id="dropdown-notifs"
                    class="hidden absolute right-0 top-full mt-3 w-64 bg-white rounded-sm shadow-xl border border-bj-sable p-4 text-sm text-bj-noir/60 z-50">
                    Aucune nouvelle notification pour le moment.
                </div>
            </div>
            <div class="relative">
                <button aria-label="Rechercher"
                    onclick="document.getElementById('barre-recherche').classList.toggle('hidden'); document.getElementById('dropdown-notifs').classList.add('hidden')"
                    class="hover:text-bj-violet transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
                <div id="barre-recherche" class="hidden absolute right-0 top-full mt-3 w-72 bg-white rounded-sm shadow-xl border border-bj-sable z-50">
                    <div class="p-2">
                        <input type="text" id="input-recherche" placeholder="Rechercher un sac..." autocomplete="off" autofocus
                               class="w-full px-3 py-2 text-sm border border-bj-sable rounded-sm focus:outline-none focus:border-bj-violet">
                    </div>
                    <div id="resultats-recherche" class="max-h-80 overflow-y-auto"></div>
                </div>
            </div>
            <a href="{{ url('/compte') }}" class="hidden md:inline-block hover:text-bj-violet transition-colors"
                aria-label="Mon compte">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
                </svg>
            </a>
            <a href="{{ url('/panier') }}" class="hidden md:inline-flex relative hover:text-bj-violet transition-colors"
                aria-label="Mon panier">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.5l2.1 12.3a1.5 1.5 0 001.48 1.2h9.94a1.5 1.5 0 001.47-1.17L20.7 7.5H5.1M9 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm8.25 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <span id="badge-panier"
                    class="absolute -top-2 -right-2 bg-bj-violet text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">{{
                    array_sum(array_column(session('panier', []), 'quantite')) }}</span>
            </a>
        </div>
    </nav>

    {{-- Frise decorative --}}
    <div class="flex justify-center gap-2 py-2 bg-bj-sable/40 text-bj-cuir/40 text-xs select-none overflow-hidden">
        @for ($i = 0; $i < 20; $i++) <span>&#9670;</span>
            @endfor
    </div>

    <div id="menu-mobile" class="hidden md:hidden bg-bj-creme border-t border-bj-sable">
        <ul class="flex flex-col px-4 py-3 gap-1 text-sm uppercase tracking-wide text-bj-noir">
            <li><a href="{{ url('/') }}" class="block py-2.5 px-2 rounded hover:bg-bj-sable">Accueil</a></li>
            <li><a href="{{ url('/boutique') }}" class="block py-2.5 px-2 rounded hover:bg-bj-sable">Boutique</a></li>
            <li><a href="{{ url('/essayage') }}" class="block py-2.5 px-2 rounded hover:bg-bj-sable">Essayage
                    virtuel</a></li>
            <li><button data-modal-target="modal-histoire" data-modal-toggle="modal-histoire"
                    class="block w-full text-left py-2.5 px-2 rounded uppercase hover:bg-bj-sable">Notre
                    Histoire</button></li>
            <li><a href="{{ url('/connexion') }}"
                    class="block py-2.5 px-2 rounded text-bj-violet hover:bg-bj-sable">Connexion</a></li>
        </ul>
    </div>

    <script>
        const inputRecherche = document.getElementById('input-recherche');
        const resultatsRecherche = document.getElementById('resultats-recherche');
        let timerRecherche;
        let derniereListe = [];

        inputRecherche?.addEventListener('input', function () {
            clearTimeout(timerRecherche);
            const terme = this.value.trim();

            if (terme.length < 2) {
                resultatsRecherche.innerHTML = '';
                derniereListe = [];
                return;
            }

            timerRecherche = setTimeout(() => {
                fetch(`{{ route('recherche.suggestions') }}?q=${encodeURIComponent(terme)}`)
                    .then(r => r.json())
                    .then(produits => {
                        derniereListe = produits;
                        if (produits.length === 0) {
                            resultatsRecherche.innerHTML = '<p class="text-sm text-bj-noir/50 px-4 py-4">Aucun sac trouvé.</p>';
                            return;
                        }
                        resultatsRecherche.innerHTML = produits.map(p => `
                            <a href="${p.lien}" class="flex items-center gap-3 px-3 py-2 hover:bg-bj-sable/40 transition-colors border-t border-bj-sable/60">
                                <img src="${p.image}" class="w-12 h-12 object-cover rounded-sm" alt="${p.nom}">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium truncate">${p.nom}</p>
                                    <p class="text-xs text-bj-violet">${p.prix}</p>
                                </div>
                            </a>
                        `).join('');
                    });
            }, 250);
        });

        inputRecherche?.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && derniereListe.length > 0) {
                e.preventDefault();
                window.location.href = derniereListe[0].lien;
            }
        });
    </script>
</header>
<script>
    (function () {
        const header = document.getElementById('site-header');
        let dernierScroll = 0;
        const seuil = 10;

        window.addEventListener('scroll', function () {
            const scrollActuel = window.scrollY;

            if (Math.abs(scrollActuel - dernierScroll) < seuil) return;

            if (scrollActuel > dernierScroll && scrollActuel > header.offsetHeight) {
                // on descend : on cache le header
                header.style.transform = 'translateY(-100%)';
            } else {
                // on remonte : on réaffiche le header
                header.style.transform = 'translateY(0)';
            }

            dernierScroll = scrollActuel;
        }, { passive: true });
    })();
</script>
