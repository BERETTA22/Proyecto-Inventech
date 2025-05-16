<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    /**
     * Obtiene los productos más despachados para la gráfica
     */
    public function productosMasDespachados()
    {
        $productosMasDespachados = DB::table('producto_despacho')
            ->join('productos', 'producto_despacho.producto_id', '=', 'productos.id')
            ->select(
                'productos.nombre as nombre',
                DB::raw('SUM(producto_despacho.cantidad) as cantidad_despachada')
            )
            ->groupBy('productos.nombre')
            ->orderByDesc('cantidad_despachada')
            ->take(5)
            ->get();

        return response()->json($productosMasDespachados);
    }

    /**
     * Obtiene el stock de productos para la gráfica
     */
    public function productosEnStock()
    {
        // Asegúrate de usar el nombre correcto de la columna que almacena el stock
        // Aquí estoy usando 'cantidad', pero podría ser otro nombre en tu base de datos
        $productosStock = DB::table('productos')
            ->select('nombre', 'cantidad as cantidad')
            ->orderByDesc('cantidad')
            ->take(5)
            ->get();

        return response()->json($productosStock);
    }
}
