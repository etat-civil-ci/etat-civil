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
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_naissance')->nullable()->after('email');
            $table->enum('genre', ['homme', 'femme', 'autre'])->nullable()->after('date_naissance');
            $table->string('contact')->nullable()->after('genre');
            $table->enum('role', ['citoyen', 'admin', 'officier'])->default('citoyen')->after('contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['date_naissance', 'genre', 'contact', 'role']);
        });
    }
};