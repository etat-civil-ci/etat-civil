<?php

// database/migrations/[timestamp]_create_acte_naissance_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('acte_naissance', function (Blueprint $table) {
            $table->id();
            $table->string('filiation', 100);
            $table->string('nom_demandeur', 100);
            $table->string('prenom_demandeur', 100);
            $table->date('date_naissance');
            $table->date('date_acte');
            $table->string('nom_enfant', 100);
            $table->string('prenom_enfant', 100);
            $table->string('lieu_naissance', 100);
            $table->foreignId('localite_id')->constrained('localite');
            $table->string('nom_pere', 100)->nullable();
            $table->string('prenom_pere', 100)->nullable();
            $table->string('domicile_pere', 255)->nullable();
            $table->string('profession_pere', 100)->nullable();
            $table->string('nom_mere', 100);
            $table->string('prenom_mere', 100);
            $table->string('domicile_mere', 255)->nullable();
            $table->string('profession_mere', 100)->nullable();
            $table->string('numero_acte', 50)->unique();
            $table->enum('statut', ['en cours', 'succès', 'échec'])->default('en cours');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acte_naissance');
    }
};