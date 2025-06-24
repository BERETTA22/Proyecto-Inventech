<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperCategoria
 */
class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'estado']; // Asegúrate de proteger los campos que se pueden asignar masivamente.
    
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}
