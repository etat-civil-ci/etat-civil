<?php

namespace Database\Seeders;

// database/seeders/TypeLocaliteSeeder.php
use App\Models\TypeLocalite;
use Illuminate\Database\Seeder;

class TypeLocaliteSeeder extends Seeder
{
    public function run()
    {
        TypeLocalite::create(['nom' => 'Mairie']);
        TypeLocalite::create(['nom' => 'Sous-préfecture']);
    }
}
