<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'acte_id',
        'type_acte',
        'numero_acte', 
        'date_acte',
        'nombre_copie',
        'statut',
    ];

    protected $casts = [
        'date_acte' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec l'acte de naissance
    public function acteNaissance()
    {
        return $this->belongsTo(ActeNaissance::class, 'acte_id');
    }



}