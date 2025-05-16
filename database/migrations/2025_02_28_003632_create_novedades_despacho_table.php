<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('novedades_despacho', function (Blueprint $table) {
            $table->id();
            $table->foreignId('despacho_id')->constrained('despachos')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('empleado_id')->constrained('users')->onDelete('cascade');
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('novedades_despacho');
    }
};

