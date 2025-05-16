<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperReporte
 */
class Reporte extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'empleado_id', 'descripcion', 'estado', 'despacho_id'];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación con el empleado que reportó el problema
    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }
    public function despacho()
{
    return $this->belongsTo(Despacho::class);
}

}

