<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favori extends Model
{
    protected $table = 'favoris';
    public $timestamps = false;
    protected $fillable = ['user_id', 'produit_id', 'created_at'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
