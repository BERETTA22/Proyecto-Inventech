<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importa la fachada Storage


class ProductoController extends Controller
{
    public function index(Request $request)
{
    $query = Producto::with(['categoria', 'multimedia']);

    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('id_categoria')) {
        $query->where('id_categoria', $request->id_categoria);
    }

    if ($request->filled('precio_min')) {
        $query->where('precio', '>=', $request->precio_min);
    }

    if ($request->filled('precio_max')) {
        $query->where('precio', '<=', $request->precio_max);
    }

    if ($request->filled('fecha')) {
        $query->whereDate('fecha', $request->fecha);
    }
    

    $productos = $query->get();
    $categorias = Categoria::all();
    $productos = $query->paginate(10)->appends($request->query());


    return view('productos.index', compact('productos', 'categorias'));
}


    public function create()
    {
        $categorias = Categoria::where('estado', true)->get(); // solo activas
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
        ]);// Verifica si la categoría está activa
        $categoria = Categoria::findOrFail($request->id_categoria);
    
        if (!$categoria->estado) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No puedes crear un producto en una categoría desactivada.');
        }


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
public function toggleEstado(Producto $producto)
{
    

    // Verificar si se intenta activar
    if (!$producto->estado) {
        if (!$producto->categoria || !$producto->categoria->estado) {
            return redirect()->back()->with('error', 'Debe activar la categoría antes de activar este producto.');
        }
    }
    $producto->estado = !$producto->estado;
    $producto->save();

    return redirect()->route('productos.index')->with('success', 'Estado del producto actualizado.');
}
public function storeMultiple(Request $request)
{
    $productos = $request->input('productos');

    foreach ($productos as $index => $producto) {
        $validator = \Validator::make($producto, [
            'nombre' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'unique:productos,nombre',
                'regex:/^(?![\s.]*$)(?=.*[a-zA-Z])[a-zA-Z0-9\s\.\,\-\_\(\)áéíóúÁÉÍÓÚñÑ]+$/'
            ],
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'id_categoria' => 'required|exists:categorias,id',
            'id_multimedia' => 'required|exists:multimedia,id',
            'fecha' => 'required|date',
        ], [
            'nombre.required' => "El nombre del producto es obligatorio.",
            'nombre.unique' => "Ya existe un producto con ese nombre.",
            'nombre.regex' => "El nombre debe contener letras y no ser solo números o símbolos.",
            'cantidad.required' => "La cantidad es obligatoria.",
            'precio.required' => "El precio es obligatorio.",
            'id_categoria.required' => "Debe seleccionar una categoría válida.",
            'id_multimedia.required' => "Debe seleccionar una imagen válida.",
            'fecha.required' => "La fecha es obligatoria.",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Producto::create($producto);
    }

    return redirect()->route('productos.index')->with('success', 'Productos guardados exitosamente.');
}
}
