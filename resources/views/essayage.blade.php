@extends('layouts.app')

@section('title', 'Essayage Virtuel — Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">
    <div class="text-center mb-6">
        <h1 class="font-titre text-3xl">Essayage Virtuel</h1>
        <p class="text-sm text-bj-cuir mt-1">Visualisez votre sac dans votre quotidien</p>
    </div>

    <div class="flex gap-2 justify-center mb-6" id="filtres-style">
        @foreach (['Style chic', 'Style minimaliste', 'Style décontracté'] as $i => $style)
        <button onclick="choisirStyle(this)"
                class="px-4 py-2 rounded-full text-xs uppercase tracking-wide border transition-colors
                       {{ $i === 0 ? 'bg-bj-cuir text-bj-creme border-bj-cuir' : 'border-bj-noir/20 hover:border-bj-or' }}">
            {{ $style }}
        </button>
        @endforeach
    </div>

    <div class="relative rounded-sm overflow-hidden bg-bj-sable aspect-[3/4] mb-6">
        <img src="{{ asset('images/sac-hero.jpeg') }}" alt="Essayage virtuel" id="image-essayage"
             class="w-full h-full object-cover">
        <button class="absolute top-1/2 -translate-y-1/2 left-2 w-9 h-9 rounded-full bg-white/85 flex items-center justify-center" aria-label="Précédent">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute top-1/2 -translate-y-1/2 right-2 w-9 h-9 rounded-full bg-white/85 flex items-center justify-center" aria-label="Suivant">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    <p class="text-sm mb-3">Choisissez une couleur</p>
    <div class="flex gap-4 mb-8">
        @foreach (['#3B2416', '#E8632C', '#D9A62E'] as $couleur)
        <button class="w-11 h-11 rounded-full border-2 border-transparent hover:border-bj-or hover:scale-110 transition-all"
                style="background-color: {{ $couleur }}" aria-label="Couleur"></button>
        @endforeach
    </div>

    <label class="block w-full text-center bg-bj-cuir text-bj-creme uppercase tracking-wide text-sm py-4 rounded-sm hover:bg-bj-noir transition-colors cursor-pointer">
        Utiliser ma photo
        <input type="file" accept="image/*" class="hidden" onchange="chargerPhoto(this)">
    </label>
    <p class="text-xs text-bj-noir/40 text-center mt-3">
        Votre photo reste sur votre appareil — elle n'est pas envoyée au serveur.
    </p>
</section>

@push('scripts')
<script>
    function choisirStyle(btn) {
        document.querySelectorAll('#filtres-style button').forEach(b => {
            b.classList.remove('bg-bj-cuir', 'text-bj-creme', 'border-bj-cuir');
            b.classList.add('border-bj-noir/20');
        });
        btn.classList.add('bg-bj-cuir', 'text-bj-creme', 'border-bj-cuir');
    }

    function chargerPhoto(input) {
        if (input.files && input.files[0]) {
            document.getElementById('image-essayage').src = URL.createObjectURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection
