<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperChef
 */
class Chef extends Model
{
    use HasFactory;

    protected $table = 'chef';

    protected $PrimaryKey = 'id';

    protected $fillable= [
        'Nombre',
        'Nacionalidad',
        'Especialidad',
        'Años_experiencia',
        'Restaurante'
    ];


}
