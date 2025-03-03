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
        Schema::create('fiche_travails', function (Blueprint $table) {
            $table->id();
            $table->string('intitule')->nullable();
            $table->string( 'en_jeux')->nullable();
            $table->string('mission')->nullable();
            $table->foreignId('activites')->nullable()->constrained('domaine_valeur_elements')->onDelete('cascade');
            $table->string('lieu_du_poste')->nullable();
            $table->foreignId('post_travail_id')->nullable()->constrained('post_travails')->onDelete('cascade');
            $table->string('condition')->nullable();
            $table->string('horaire')->nullable();
            $table->timestamps();
        });

        Schema::create('domaine_fiche_travails', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\DomaineValeurElement::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\FicheTravail::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['domaine_valeur_element_id', 'fiche_travail_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_travails');
    }
};
