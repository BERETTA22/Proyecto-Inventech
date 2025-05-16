<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Despacho;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function adminDashboard()
    {
        $userCount = User::count(); // Total de usuarios
        $categoryCount = Categoria::count(); // Total de categorías
        $productCount = Producto::count(); // Total de productos

        // Productos más despachados
        $productosMasDespachados = DB::table('producto_despacho')
            ->join('productos', 'producto_despacho.producto_id', '=', 'productos.id')
            ->join('despachos', 'producto_despacho.despacho_id', '=', 'despachos.id')
            ->select(
                'productos.nombre as nombre',
                DB::raw('SUM(producto_despacho.cantidad) as cantidad_total'),
                DB::raw('SUM(CASE WHEN DATE(despachos.fecha) = CURDATE() THEN producto_despacho.cantidad ELSE 0 END) as cantidad_hoy')
            )
            ->groupBy('productos.nombre')
            ->orderByDesc('cantidad_total')
            ->take(10)
            ->get();

        // Últimos despachos (modificado para mostrar sucursal en lugar de producto)
        $ultimosDespachos = DB::table('despachos')
            ->join('producto_despacho', 'despachos.id', '=', 'producto_despacho.despacho_id')
            ->join('productos', 'producto_despacho.producto_id', '=', 'productos.id')
            ->join('sucursales', 'despachos.id_sucursal', '=', 'sucursales.id') // Asumiendo que existe esta relación
            ->select(
                'sucursales.nombre_sucursal as sucursal', // Cambiado de producto a sucursal
                'despachos.created_at as fecha',
                DB::raw('producto_despacho.cantidad * producto_despacho.precio_unitario as total')
            )
            ->orderByDesc('despachos.created_at')
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'userCount',
            'categoryCount',
            'productCount',
            'productosMasDespachados',
            'ultimosDespachos'
        ));
    }

    public function empleadoDashboard()
    {
        $despachosAsignados = Despacho::where('empleado_id', Auth::id())->get();
        return view('empleados.dashboard', compact('despachosAsignados'));
    }

    public function obtenerNotificaciones()
    {
        $notificaciones = Auth::user()->unreadNotifications;
        return response()->json($notificaciones);
    }
}
