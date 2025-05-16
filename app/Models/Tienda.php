<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTienda
 */
class Tienda extends Model
{
    use HasFactory;

    // Definir la tabla asociada a este modelo
    protected $table = 'tiendas';

    // Definir las columnas que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];

    // Si necesitas definir una relación con las sucursales, puedes agregar lo siguiente:
    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'tienda_id', 'id');
    }
}
