<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;

class paiement extends Model
{
    protected $fillable = [
        'montant',
        'mode_paiement',
        'statut',
        'transaction_id',
        'demande_id',
    ];
    
    public function achat(): HasOne
    {
        return $this->hasOne(demande::class);
    }

}
