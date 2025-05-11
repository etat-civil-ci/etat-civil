<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifierTableDemandes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprimer d'abord la contrainte de clé étrangère existante
            $table->dropForeign(['acte_id']);
            
            // Modifier la colonne acte_id pour qu'elle n'ait pas de contrainte de clé étrangère
            $table->bigInteger('acte_id')->unsigned()->nullable()->change();
            
            // Ajouter une nouvelle colonne pour le type d'acte référencé
            $table->string('acte_type')->nullable()->after('acte_id');
            
            // Ajouter un champ pour stocker la date de décès pour les actes de décès
            $table->date('date_deces')->nullable()->after('date_acte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprimer les nouvelles colonnes
            $table->dropColumn(['acte_type', 'date_deces']);
            
            // Rétablir la contrainte de clé étrangère
            $table->foreign('acte_id')->references('id')->on('acte_naissance')->onDelete('set null');
        });
    }
}