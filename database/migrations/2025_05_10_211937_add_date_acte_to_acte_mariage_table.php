<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Dans le fichier de migration généré
public function up()
{
    Schema::table('acte_mariage', function (Blueprint $table) {
        $table->date('date_acte')
              ->after('numero_acte')
              ->nullable(); // Temporairement nullable le temps de remplir les données existantes
    });
}

public function down()
{
    Schema::table('acte_mariage', function (Blueprint $table) {
        $table->dropColumn('date_acte');
    });
}
};
