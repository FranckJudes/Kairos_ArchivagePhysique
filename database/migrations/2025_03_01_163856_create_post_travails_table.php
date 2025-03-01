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
        Schema::create('post_travails', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('intitule');
            $table->string('description')->nullable();
            $table->foreignId('entite_id')->constrained('entite_organisations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_travails');
    }
};
