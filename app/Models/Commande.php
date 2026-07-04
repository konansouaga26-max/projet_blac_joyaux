<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';
    protected $fillable = [
        'user_id', 'adresse_id', 'reference', 'statut', 'total', 'frais_livraison',
        'mode_paiement', 'operateur_mobile', 'numero_mobile', 'mode_livraison',
        'nom_destinataire', 'telephone_livraison', 'adresse_livraison',
        'ville_livraison', 'commune_livraison', 'delai_livraison', 'whatsapp_envoye',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommande::class, 'commande_id');
    }

    public function codesPromo()
    {
        return $this->belongsToMany(CodePromo::class, 'commande_code_promo')
                    ->withPivot('reduction_appliquee');
    }

    // Génère une référence unique type BJ-2026-0001
    public static function genererReference(): string
    {
        $numero = str_pad((self::count() + 1), 4, '0', STR_PAD_LEFT);
        return 'BJ-' . date('Y') . '-' . $numero;
    }
}
