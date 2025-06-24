<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Tienda;
use App\Models\User;
use App\Notifications\DespachoAsignado;
use App\Notifications\DespachoCompletadoNotification;
use App\Notifications\DespachoFinalizadoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\HistorialActualizacionStock;



class DespachoController extends Controller
{
    public function index()
    {
        $despachos = Despacho::with(['sucursal.tienda', 'productos.categoria'])->paginate(10);
        $sucursales = Sucursal::with('tienda')->get();
        $productos = Producto::with('categoria')->get();
        $empleados = User::where('role_id', 2)->get();
    
        return view('despachos.index', compact('despachos', 'sucursales', 'productos', 'empleados'));
    }

    public function create(Request $request)
    {
        $tiendas = Tienda::all();
        $sucursales = $request->filled('tienda') ? Sucursal::where('tienda_id', $request->tienda)->get() : collect();
        $productos = Producto::with('categoria')->where('estado', 1)->get();
        // Asegúrate de que solo se muestren productos activo
        $empleados = User::where('role_id', 2)->get();
    
        return view('despachos.create', compact('tiendas', 'sucursales', 'productos', 'empleados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tienda' => 'required|exists:tiendas,id',
            'id_sucursal' => 'required|exists:sucursales,id',
            'fecha' => 'required|date',
            'estado' => 'nullable|string',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
            'empleado_id' => 'required|exists:users,id',
        ]);
        // Aquí se hace la validación de estado de los productos
    foreach ($validated['productos'] as $productoItem) {
        $producto = Producto::find($productoItem['id']);
        if (!$producto || !$producto->estado) {
            return back()->with('error', 'El producto "' . $producto->nombre . '" está inactivo y no puede ser despachado.');
        }
    }

        $cantidadTotal = collect($request->productos)->sum('cantidad');
        $precioTotal = collect($request->productos)->sum(fn($producto) => $producto['cantidad'] * $producto['precio_unitario']);

        $despacho = Despacho::create([
            'tienda_id' => $validated['tienda'],
            'id_sucursal' => $validated['id_sucursal'],
            'empleado_id' => $validated['empleado_id'],
            'cantidad_total' => $cantidadTotal,
            'precio_total' => $precioTotal,
            'fecha' => $validated['fecha'],
            'estado' => $validated['estado'],
            'comentarios' => $validated['comentarios'],
        ]);

        $despacho->productos()->attach(collect($validated['productos'])->mapWithKeys(fn($producto) => [
            $producto['id'] => [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
            ]
        ]));

        User::find($validated['empleado_id'])->notify(new DespachoAsignado($despacho));

        return redirect()->route('despachos.index')->with('success', 'Despacho creado exitosamente.');
    }

    public function edit(Despacho $despacho)
    {
        $tiendas = Tienda::all();
        $sucursales = Sucursal::where('tienda_id', $despacho->tienda_id)->get();
        $productos = Producto::all();
        return view('despachos.edit', compact('despacho', 'tiendas', 'sucursales', 'productos'));
    }

    public function update(Request $request, Despacho $despacho)
    {
        $validated = $request->validate([
            'tienda' => 'required|exists:tiendas,id',
            'id_sucursal' => 'required|exists:sucursales,id',
            'fecha' => 'required|date',
            'estado' => 'nullable|string',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        $cantidadTotal = collect($validated['productos'])->sum('cantidad');
        $precioTotal = collect($validated['productos'])->sum(fn($producto) => $producto['cantidad'] * $producto['precio_unitario']);

        $despacho->update([
            'tienda_id' => $validated['tienda'],
            'id_sucursal' => $validated['id_sucursal'],
            'cantidad_total' => $cantidadTotal,
            'precio_total' => $precioTotal,
            'fecha' => $validated['fecha'],
            'estado' => $validated['estado'],
            'comentarios' => $validated['comentarios'],
        ]);

        $despacho->productos()->sync(collect($validated['productos'])->mapWithKeys(fn($producto) => [
            $producto['id'] => [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
            ]
        ]));

        return redirect()->route('despachos.index')->with('success', 'Despacho actualizado exitosamente.');
    }

    public function destroy(Despacho $despacho)
    {
        $despacho->productos()->detach();
        $despacho->delete();
        return redirect()->route('despachos.index')->with('success', 'Despacho eliminado exitosamente.');
    }

   public function show($id)
{
    $despacho = Despacho::findOrFail($id);
    return view('despachos.show', compact('despacho'));
}


    public function getSucursalesByTienda($tienda_id)
    {
        return response()->json(Sucursal::where('tienda_id', $tienda_id)->get(['id', 'nombre_sucursal']));
    }

    public function completarDespacho(Despacho $despacho)
    {
        $despacho->update(['estado' => 'completado']);
        Notification::send(User::where('role_id', 1)->first(), new DespachoAsignado($despacho));
        return redirect()->back()->with('success', 'Despacho completado correctamente.');
    }

    public function asignarDespacho($despacho_id, $empleado_id)
    {
        $despacho = Despacho::findOrFail($despacho_id);
        User::findOrFail($empleado_id)->notify(new DespachoAsignado($despacho));
        return response()->json(['message' => 'Despacho asignado y notificación enviada']);
    }

    public function misDespachos()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus despachos.');
        }

        $despachos = Despacho::where('empleado_id', Auth::id())->with(['sucursal.tienda', 'productos'])->get();

        return view('empleados.despachos.mis-despachos', compact('despachos'));
    }
    public function detalle($id)
{
    $despacho = Despacho::with(['sucursal.tienda', 'productos'])->findOrFail($id);
    return view('empleados.despachos.detalle', compact('despacho'));
}
public function reportarProblema($despacho_id, $producto_id)
{
    $despacho = Despacho::findOrFail($despacho_id);
    $producto = $despacho->productos()->where('producto_id', $producto_id)->firstOrFail();

    return view('empleados.despachos.reportar', compact('despacho', 'producto'));
}
public function actualizarEstado(Request $request, $id)
{
    $despacho = Despacho::findOrFail($id);

    // No permitir cambios si el despacho ya está completado
    if ($despacho->estado === 'completado') {
        return redirect()->route('empleados.despachos.detalle', $id)
            ->with('error', 'No se puede modificar el estado de un despacho completado.');
    }

    $request->validate([
        'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
    ]);

    $despacho->estado = $request->estado;
    $despacho->save();

    // Notificar al administrador si el despacho fue completado
    if ($despacho->estado === 'completado') {
        try {
            $admin = User::where('role_id', 1)->first(); // Suponiendo que el ID del rol admin es 1
            
            if ($admin) {
                $admin->notify(new DespachoFinalizadoNotification($despacho));
                $admin->notifications;
            }
        } catch (\Exception $e) {
            log::error('Error al enviar la notificación: ' . $e->getMessage());
            
        }
    }

    return redirect()->route('empleados.despachos.detalle', $id)
        ->with('success', 'Estado del despacho actualizado correctamente.');
}



public function actualizarStock(Despacho $despacho)
{
    // Verifica que el usuario sea admin y el despacho esté completado
    if (Auth::user()->role_id !== 1 || $despacho->estado !== 'completado') {
        abort(403, 'No autorizado.');
    }

    // Lógica para actualizar el stock
    foreach ($despacho->productos as $producto) {
        $producto->cantidad -= $producto->pivot->cantidad;
        $producto->save();
    }
     // Registrar en historial_actualizacion_stock
     HistorialActualizacionStock::create([
        'despacho_id' => $despacho->id,
        'producto_id' => $producto->id,
        'cantidad_despachada' => $producto->pivot->cantidad,
        'actualizado_por' => Auth::id(), // El admin que hizo la actualización
        'fecha_actualizacion' => now(), ]);

    return redirect()->route('despachos.index', $despacho->id)
        ->with('success', 'Stock actualizado correctamente.');
}






}
