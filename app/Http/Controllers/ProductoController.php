<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importa la fachada Storage


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'multimedia'])->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $multimedia = Multimedia::all();  // Obtén todas las imágenes multimedia
        return view('productos.create', compact('categorias', 'multimedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id',
            'id_multimedia' => 'required|exists:multimedia,id',  // Verifica que la imagen exista
            'fecha' => 'required|date',  // Asegúrate de que la fecha esté presente
        ]);

        // Crear el producto con los datos validados
        Producto::create([
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'id_categoria' => $request->id_categoria,
            'id_multimedia' => $request->id_multimedia,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $multimedia = Multimedia::all();
        return view('productos.edit', compact('producto', 'categorias', 'multimedia'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fecha' => 'required|date',
        ]);

        // Si se sube una nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->multimedia) {
                Storage::delete($producto->multimedia->tipo_archivo);
                $producto->multimedia->delete();
            }

            // Subir la nueva imagen
            $imagenPath = $request->file('imagen')->store('public/imagenes');
            $multimedia = Multimedia::create([
                'tipo_archivo' => $imagenPath,
            ]);
            $request->merge(['id_multimedia' => $multimedia->id]);
        }

        // Actualizar el producto
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
    public function obtenerPrecio($id)
{
    $producto = Producto::find($id);

    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    return response()->json(['precio' => $producto->precio]);
}

}

