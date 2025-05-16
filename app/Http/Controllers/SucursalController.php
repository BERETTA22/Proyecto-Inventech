<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Tienda;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    // Muestra todas las sucursales de una tienda
    public function index()
    {
        $tiendas = Tienda::with('sucursales')->get();
        return view('tiendas.sucursales.index', compact('tiendas'));
    }
    


    // Muestra el formulario para crear una nueva sucursal
    public function create()
    {
        // Obtener todas las tiendas para el select
        $tiendas = Tienda::all();

        // Pasar todas las tiendas a la vista
        return view('tiendas.sucursales.create', compact('tiendas'));
    }

    // Guarda una nueva sucursal
    public function store(Request $request)
    {
        $request->validate([
            'tienda_id' => 'required|exists:tiendas,id',  // Validación para asegurar que el tienda_id sea válido
            'nombre_sucursal' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'contacto' => 'nullable|string|max:255',
        ]);

        // Crear la sucursal asociada a la tienda
        Sucursal::create([
            'tienda_id' => $request->tienda_id,
            'nombre_sucursal' => $request->nombre_sucursal,
            'direccion' => $request->direccion,
            'contacto' => $request->contacto,
        ]);

        return redirect()->route('tiendas.index')->with('success', 'Sucursal creada exitosamente');
    }

    // Muestra el formulario para editar una sucursal
    public function edit(Sucursal $sucursal)
    {
        // Obtener todas las tiendas para mostrar en el select
        $tiendas = Tienda::all();
    
        // Pasar la sucursal y las tiendas a la vista
        return view('tiendas.sucursales.edit', compact('sucursal', 'tiendas'));
    }
    
    
    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate([
            'nombre_sucursal' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'contacto' => 'nullable|string|max:255',
        ]);
    
        $sucursal->update($request->all());
    
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada exitosamente.');
    }
    
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
    
        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada exitosamente.');
    }

    public function getByTienda($tiendaId)
    {
        // Verifica que la tienda exista
        $tienda = Tienda::find($tiendaId);
    
        if (!$tienda) {
            return response()->json(['message' => 'Tienda no encontrada'], 404);
        }
    
        // Obtén las sucursales asociadas a la tienda
        $sucursales = $tienda->sucursales()->get(['id', 'nombre_sucursal']);
        print($sucursales);
        return response()->json($sucursales);
    }
    

    
}