@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-xl">
    <h1 class="text-3xl font-bold mb-6">Detalle del Despacho</h1>

    <div class="bg-gray-50 p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Información del Despacho</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><span class="font-medium text-gray-600">Fecha:</span> {{ $despacho->fecha }}</p>
            <p><span class="font-medium text-gray-600">Estado:</span> {{ $despacho->estado }}</p>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($despacho->productos as $producto)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $producto->nombre }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $producto->pivot->cantidad }}</td>
                        <td class="px-4 py-2 border border-gray-300">${{ number_format($producto->pivot->precio_unitario, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('despachos.index') }}" 
           class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800 focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 inline-block">
           Volver
        </a>

        <a href="{{ route('despachos.edit', $despacho->id) }}" 
           class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 inline-block">
           Editar Despacho
        </a>

        @if (auth()->check() && auth()->user()->role_id === 1 && $despacho->estado === 'completado')
            <form action="{{ route('despachos.actualizarStock', $despacho->id) }}" method="POST" 
                  onsubmit="return confirm('¿Estás seguro que quieres actualizar el stock?');">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Actualizar Stock
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
