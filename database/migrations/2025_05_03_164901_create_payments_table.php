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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('demande_id')->constrained()->onDelete('cascade');
            $table->string('pays');
            $table->string('operateur'); // MTN, MOOV, ou ORANGE
            $table->string('numero_telephone');
            $table->decimal('montant', 10, 2);
            $table->string('reference_transaction')->nullable();
            $table->enum('statut', ['en_attente', 'succès', 'échec'])->default('en_attente');
            $table->timestamp('date_paiement')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};