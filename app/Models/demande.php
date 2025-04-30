<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;



class demande extends Model
{
    protected $fillable = [
        'statut',
        'user_id',
        'mairie_id',
        
        'acte_id',
     ];
    
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mairies(): BelongsTo
    {
        return $this->belongsTo(mairie::class);
    }

    public function actedoc(): HasMany
    {
        return $this->hasMany(acte_doc::class);
    }

    public function paiements(): HasOne
    {
        return $this->hasOne(paiement::class);
    }

    // public function acte(): BelongsTo
    // {
    //     return $this->belongsTo(acte_type::class);
    // }
    
}
