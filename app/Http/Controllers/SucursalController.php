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
    
public function storeMultiple(Request $request)
{
    $data = $request->input('sucursales');

    foreach ($data as $sucursal) {
        \App\Models\Sucursal::create([
            'tienda_id' => $sucursal['tienda_id'],
            'nombre_sucursal' => $sucursal['nombre_sucursal'],
            'direccion' => $sucursal['direccion'],
            'contacto' => $sucursal['contacto'] ?? null,
        ]);
    }

    return redirect()->route('sucursales.index')->with('success', 'Sucursales creadas exitosamente.');
}
public function toggleEstado($id)
{
    $sucursal = \App\Models\Sucursal::with('tienda')->findOrFail($id);

    // Si se va a activar la sucursal y su tienda está desactivada
    if (!$sucursal->estado && !$sucursal->tienda->estado) {
        return redirect()->back()->with('error', 'No se puede activar esta sucursal porque la tienda "' . $sucursal->tienda->nombre . '" está desactivada.');
    }

    $sucursal->estado = !$sucursal->estado;
    $sucursal->save();

    return redirect()->back()->with('success', 'Estado de la sucursal actualizado correctamente.');
}


    
}