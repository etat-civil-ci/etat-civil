<?php

namespace Database\Seeders;

// database/seeders/LocaliteSeeder.php
use App\Models\Localite;
use App\Models\TypeLocalite;
use Illuminate\Database\Seeder;

class LocaliteSeeder extends Seeder
{
    public function run()
    {
        $mairie = TypeLocalite::where('nom', 'Mairie')->first();
        $sousPrefecture = TypeLocalite::where('nom', 'Sous-préfecture')->first();

        $mairies = [
            'Abobo', 'Adjamé', 'Cocody', 'Plateau', 'Yopougon',
            'Treichville', 'Marcory', 'Koumassi', 'Port-Bouët', 'Attécoubé',
            'Bingerville', 'Anyama', 'Grand-Bassam', 'Bonoua', 'Jacqueville',
            'Dabou', 'Tiassalé', 'Toumodi', 'Yamoussoukro', 'Bouaké',
            'Korhogo', 'Man', 'San-Pédro', 'Daloa', 'Séguéla',
            'Odienné', 'Bondoukou', 'Abengourou', 'Aboisso', 'Gagnoa',
            'Soubré', 'Divo', 'Issia', 'Lakota', 'Agboville',
            'Adzopé', 'Daoukro', 'Ferkessédougou', 'Guiglo', 'Sinfra'
        ];
        

        $sousPrefectures = [
            'Bingerville', 'Songon', 'Dabou', 'Jacqueville', 'Grand-Bassam',
            'Alépé', 'Agboville', 'Aboisso', 'Adiaké', 'Tiassalé',
            'Azaguié', 'Agou', 'Anyama', 'Bonoua', 'Sikensi',
            'Toumodi', 'Yamoussoukro', 'Bouaflé', 'Bouna', 'Ferkessédougou',
            'Daloa', 'Man', 'Korhogo', 'Odienné', 'Bondoukou',
            'Sinfra', 'Soubré', 'Divo', 'Gagnoa', 'Bangolo',
            'Duékoué', 'Vavoua', 'Séguéla', 'Abengourou', 'Daoukro',
            'Tanda', 'Béoumi', 'Issia', 'Lakota', 'Guiglo'
        ];
        

        foreach ($mairies as $nom) {
            Localite::create([
                'type_localite_id' => $mairie->id,
                'nom' => $nom
            ]);
        }

        foreach ($sousPrefectures as $nom) {
            Localite::create([
                'type_localite_id' => $sousPrefecture->id,
                'nom' => $nom
            ]);
        }
    }
}
