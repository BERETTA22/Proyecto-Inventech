<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class UsuarioApiController extends Controller
{
    public function index()
    {
        // Llamada al API Spring Boot
        $response = Http::get('http://localhost:8080/api/users');

        // Verifica si la llamada fue exitosa
        if ($response->successful()) {
            $usuarios = $response->json();
            return view('usuarios.ver_usuarios', compact('usuarios'));
        }

        // Si hubo error
        return view('usuarios.ver_usuarios', ['usuarios' => []]);
    }
}
