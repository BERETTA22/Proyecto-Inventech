<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsEmployee
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es un empleado (role_id = 2)
        if (Auth::check() && Auth::user()->role_id === 2) {
            return $next($request); // Permitir acceso
        }

        // Redirigir a una página de error o al home si no es empleado
        return redirect('/dashboard')->with('error', 'No tienes permisos de empleado.');
    }
}
