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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidad');
            $table->decimal('precio', 25, 2);
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_multimedia');
            $table->dateTime('fecha');
            $table->timestamps();
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('id_multimedia')->references('id')->on('multimedia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
