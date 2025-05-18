<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    if (!Schema::hasColumn('acte_naissance', 'heure_naissance')) {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->time('heure_naissance')->nullable();
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            //
        });
    }
};
