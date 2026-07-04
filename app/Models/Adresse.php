<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    protected $table = 'adresses';
    public $timestamps = false;
    protected $fillable = ['user_id', 'adresse', 'ville', 'commune', 'quartier', 'est_principale'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
