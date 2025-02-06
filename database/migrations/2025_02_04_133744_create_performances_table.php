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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('domaine_intervenants', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\DomaineValeurElement::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Intervenant::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['domaine_valeur_element_id', 'intervenant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
        Schema::dropIfExists('domaine_performance');

    }
};
