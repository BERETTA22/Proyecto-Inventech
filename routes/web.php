<?php

use App\Http\Controllers\ChefController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\DespachoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReporteController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsEmployee;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AdminController;
use App\Models\Despacho;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});


// Rutas para el perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

// Rutas para Chefs
Route::middleware('auth')->group(function () {
    Route::get('/chef', [ChefController::class, 'index'])->name('chef.index');
    Route::get('/chef/create', [ChefController::class, 'create'])->name('chef.create');
    Route::post('/chef/store', [ChefController::class, 'store'])->name('chef.store');
    Route::get('/chef/{id}/edit', [ChefController::class, 'edit'])->name('chef.edit');
    Route::put('/chef/{id}', [ChefController::class, 'update'])->name('chef.update');
    Route::delete('/chef/{id}', [ChefController::class, 'destroy'])->name('chef.destroy');
});

// Rutas para Usuarios
Route::get('/usuarios', [AddUserController::class, 'index'])->name('usuarios.ver_usuarios');
Route::get('/usuarios/create', [AddUserController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [AddUserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}/edit', [AddUserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [AddUserController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [AddUserController::class, 'destroy'])->name('usuarios.destroy');

// Rutas para Categorías
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::patch('/categorias/{id}/toggle', [CategoriaController::class, 'toggleEstado'])->name('categorias.toggleEstado');


// Rutas para Multimedia
Route::get('/multimedia', [MultimediaController::class, 'index'])->name('multimedia.index');
Route::post('/multimedia', [MultimediaController::class, 'store'])->name('multimedia.store');
Route::delete('/multimedia/{id}', [MultimediaController::class, 'destroy'])->name('multimedia.destroy');

// Rutas para Dashboard
Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');


// Rutas para Productos
Route::resource('productos', ProductoController::class);
Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::get('/productos/{id}/precio', [ProductoController::class, 'obtenerPrecio']);
Route::patch('/productos/{producto}/toggle-estado', [ProductoController::class, 'toggleEstado'])->name('productos.toggleEstado');
Route::post('/productos/multiple', [ProductoController::class, 'storeMultiple'])->name('productos.storeMultiple');




// Rutas para Tiendas
Route::resource('tiendas', TiendaController::class);


// Rutas para manejar las sucursales de una tienda
Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');
Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('sucursales.create');
Route::post('/sucursales', [SucursalController::class, 'store'])->name('sucursales.store');
Route::get('/sucursales/{sucursal}/edit', [SucursalController::class, 'edit'])->name('sucursales.edit');
Route::put('/sucursales/{sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');
Route::delete('/sucursales/{sucursal}', [SucursalController::class, 'destroy'])->name('sucursales.destroy');

// Ruta para obtener sucursales por tienda, debe ir después de las demás rutas de sucursales
Route::get('/sucursales/{tienda_id}', [DespachoController::class, 'getSucursalesByTienda'])->name('sucursales.getSucursalesByTienda');

// Rutas para Despachos
Route::resource('despachos', DespachoController::class);
Route::get('/despachos/create', [DespachoController::class, 'create'])->name('despachos.create');


Route::post('/despachos/{despacho}/actualizar-stock', [DespachoController::class, 'actualizarStock'])
    ->name('despachos.actualizarStock');







Route::middleware(['auth', 'role.redirect'])->get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

Route::middleware(['auth'])->get('/empleados/dashboard', [DashboardController::class, 'empleadoDashboard'])->name('empleados.dashboard');



// administrar notificaciones
Route::middleware(['auth'])->group(function () {
    Route::get('/notificaciones', [NotificationController::class, 'index']);
    Route::post('/notificaciones/mark-as-read/{id}', [NotificationController::class, 'markAsRead']);
    Route::post('/notificaciones/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
});



Route::get('/empleados/despachos/mis-despachos', [DespachoController::class, 'misDespachos'])
    ->name('empleados.despachos.mis-despachos')
    ->middleware('auth'); // Opcional para asegurar autenticación

Route::get('/empleados/despachos/{id}', [DespachoController::class, 'detalle'])->name('empleados.despachos.detalle');
Route::get('/empleados/despachos/{despacho_id}/producto/{producto_id}/reportar', [DespachoController::class, 'reportarProblema'])->name('empleados.despachos.reportar');
Route::put('/empleados/despachos/{id}/estado', [DespachoController::class, 'actualizarEstado'])
    ->name('empleados.despachos.actualizarEstado');



    Route::middleware(['auth'])->group(function () {
        Route::get('/empleados/dashboard', [EmployeeController::class, 'index'])->name('empleados.dashboard');
    });
    

    

    // Obtener notificaciones no leídas
Route::get('/notificaciones', [NotificationController::class, 'index'])->middleware('auth');

// Marcar una notificación como leída
Route::post('/notificaciones/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->middleware('auth');

// Marcar todas las notificaciones como leídas
Route::post('/notificaciones/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->middleware('auth');


Route::post('/reportes', [ReporteController::class, 'reportarProblema'])->name('reportes.store');


Route::get('/reportes/{id}', [ReporteController::class, 'verReporte'])->name('reportes.show');


Route::get('/reportedespachos', function () {
    return view('reportedespachos.index'); // o el nombre real de tu vista blade
})->name('reportedespachos.index');









Route::get('/error', function () {
    return view('error');
});



// Incluye las rutas de autenticación
require __DIR__ . '/auth.php';
