<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';
    public $timestamps = false;
    protected $fillable = ['user_id', 'produit_id', 'note', 'commentaire', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
