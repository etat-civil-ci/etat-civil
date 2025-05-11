<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acte_mariage', function (Blueprint $table) {
            $table->id();
            
            // Informations sur les époux
            $table->string('nom_epoux');
            $table->string('prenom_epoux');
            $table->date('date_naissance_epoux');
            $table->string('lieu_naissance_epoux');
            $table->string('numero_cni_epoux');
            $table->string('domicile_epoux');
            $table->string('profession_epoux');
            
            $table->string('nom_epouse');
            $table->string('prenom_epouse');
            $table->date('date_naissance_epouse');
            $table->string('lieu_naissance_epouse');
            $table->string('numero_cni_epouse');
            $table->string('domicile_epouse');
            $table->string('profession_epouse');
            
            // Informations sur le mariage
            $table->date('date_mariage');
            $table->string('lieu_mariage');
            $table->foreignId('localite_id')->constrained('localite');
            
            // Informations sur les témoins
            $table->string('nom_temoin1');
            $table->string('prenom_temoin1');
            $table->string('numero_cni_temoin1');
            
            $table->string('nom_temoin2');
            $table->string('prenom_temoin2');
            $table->string('numero_cni_temoin2');
            
            // Documents requis (chemins vers les fichiers)
            $table->string('extrait_naissance_epoux');
            $table->string('extrait_naissance_epouse');
            $table->string('photo_epoux');
            $table->string('photo_epouse');
            $table->string('certificat_residence_epoux');
            $table->string('certificat_residence_epouse');
            
            // Informations administratives
            $table->string('numero_acte')->unique();
            $table->enum('statut', ['en cours', 'succès', 'échec'])->default('en cours');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_mariage');
    }
};