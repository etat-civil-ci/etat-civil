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
    Schema::table('demandes', function (Blueprint $table) {
        $table->unsignedBigInteger('acte_id')->nullable()->after('user_id');
        $table->foreign('acte_id')->references('id')->on('acte_naissance')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('demandes', function (Blueprint $table) {
        $table->dropForeign(['acte_id']);
        $table->dropColumn('acte_id');
    });
}
};
