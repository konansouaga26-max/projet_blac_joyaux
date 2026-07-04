<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = ['nom', 'slug'];

    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }
}
