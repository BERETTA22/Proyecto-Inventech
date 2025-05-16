<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSucursal
 */
class Sucursal extends Model
{
    use HasFactory;

    // Definir explícitamente el nombre de la tabla
    protected $table = 'sucursales';  // Nombre correcto de la tabla

    protected $fillable = [
        'tienda_id', 'nombre_sucursal', 'direccion', 'contacto'
    ];

    // Relación con la tabla Tiendas
    public function tienda()
{
    return $this->belongsTo(Tienda::class, 'tienda_id', 'id');
}

    
    public function despachos()
    {
        return $this->hasMany(Despacho::class, 'id_sucursal');
    }
}
