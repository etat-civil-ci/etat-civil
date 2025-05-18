<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->string('documents')->nullable()->after('statut');
        });
    }

   public function down()
{
    if (Schema::hasTable('acte_naissance')) {
        Schema::table('acte_naissance', function (Blueprint $table) {
            if (Schema::hasColumn('acte_naissance', 'documents')) {
                $table->dropColumn('documents');
            }
        });
    }
}

};