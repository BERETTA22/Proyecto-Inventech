<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es administrador (role_id = 1)
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request); // Permitir acceso
        }

        // Redirigir a una página de error o al home si no es administrador
        return redirect('/dashboard')->with('error', 'No tienes permisos de administrador.');

    }
}
