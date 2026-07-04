<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduit extends Model
{
    protected $table = 'images_produit';
    public $timestamps = false;
    protected $fillable = ['produit_id', 'url', 'principale', 'ordre'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
