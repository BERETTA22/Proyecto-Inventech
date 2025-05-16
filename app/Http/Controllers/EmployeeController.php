<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Asegúrate de importar tu modelo de usuario




class EmployeeController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();


        $despachosCompletados = $user->despachos()->where('estado', 'completado')->count();
        $despachosPendientes = $user->despachos()->where('estado', 'pendiente')->count();
        $ultimoDespacho = $user->despachos()->orderBy('fecha', 'desc')->first();
        $despachosRecientes = $user->despachos()->latest()->take(5)->get();
    
        return view('empleados.dashboard', compact(
            'despachosCompletados',
            'despachosPendientes',
            'ultimoDespacho',
            'despachosRecientes'
        ));  // Vista para empleados
    }
}

