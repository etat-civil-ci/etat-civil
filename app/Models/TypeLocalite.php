<?php

// app/Models/TypeLocalite.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLocalite extends Model
{
    use HasFactory;

    protected $table = 'type_localite';
    protected $fillable = ['nom'];

    public function localites()
    {
        return $this->hasMany(Localite::class, 'type_localite_id');
    }
}
