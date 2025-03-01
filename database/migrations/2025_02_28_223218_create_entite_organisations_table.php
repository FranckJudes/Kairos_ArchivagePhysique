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
        Schema::create('entite_organisations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('libele');
            $table->string('description');
            $table->enum('fonction',['1','2','3','4'])->nullable(); //1- service archive // 2- Producteur Archive , 3- Service Versant , 4- Service Archive
            $table->foreignId('type_entity_id')->nullable()->constrained('type_entites')->onDelete('cascade');
            $table->integer('parent_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entite_organisations');
    }
};
