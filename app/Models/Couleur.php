<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
    protected $table = 'couleurs';
    public $timestamps = false;
    protected $fillable = ['nom', 'code_hex'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_couleur')
                    ->withPivot('stock_couleur');
    }
}
