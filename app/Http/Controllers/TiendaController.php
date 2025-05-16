<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    // Muestra una lista de todas las tiendas
    public function index()
    {
        // Cargar las tiendas con sus sucursales
        $tiendas = Tienda::with('sucursales')->get();
    
        // Retornar la vista con las tiendas cargadas
        return view('tiendas.index', compact('tiendas'));
    }
    

    // Muestra el formulario para crear una nueva tienda
    public function create()
    {
        return view('tiendas.create');
    }

    // Guarda una nueva tienda
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tiendas,nombre',
        ]);

        Tienda::create($request->only('nombre'));

        return redirect()->route('tiendas.index')->with('success', 'Tienda creada exitosamente.');
    }

    // Muestra el formulario para editar una tienda
    public function edit(Tienda $tienda)
    {
        return view('tiendas.edit', compact('tienda'));
    }

    // Actualiza la tienda
    public function update(Request $request, Tienda $tienda)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tiendas,nombre,' . $tienda->id,
        ]);

        $tienda->update($request->only('nombre'));

        return redirect()->route('tiendas.index')->with('success', 'Tienda actualizada exitosamente.');
    }

    // Elimina una tienda
    public function destroy(Tienda $tienda)
    {
        $tienda->delete();

        return redirect()->route('tiendas.index')->with('success', 'Tienda eliminada exitosamente.');
    }
}