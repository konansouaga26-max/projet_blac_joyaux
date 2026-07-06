@extends('layouts.app')

@section('title', ($produit ? 'Modifier' : 'Ajouter') . ' un produit — Admin Blac Joyaux')

@section('content')

<section class="max-w-2xl mx-auto px-4 py-10">
    <div class="mb-8">
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-bj-noir/60 hover:text-bj-cuir">← Retour au tableau de bord</a>
        <h1 class="font-titre text-3xl mt-2">{{ $produit ? 'Modifier : ' . $produit->nom : 'Ajouter un produit' }}</h1>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 text-sm rounded-sm px-4 py-3 mb-6">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $erreur)
            <li>{{ $erreur }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST"
          action="{{ $produit ? route('admin.produit.majour', $produit) : route('admin.produit.enregistrer') }}"
          class="space-y-5 bg-white rounded-sm shadow-sm p-6">
        @csrf

        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Nom du produit *</label>
            <input type="text" name="nom" required value="{{ old('nom', $produit?->nom) }}"
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Catégorie *</label>
            <select name="categorie_id" required
                    class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm bg-white focus:outline-none focus:border-bj-or">
                <option value="">Choisir une catégorie</option>
                @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}"
                        {{ old('categorie_id', $produit?->categorie_id) == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Prix (FCFA) *</label>
                <input type="number" name="prix" required min="0" step="500" value="{{ old('prix', $produit?->prix ? (int) $produit->prix : '') }}"
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Stock *</label>
                <input type="number" name="stock" required min="0" value="{{ old('stock', $produit?->stock ?? 0) }}"
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">{{ old('description', $produit?->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Histoire / accroche</label>
            <input type="text" name="histoire" value="{{ old('histoire', $produit?->histoire) }}"
                   class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Matière</label>
                <input type="text" name="matiere" value="{{ old('matiere', $produit?->matiere) }}"
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest text-bj-cuir mb-1.5">Dimensions</label>
                <input type="text" name="dimensions" placeholder="ex : 32 x 24 x 10 cm" value="{{ old('dimensions', $produit?->dimensions) }}"
                       class="w-full border border-bj-noir/20 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-bj-or">
            </div>
        </div>

        @if ($produit)
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="disponible" value="1" {{ old('disponible', $produit->disponible) ? 'checked' : '' }}
                   class="w-4 h-4 text-bj-cuir focus:ring-bj-or rounded-sm">
            Produit disponible à la vente
        </label>
        @endif

        <button type="submit"
                class="w-full bg-bj-noir text-bj-creme uppercase tracking-wide text-sm py-3.5 rounded-sm hover:bg-bj-cuir transition-colors">
            {{ $produit ? 'Enregistrer les modifications' : 'Ajouter le produit' }}
        </button>
    </form>
</section>

@endsection
