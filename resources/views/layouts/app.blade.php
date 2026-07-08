<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blac Joyaux — Maroquinerie Ivoirienne')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bj-noir':   '#141414',
                        'bj-cuir':   '#5C3A21',
                        'bj-or':     '#C9A24B',
                        'bj-creme':  '#F7F2EA',
                        'bj-sable':  '#E8DCC8',
                        'bj-violet': '#7C5CA8',
                        'bj-violet-fonce': '#5F4482',
                    },
                    fontFamily: {
                        'titre': ['"Playfair Display"', 'serif'],
                        'texte': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>

<body class="font-texte bg-bj-creme text-bj-noir antialiased pb-16 md:pb-0">
    @include('partials.navbar')
    <main class="min-h-screen">
        @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.bottom-nav')

    <div id="modal-histoire" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-bj-creme rounded-sm shadow-xl">
                <div class="flex items-center justify-between p-5 border-b border-bj-sable">
                    <h3 class="font-titre text-2xl">Notre Histoire</h3>
                    <button type="button" data-modal-hide="modal-histoire"
                        class="text-bj-noir/60 hover:text-bj-noir rounded-lg w-8 h-8 inline-flex justify-center items-center">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 12 12M13 1 1 13" />
                        </svg>
                        <span class="sr-only">Fermer</span>
                    </button>
                </div>
                <div class="p-5 space-y-4 text-sm leading-relaxed">
                    <p>Fondée en 2024 par <strong>Manuela Kouadio</strong>, diplômée en Communication et graphisme, Blac
                        Joyaux est une marque de maroquinerie ivoirienne.</p>
                    <p>Inspirée par la <strong>poupée Joyaux de Bla</strong> — symbole de fécondité ashanti — chaque sac
                        célèbre l'héritage africain avec élégance et modernité.</p>
                    <p>Fabriqués artisanalement à Abidjan, nos sacs sont pensés pour la femme africaine d'aujourd'hui.
                    </p>
                </div>
                <div class="p-5 border-t border-bj-sable">
                    <a href="{{ route('boutique') }}"
                        class="block w-full text-center bg-bj-violet text-white uppercase tracking-wide text-sm py-3 rounded-full hover:bg-bj-violet-fonce transition-colors">
                        Découvrir la collection
                    </a>
                </div>
            </div>
        </div>
    </div>



    {{-- Bouton WhatsApp flottant — TODO: vrai numéro --}}
    <a href="https://wa.me/2250000000000?text=Bonjour%20Blac%20Joyaux%2C%20je%20souhaite%20passer%20une%20commande"
        target="_blank" rel="noopener"
        class="fixed bottom-5 right-5 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-green-500 text-white shadow-lg hover:scale-110 transition-transform"
        aria-label="Commander via WhatsApp">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
    </a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>

</html>
