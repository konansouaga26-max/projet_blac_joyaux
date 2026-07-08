<footer class="bg-bj-noir text-bj-creme mt-16">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <img src="{{ asset('images/logo-footer-or-uni.png') }}" alt="Blac Joyaux"
                class="h-16 w-auto mb-4 object-contain">
            <p class="text-sm text-bj-creme/70 leading-relaxed">
                Maroquinerie artisanale ivoirienne inspirée de la poupée Joyaux de Bla,
                symbole de féminité et d'héritage. Chaque sac raconte une histoire.
            </p>
        </div>
        <div>
            <h4 class="uppercase text-sm tracking-widest text-bj-or mb-4">Navigation</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/boutique') }}" class="hover:text-bj-or">Boutique</a></li>
                <li><a href="{{ url('/essayage') }}" class="hover:text-bj-or">Essayage virtuel</a></li>
                <li><a href="{{ url('/compte') }}" class="hover:text-bj-or">Mon compte</a></li>
                <li><a href="{{ url('/panier') }}" class="hover:text-bj-or">Mon panier</a></li>
            </ul>
        </div>
        <div>
            <h4 class="uppercase text-sm tracking-widest text-bj-or mb-4">Contact</h4>
            <ul class="space-y-2 text-sm text-bj-creme/80">
                <li>Abidjan, Côte d'Ivoire</li>
                <li>WhatsApp : +225 00 00 00 00 00 {{-- TODO: numéro réel --}}</li>
                <li>contact@blacjoyaux.ci</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10 py-4 text-center text-xs text-bj-creme/50">
        © {{ date('Y') }} Blac Joyaux — Tous droits réservés | Projet Mode Agence IFRAN
    </div>
</footer>
