<?php

// database/migrations/[timestamp]_create_localite_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('localite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_localite_id')->constrained('type_localite');
            $table->string('nom', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('localite');
    }
};
