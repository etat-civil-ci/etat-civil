<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Type d'acte demandé
            $table->enum('type_acte', ['naissance', 'mariage', 'deces']);
            
            // Référence à l'acte (numéro + date pour vérification)
            $table->string('numero_acte');
            $table->date('date_acte');
            
            // Nombre de copies
            $table->integer('nombre_copie')->default(1);
            
            // Suivi de la demande
            $table->enum('statut', ['en_attente', 'traitee', 'rejetee'])->default('en_attente');
            $table->text('motif_rejet')->nullable();
            
            $table->timestamps();
            
            // Index pour les recherches
            $table->index(['numero_acte', 'date_acte']);
            $table->index('type_acte');
        });
    }

    public function down()
    {
        Schema::dropIfExists('demandes');
    }
};