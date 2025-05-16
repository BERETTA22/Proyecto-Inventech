<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Producto> $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCategoria {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $Nombre
 * @property string $Nacionalidad
 * @property string $Especialidad
 * @property int $Años_experiencia
 * @property string $Restaurante
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereAñosExperiencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereEspecialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereNacionalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereRestaurante($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperChef {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $cantidad_total
 * @property string $precio_total
 * @property string $fecha
 * @property int $id_sucursal
 * @property string $estado
 * @property string|null $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $empleado_id
 * @property-read \App\Models\User|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Producto> $productos
 * @property-read int|null $productos_count
 * @property-read \App\Models\Sucursal $sucursal
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereCantidadTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereIdSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho wherePrecioTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Despacho whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDespacho {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre_archivo
 * @property string $tipo_archivo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Producto> $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia whereNombreArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia whereTipoArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Multimedia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMultimedia {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property int $cantidad
 * @property string $precio
 * @property int $id_categoria
 * @property int $id_multimedia
 * @property string $fecha
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categoria $categoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Despacho> $despachos
 * @property-read int|null $despachos_count
 * @property-read \App\Models\Multimedia $multimedia
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereIdCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereIdMultimedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProducto {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $producto_id
 * @property int $empleado_id
 * @property string $descripcion
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $despacho_id
 * @property-read \App\Models\Despacho|null $despacho
 * @property-read \App\Models\User $empleado
 * @property-read \App\Models\Producto $producto
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereDespachoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reporte whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperReporte {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $descripcion
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $tienda_id
 * @property string $nombre_sucursal
 * @property string $direccion
 * @property string|null $contacto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Despacho> $despachos
 * @property-read int|null $despachos_count
 * @property-read \App\Models\Tienda $tienda
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereNombreSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereTiendaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sucursal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSucursal {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sucursal> $sucursales
 * @property-read int|null $sucursales_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tienda whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTienda {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $role_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Despacho> $despachos
 * @property-read int|null $despachos_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

