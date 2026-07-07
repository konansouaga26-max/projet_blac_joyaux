@extends('layouts.app')

@section('title', 'Essayage Virtuel — Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">
    <div class="text-center mb-6">
        <h1 class="font-titre text-3xl">Essayage Virtuel</h1>
        <p class="text-sm text-bj-cuir mt-1">Visualisez votre sac dans votre quotidien</p>
    </div>

    @if ($styles->isEmpty())
        <p class="text-center text-bj-noir/50 py-16">Aucun style d'essayage disponible pour le moment.</p>
    @else

    {{-- Filtres de style (dynamiques) --}}
    <div class="flex gap-2 justify-center mb-6 flex-wrap" id="filtres-style">
        @foreach ($styles as $index => $style)
        <button onclick="afficherStyle({{ $index }})" data-index="{{ $index }}"
                class="btn-style px-4 py-2 rounded-full text-xs uppercase tracking-wide border transition-colors
                       {{ $index === 0 ? 'bg-bj-cuir text-bj-creme border-bj-cuir' : 'border-bj-noir/20 hover:border-bj-or' }}">
            {{ $style->nom }}
        </button>
        @endforeach
    </div>

    {{-- Visuel d'essayage --}}
    <div class="relative rounded-sm overflow-hidden bg-bj-sable aspect-4/3 mb-4">
        <img src="{{ asset($styles->first()->image_url) }}" alt="Essayage virtuel" id="image-essayage"
             class="w-full h-full object-cover transition-opacity duration-300">
        <button onclick="styleSuivant(-1)" aria-label="Style précédent"
                class="absolute top-1/2 -translate-y-1/2 left-2 w-9 h-9 rounded-full bg-white/85 flex items-center justify-center hover:bg-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button onclick="styleSuivant(1)" aria-label="Style suivant"
                class="absolute top-1/2 -translate-y-1/2 right-2 w-9 h-9 rounded-full bg-white/85 flex items-center justify-center hover:bg-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    {{-- Produit associé au style affiché --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="font-titre text-lg" id="nom-produit">{{ $styles->first()->produit->nom }}</p>
            <p class="text-sm text-bj-cuir font-semibold" id="prix-produit">
                {{ number_format($styles->first()->produit->prix, 0, ',', ' ') }} FCFA
            </p>
        </div>
        <a href="{{ route('produit.show', $styles->first()->produit->slug) }}" id="lien-produit"
           class="bg-bj-noir text-bj-creme text-xs uppercase tracking-wide px-5 py-2.5 rounded-sm hover:bg-bj-cuir transition-colors">
            Voir le produit
        </a>
    </div>

    {{-- Couleurs du produit affiché --}}
    <p class="text-sm mb-3">Couleurs disponibles</p>
    <div class="flex gap-4 mb-8" id="couleurs-produit">
        @foreach ($styles->first()->produit->couleurs as $couleur)
        <span title="{{ $couleur->nom }}" class="w-11 h-11 rounded-full border-2 border-transparent"
              style="background-color: {{ $couleur->code_hex }}"></span>
        @endforeach
    </div>

    {{-- Utiliser ma photo --}}
    <label class="block w-full text-center bg-bj-cuir text-bj-creme uppercase tracking-wide text-sm py-4 rounded-sm hover:bg-bj-noir transition-colors cursor-pointer">
        Utiliser ma photo
        <input type="file" accept="image/*" class="hidden" onchange="chargerPhoto(this)">
    </label>
    <p class="text-xs text-bj-noir/40 text-center mt-3">
        Votre photo reste sur votre appareil — elle n'est pas envoyée au serveur.
    </p>

    @endif
</section>

@push('scripts')
<script>
    // Données des styles injectées depuis la base
   const styles = @json($stylesJson);

    let styleActuel = 0;

    function afficherStyle(index) {
        styleActuel = (index + styles.length) % styles.length;
        const s = styles[styleActuel];

        // Image (avec petit fondu)
        const img = document.getElementById('image-essayage');
        img.style.opacity = 0;
        setTimeout(() => { img.src = s.image; img.style.opacity = 1; }, 200);

        // Infos produit
        document.getElementById('nom-produit').textContent = s.produit;
        document.getElementById('prix-produit').textContent = s.prix;
        document.getElementById('lien-produit').href = s.lien;

        // Couleurs
        document.getElementById('couleurs-produit').innerHTML = s.couleurs.map(c =>
            `<span title="${c.nom}" class="w-11 h-11 rounded-full border-2 border-transparent" style="background-color: ${c.hex}"></span>`
        ).join('');

        // Boutons de filtre
        document.querySelectorAll('.btn-style').forEach(b => {
            const actif = parseInt(b.dataset.index) === styleActuel;
            b.classList.toggle('bg-bj-cuir', actif);
            b.classList.toggle('text-bj-creme', actif);
            b.classList.toggle('border-bj-cuir', actif);
            b.classList.toggle('border-bj-noir/20', !actif);
        });
    }

    function styleSuivant(delta) {
        afficherStyle(styleActuel + delta);
    }

    // Aperçu de la photo utilisateur (local uniquement)
    function chargerPhoto(input) {
        if (input.files && input.files[0]) {
            document.getElementById('image-essayage').src = URL.createObjectURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection
