<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con productos
            $table->foreignId('empleado_id')->constrained('users')->onDelete('cascade'); // Relación con empleados (usuarios)
            $table->text('descripcion'); // Descripción del problema
            $table->enum('estado', ['pendiente', 'revisado', 'resuelto'])->default('pendiente'); // Estado del reporte
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes');
    }
};

