<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id(); // Llave primaria
            $table->foreignId('tienda_id') // Relación con la tabla tiendas
                ->constrained('tiendas') // Nombre de la tabla padre
                ->onDelete('cascade'); // Elimina sucursales si se elimina la tienda
            $table->string('nombre_sucursal'); // Nombre de la sucursal
            $table->string('direccion'); // Dirección de la sucursal
            $table->string('contacto')->nullable(); // Contacto, puede ser nulo
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
