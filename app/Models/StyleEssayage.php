<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StyleEssayage extends Model
{
    protected $table = 'styles_essayage';
    public $timestamps = false;
    protected $fillable = ['produit_id', 'nom', 'image_url'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
