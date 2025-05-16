@extends('layouts.employee')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-xl">
    <h1 class="text-3xl font-bold mb-6">Detalle del Despacho</h1>

    <div class="bg-gray-50 p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Información del Despacho</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><span class="font-medium text-gray-600">Fecha:</span> {{ $despacho->fecha }}</p>
            
            {{-- Formulario para actualizar el estado --}}
        @if ($despacho->estado === 'completado')
            <p><span class="font-medium text-gray-600">Estado:</span> <span class="text-green-600 font-semibold">Completado</span></p>
        @else
            <form action="{{ route('empleados.despachos.actualizarEstado', $despacho->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label class="font-medium text-gray-600">Estado:</label>
                <select name="estado" class="border rounded px-3 py-1 ml-2">
                    <option value="pendiente" {{ $despacho->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_proceso" {{ $despacho->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="completado" {{ $despacho->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="cancelado" {{ $despacho->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
                <button type="submit" class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 ml-2">
                    Guardar
                </button>
            </form>
            @endif

            <p><span class="font-medium text-gray-600">Comentarios:</span> {{ $despacho->comentarios }}</p>
            <p><span class="font-medium text-gray-600">Cantidad Total:</span> {{ $despacho->cantidad_total }}</p>
            <p><span class="font-medium text-gray-600">Precio Total:</span> ${{ number_format($despacho->precio_total, 2) }}</p>
            <p><span class="font-medium text-gray-600">Tienda:</span> {{ $despacho->sucursal->tienda->nombre ?? 'N/A' }}</p>
            <p><span class="font-medium text-gray-600">Sucursal:</span> {{ $despacho->sucursal->nombre_sucursal ?? 'N/A' }}</p>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Productos</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600">
                    <th class="px-4 py-2 border border-gray-300">Nombre</th>
                    <th class="px-4 py-2 border border-gray-300">Cantidad</th>
                    <th class="px-4 py-2 border border-gray-300">Precio Unitario</th>
                    <th class="px-4 py-2 border border-gray-300 text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($despacho->productos as $producto)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $producto->nombre }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $producto->pivot->cantidad }}</td>
                        <td class="px-4 py-2 border border-gray-300">${{ number_format($producto->pivot->precio_unitario, 2) }}</td>
                        <td class="px-4 py-2 border border-gray-300 text-center">
                            <a href="{{ route('empleados.despachos.reportar', ['despacho_id' => $despacho->id, 'producto_id' => $producto->id]) }}" 
                               class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Reportar Problema
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('empleados.despachos.mis-despachos') }}" 
           class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800 transition">
           Volver
        </a>
    </div>
</div>
@if(session('success'))
    <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-400 rounded">
        {{ session('success') }}
    </div>
@endif

@endsection
