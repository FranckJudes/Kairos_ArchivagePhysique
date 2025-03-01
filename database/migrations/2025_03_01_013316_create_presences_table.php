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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervenant_id')->constrained('intervenants')->onDelete('cascade'); // ✅ Clé étrangère correcte
            $table->date('date'); // Date de présence
            $table->time('heure_arrivee')->nullable(); // Heure d’arrivée
            $table->time('heure_depart')->nullable(); // Heure de départ
            $table->enum('justification',['0','1'])->default(0); // 0 - Non justifié, 1 - Justifié
            $table->enum('presentOrAbsent',['0','1'])->default(0); // 0 - Absent, 1 - Présent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
