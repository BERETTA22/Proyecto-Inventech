<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDespacho
 */
class Despacho extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad_total', 'precio_total', 'fecha', 'id_sucursal', 'estado', 'comentarios', 'empleado_id'
    ];

    // Relación con Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id');
    }

    // Relación con Producto (a través de la tabla pivote)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_despacho')
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'empleado_id', 'id');
    }

    // Relación con el empleado (usuario)
    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }


}
