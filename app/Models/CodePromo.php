<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodePromo extends Model
{
    protected $table = 'codes_promo';
    public $timestamps = false;
    protected $fillable = ['code', 'reduction_pct', 'reduction_fixe', 'actif', 'date_expiration'];

    // Le code est-il encore utilisable ?
    public function estValide(): bool
    {
        return $this->actif
            && ($this->date_expiration === null || $this->date_expiration >= now()->toDateString());
    }
}
