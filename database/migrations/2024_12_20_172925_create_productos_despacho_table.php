<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosDespachoTable extends Migration
{
    public function up()
    {
        Schema::create('producto_despacho', function (Blueprint $table) {
            $table->id();
            $table->foreignId('despacho_id')
                ->constrained('despachos')
                ->onDelete('cascade');
            $table->foreignId('producto_id')
                ->constrained('productos')
                ->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 25, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_despacho');
    }
}
