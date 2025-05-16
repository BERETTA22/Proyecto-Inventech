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
        Schema::create('chef', function (Blueprint $table) {
            $table->id();
            $table->String('Nombre');
            $table->String('Nacionalidad');
            $table->String('Especialidad');
            $table->integer('Años_experiencia');
            $table->String('Restaurante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef');
    }
};
