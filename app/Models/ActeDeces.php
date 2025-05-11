<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ActeDeces extends Model
{
    use HasFactory;

    protected $fillable = [
        'filiation',
        'nom_declarant',
        'prenom_declarant',
        'date_deces',
        'date_acte',
        'nom_defunt',
        'prenom_defunt',
        'lieu_deces',
        'localite_id',
        'date_naissance',
        'lieu_naissance',
        'type_parent',
        'nom_parent',
        'prenom_parent',
        'cause_deces',
        'numero_acte',
        'statut',
        'documents',
        'user_id'
    ];

    // Définition des dates pour Laravel
    protected $dates = [
        'date_deces',
        'date_acte',
        'date_naissance',
        'created_at',
        'updated_at'
    ];

    // Accesseur sécurisé pour date_deces
    public function getFormattedDateDecesAttribute()
    {
        return $this->date_deces ? $this->date_deces->format('d/m/Y') : null;
    }

    // Accesseur sécurisé pour date_acte
    public function getFormattedDateActeAttribute()
    {
        return $this->date_acte ? $this->date_acte->format('d/m/Y') : null;
    }

    // Accesseur sécurisé pour date_naissance
    public function getFormattedDateNaissanceAttribute()
    {
        return $this->date_naissance ? $this->date_naissance->format('d/m/Y') : null;
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}