<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citoyen extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'nationalite',
        'situation_familiale',
        'nombre_enfants',
        'profession',
        'situation_professionnelle',
    ];

}
