<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class acte_doc extends Model
{
    protected $fillable = [
        'file',
        'demande_id',
    ];

    public function demander(): BelongsTo{
        return $this->belongsTo(demande::class);
    }
}
