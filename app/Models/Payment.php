<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'demande_id',
        'pays',
        'operateur',
        'numero_telephone',
        'montant',
        'reference_transaction',
        'statut',
        'date_paiement'
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
        'montant' => 'decimal:2'
    ];

    /**
     * Obtenir l'utilisateur associé au paiement
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir la demande associée au paiement
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class);
    }
}