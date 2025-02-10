<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SexeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('intervenants', function (Blueprint $table) {
            $table->id()->index();
            $table->string('matricule')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('date_of_birth')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('profession')->nullable();
            $table->foreignId('fonction')->constrained('domaine_valeur_elements')->onDelete('cascade'); // ✅ Clé étrangère correcte
            $table->string('date_integration')->nullable();
            $table->string('info_connexes')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo_profil')->nullable();
            $table->enum('sex', array_column(SexeEnum::cases(), 'value'))->default(SexeEnum::MASCULIN->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervenants');
    }
};
