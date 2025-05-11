<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeMariage extends Model
{
    use HasFactory;

    protected $table = 'acte_mariage';

    protected $fillable = [
        'nom_epoux',
        'prenom_epoux',
        'date_naissance_epoux',
        'lieu_naissance_epoux',
        'numero_cni_epoux',
        'domicile_epoux',
        'profession_epoux',
        'nom_epouse',
        'prenom_epouse',
        'date_naissance_epouse',
        'lieu_naissance_epouse',
        'numero_cni_epouse',
        'domicile_epouse',
        'profession_epouse',
        'date_mariage',
        'lieu_mariage',
        'localite_id',
        'nom_temoin1',
        'prenom_temoin1',
        'numero_cni_temoin1',
        'nom_temoin2',
        'prenom_temoin2',
        'numero_cni_temoin2',
        'extrait_naissance_epoux',
        'extrait_naissance_epouse',
        'photo_epoux',
        'photo_epouse',
        'certificat_residence_epoux',
        'certificat_residence_epouse',
        'date_acte',
        'numero_acte',
        'statut'
    ];

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }
}