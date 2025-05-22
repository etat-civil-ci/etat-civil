<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Localite;
use App\Models\Payment;
use App\Models\DownloadHistory;
use App\Models\Note; // Importez le modèle Note si vous l'utilisez

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
        'localite_id',
        'acte_id',    
        'acte_type',  
        'date_deces',
    ];

    protected $casts = [
        'date_acte' => 'date',
        'date_deces' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }

     public function payment()
    {
        return $this->hasOne(Payment::class, 'demande_id');
    }

    public function downloadHistory()
    {
        return $this->hasMany(DownloadHistory::class, 'demande_id');
    }

    // public function notes()
    // {
    //     return $this->hasMany(Note::class, 'demande_id');
    // }

    public function acte()
    {
        return $this->morphTo();
    }

}