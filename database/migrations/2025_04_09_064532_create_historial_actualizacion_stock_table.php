<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historial_actualizacion_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('despacho_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad_despachada');
            $table->foreignId('actualizado_por')->constrained('users')->onDelete('cascade');
            $table->timestamp('fecha_actualizacion')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_actualizacion_stock');
    }
};
