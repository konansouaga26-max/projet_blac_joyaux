<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';
    protected $fillable = [
        'categorie_id', 'nom', 'slug', 'description', 'histoire',
        'prix', 'matiere', 'dimensions', 'stock', 'disponible',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function couleurs()
    {
        return $this->belongsToMany(Couleur::class, 'produit_couleur')
                    ->withPivot('stock_couleur');
    }

    public function images()
    {
        return $this->hasMany(ImageProduit::class, 'produit_id')->orderBy('ordre');
    }

    public function imagePrincipale()
    {
        return $this->hasOne(ImageProduit::class, 'produit_id')->where('principale', true);
    }

    public function stylesEssayage()
    {
        return $this->hasMany(StyleEssayage::class, 'produit_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'produit_id');
    }

    // Note moyenne du produit (pour les étoiles)
    public function noteMoyenne(): float
    {
        return round($this->avis()->avg('note') ?? 0, 1);
    }
}
