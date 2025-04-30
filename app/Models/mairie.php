<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class mairie extends Model
{
    protected $fillable = [
       'name',
       'localisation',
       'contact',
    ];

    public function demandeMairie(): HasMany
    {
        return $this->hasMany(demande::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function statict(): HasMany
    {
        return $this->hasMany(statistique::class);
    }
}
