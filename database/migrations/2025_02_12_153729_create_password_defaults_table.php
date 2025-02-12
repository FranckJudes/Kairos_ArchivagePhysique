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
        Schema::create('password_defaults', function (Blueprint $table) {
            $table->id();
            $table->string('libele');
            $table->string('valeur');
            $table->string('description');
            $table->enum('type',['0','1'])->default('0');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_defaults');
    }
};
