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
        Schema::create('domaine_valeurs', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('libele')->unique();
            $table->string('description');
            $table->enum('type',['0','1','2'])->default('0');  // 0 can delete. //1 canot delete // 2 is folder_state
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaine_valeurs');
    }
};
