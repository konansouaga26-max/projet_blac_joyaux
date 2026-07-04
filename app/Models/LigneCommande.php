<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    protected $table = 'lignes_commande';
    public $timestamps = false;
    protected $fillable = ['commande_id', 'produit_id', 'couleur_id', 'quantite', 'prix_unitaire', 'sous_total'];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class, 'couleur_id');
    }
}
