@extends('layouts.app')


@section('title', "L'Héritière — Blac Joyaux")


@section('content')


<section class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">


    <div>
        <div id="carousel-produit" class="relative" data-carousel="static">
            <div class="relative overflow-hidden rounded-sm aspect-square bg-bj-sable">
                <div class="duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('images/sac-heritiere.jpeg') }}" class="absolute block w-full h-full object-cover" alt="L'Héritière vue 1">
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/sac-hero.jpeg') }}" class="absolute block w-full h-full object-cover" alt="L'Héritière vue 2">
                </div>
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-3 left-1/2 space-x-2">
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-bj-or" aria-current="true" data-carousel-slide-to="0"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/70" data-carousel-slide-to="1"></button>
            </div>
            <button type="button" class="absolute top-1/2 -translate-y-1/2 left-2 z-30 w-9 h-9 rounded-full bg-white/80 flex items-center justify-center" data-carousel-prev>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" class="absolute top-1/2 -translate-y-1/2 right-2 z-30 w-9 h-9 rounded-full bg-white/80 flex items-center justify-center" data-carousel-next>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>


    <div>
        <h1 class="font-titre text-3xl md:text-4xl mb-1">L'Héritière</h1>
        <p class="text-bj-noir/60 mb-3">Le sac de la lady boss élégante</p>
        <p class="text-2xl font-semibold text-bj-cuir mb-2">95 000 FCFA</p>


        <div class="flex items-center gap-1 mb-6">
            @for ($i = 1; $i <= 5; $i++)
            <svg class="w-5 h-5 {{ $i <= 4 ? 'text-bj-or' : 'text-bj-noir/20' }}" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
            </svg>
            @endfor
            <span class="text-sm text-bj-noir/50 ml-2">(12 avis)</span>
        </div>


        <p class="uppercase text-xs tracking-widest mb-2">Couleur</p>
        <div class="flex gap-3 mb-6" id="choix-couleur">
            @foreach ([['Beige', '#C8A97E'], ['Marron', '#5C3A21'], ['Noir', '#1a1a1a'], ['Bleu', '#1e3a8a']] as $i => $c)
            <button type="button" title="{{ $c[0] }}" data-couleur="{{ $c[0] }}"
                    class="w-9 h-9 rounded-full border-2 transition-all {{ $i === 0 ? 'border-bj-or scale-110' : 'border-transparent' }}"
                    style="background-color: {{ $c[1] }}"
                    onclick="choisirCouleur(this)"></button>
            @endforeach
        </div>


        <p class="text-sm leading-relaxed text-bj-noir/80 mb-8">
            Inspiré de la nouvelle génération d'entrepreneures, L'Héritière est conçu pour transporter
            votre ordinateur et vos documents avec élégance et organisation. Cuir pleine fleur,
            finitions dorées à l'effigie de la poupée Joyaux de Bla.
        </p>


        <div class="flex flex-col gap-3">
            <button data-modal-target="modal-ajout-panier" data-modal-toggle="modal-ajout-panier"
                    class="w-full bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-4 rounded-sm hover:bg-bj-cuir transition-colors">
                Ajouter au panier
            </button>
            <a href="https://wa.me/2250000000000?text=Bonjour%2C%20je%20souhaite%20commander%20le%20sac%20L%27H%C3%A9riti%C3%A8re"
               target="_blank" rel="noopener"
               class="w-full text-center border-2 border-green-500 text-green-600 uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-green-500 hover:text-white transition-colors">
                Commander via WhatsApp
            </a>
            <a href="{{ url('/essayage') }}"
               class="w-full text-center border border-bj-noir/30 uppercase tracking-wide text-sm py-3.5 rounded-sm hover:border-bj-or hover:text-bj-cuir transition-colors">
                Essayage virtuel
            </a>
        </div>
    </div>
</section>


<div id="modal-ajout-panier" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <div class="relative bg-bj-creme rounded-sm shadow-xl p-6 text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="font-titre text-xl mb-2">Ajouté au panier !</h3>
            <p class="text-sm text-bj-noir/70 mb-5">L'Héritière — <span id="couleur-choisie">Beige</span> a été ajouté à votre panier.</p>
            <div class="flex flex-col gap-2">
                <a href="{{ url('/panier') }}" class="bg-bj-noir text-bj-creme text-sm uppercase tracking-wide py-3 rounded-sm hover:bg-bj-cuir">Voir mon panier</a>
                <button data-modal-hide="modal-ajout-panier" class="text-sm text-bj-noir/60 hover:text-bj-noir py-2">Continuer mes achats</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    function choisirCouleur(btn) {
        document.querySelectorAll('#choix-couleur button').forEach(b => b.classList.remove('border-bj-or', 'scale-110'));
        btn.classList.add('border-bj-or', 'scale-110');
        document.getElementById('couleur-choisie').textContent = btn.dataset.couleur;
    }
</script>
@endpush


@endsection
