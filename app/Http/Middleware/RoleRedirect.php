<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Si el usuario es admin y está intentando entrar al dashboard de empleados
        if ($user->role_id == 1 && $request->routeIs('empleados.*')) {
            return redirect()->route('dashboard');
        }

        // Si el usuario es empleado y está intentando entrar al dashboard de admin
        if ($user->role_id == 2 && $request->routeIs('dashboard') || $request->routeIs('usuarios.*')) {
            return redirect()->route('empleados.dashboard');
        }

        return $next($request);
    }
}
