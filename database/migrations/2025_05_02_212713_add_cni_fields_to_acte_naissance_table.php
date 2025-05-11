<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->string('numero_cni_pere', 50)
                  ->nullable()
                  ->after('profession_pere');
                  
            $table->string('numero_cni_mere', 50)
                  ->nullable()
                  ->after('profession_mere');
        });
    }

    public function down()
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->dropColumn(['numero_cni_pere', 'numero_cni_mere']);
        });
    }
};