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
        Schema::create('objectifs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('activite')->constrained('domaine_valeur_elements')->onDelete('cascade');
            $table->foreignId('typologie')->constrained('domaine_valeur_elements')->onDelete('cascade');
            $table->string('valeur_cible')->nullable();
            $table->foreignId('unites')->constrained('domaine_valeur_elements')->onDelete('cascade');
            $table->foreignId('periodicite')->constrained('domaine_valeur_elements')->onDelete('cascade');
            $table->text('commentaires')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectifs');
    }
};
