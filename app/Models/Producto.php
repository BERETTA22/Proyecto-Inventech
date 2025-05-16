<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProducto
 */
class Producto extends Model
{
    use  HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad',
        'precio',
        'id_categoria',
        'id_multimedia',
        'fecha',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // Relación con la tabla Multimedia
    public function multimedia()
    {
        return $this->belongsTo(Multimedia::class, 'id_multimedia');
    }

    public function despachos()
    {
        return $this->belongsToMany(Despacho::class, 'producto_despacho')
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }

}
