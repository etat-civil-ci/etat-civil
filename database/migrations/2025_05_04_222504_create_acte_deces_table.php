<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('acte_deces', function (Blueprint $table) {
            $table->id();
            $table->string('filiation', 100);
            $table->string('nom_declarant', 100);
            $table->string('prenom_declarant', 100);
            $table->date('date_deces');
            $table->date('date_acte');
            $table->string('nom_defunt', 100);
            $table->string('prenom_defunt', 100);
            $table->string('lieu_deces', 100);
            
            // Correction: référence explicite à la table localite (au singulier)
            $table->unsignedBigInteger('localite_id');
            $table->foreign('localite_id')->references('id')->on('localite');
            
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance', 100)->nullable();
            
            // Champ pour le type de parent
            $table->enum('type_parent', ['père', 'mère'])->nullable();
            
            $table->string('nom_parent', 100)->nullable();
            $table->string('prenom_parent', 100)->nullable();
            $table->string('cause_deces', 255)->nullable();
            $table->string('numero_acte', 50)->unique();
            $table->enum('statut', ['en cours', 'succès', 'échec'])->default('en cours');
            $table->text('documents')->nullable();
            
            // Ajout de la clé étrangère vers la table users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('acte_deces', function (Blueprint $table) {
            $table->dropForeign(['localite_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('acte_deces');
    }
};