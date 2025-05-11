<?php

// app/Models/Localite.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    use HasFactory;

    protected $table = 'localite';
    protected $fillable = ['type_localite_id', 'nom'];

    public function typeLocalite()
    {
        return $this->belongsTo(TypeLocalite::class, 'type_localite_id');
    }

    public function actesNaissance()
    {
        return $this->hasMany(ActeNaissance::class, 'localite_id');
    }

    public function actesMariage()
    {
        return $this->hasMany(ActeMariage::class);
    }
}
