<?php

// app/Models/ActeNaissance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeNaissance extends Model
{
    use HasFactory;

    protected $table = 'acte_naissance';
    protected $fillable = [
        'filiation',
        'nom_demandeur',
        'prenom_demandeur',
        'date_naissance',
        'date_acte',
        'nom_enfant',
        'prenom_enfant',
        'lieu_naissance',
        'localite_id',
        'nom_pere',
        'prenom_pere',
        'domicile_pere',
        'profession_pere',
        'numero_cni_pere',
        'nom_mere',
        'prenom_mere',
        'domicile_mere',
        'profession_mere',
        'numero_cni_mere',
        'numero_acte',
        'statut',
        'documents'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_acte' => 'date',
    ];

    public function localite()
    {
        return $this->belongsTo(Localite::class, 'localite_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($acte) {
            $acte->numero_acte = 'AN-' . date('Y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        });
    }
}
