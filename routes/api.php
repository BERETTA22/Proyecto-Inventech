<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadisticasController;


Route::prefix('v1')->group(function () {
    Route::get('/estadisticas/productosmasdespachados', [EstadisticasController::class, 'productosMasDespachados'])->name('api.productosmasdespachados');
    Route::get('/estadisticas/productosenstock', [EstadisticasController::class, 'productosEnStock'])->name('api.productosenstock');
});

Route::get('/test', function () {
    return response()->json(['mensaje' => 'Funciona la API']);
});





