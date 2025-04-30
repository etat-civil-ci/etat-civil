<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class statistique extends Model
{
    protected $fillable = [
        'periode',
        'mairie_id',
    ];

    public function maire(): BelongsTo{
        return $this->belongsTo(mairie::class);
    }
}
