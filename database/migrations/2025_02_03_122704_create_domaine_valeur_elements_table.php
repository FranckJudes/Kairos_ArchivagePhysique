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
        Schema::create('domaine_valeur_elements', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('libele');
            $table->enum('type',['0','1'])->default('0'); //1 canot delete // 0 can delete.
            $table->foreignUuid('id_domaine')->constrained('domaine_valeurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaine_valeur_elements');
    }
};
