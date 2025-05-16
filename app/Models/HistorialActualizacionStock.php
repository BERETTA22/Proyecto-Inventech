<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialActualizacionStock extends Model
{
    protected $table = 'historial_actualizacion_stock';

    protected $fillable = [
        'despacho_id',
        'producto_id',
        'cantidad_despachada',
        'actualizado_por',
        'fecha_actualizacion',
    ];

    public $timestamps = false; // Porque usamos timestamp manual
}

