<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_despachos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespachosTable extends Migration
{
    public function up()
    {
        Schema::create('despachos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_total')->nullable();
            $table->decimal('precio_total', 25, 2);
            $table->date('fecha');
            $table->unsignedBigInteger('id_sucursal');
            $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDelete('cascade');
            $table->string('estado')->default('pendiente');
            $table->text('comentarios')->nullable();        
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('despachos');
    }
}
