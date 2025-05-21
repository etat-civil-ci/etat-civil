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
        Schema::table('demandes', function (Blueprint $table) {
           $table->foreignId('localite_id')
                  ->nullable()
                  ->constrained('localite') 
                  ->onDelete('set null');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprime la contrainte de clé étrangère d'abord
            $table->dropConstrainedForeignId('localite_id');
            // Ensuite, supprime la colonne
            $table->dropColumn('localite_id');
        });
    }
};
