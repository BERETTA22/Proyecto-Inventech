<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @mixin IdeHelperMultimedia
 */
class Multimedia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_archivo','tipo_archivo'];
    
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_multimedia');
    }

}
 