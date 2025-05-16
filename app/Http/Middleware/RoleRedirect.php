<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role_id == 1) {
            if (!$request->routeIs('dashboard')) {
                return redirect()->route('dashboard');
            }
        } elseif ($user->role_id == 2) {
            if (!$request->routeIs('empleados.dashboard')) {
                return redirect()->route('empleados.dashboard');
            }
        }

        return $next($request);
    }
}



