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
        Schema::create('jour_feriers', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); // Empêche les doublons de dates
            $table->string('nom')->nullable(); // Nom du jour férié (ex : "Noël", "Jour de l'Indépendance")
            $table->boolean('recurrent')->default(false); // Si le jour férié se répète chaque année
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jour_feriers');
    }
};
