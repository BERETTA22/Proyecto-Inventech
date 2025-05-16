@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Lista de Despachos</h1>

    <!-- Botón para ir al formulario de creación -->
    <div class="mb-6">
        <a href="{{ route('despachos.create') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            Crear Nuevo Despacho
        </a>
    </div>

    <!-- Mostrar mensaje de éxito si lo hay -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla responsive con scroll horizontal en dispositivos pequeños -->
    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="min-w-full table-auto bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Sucursal</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tienda</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Fecha</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Estado</th>
                    <th class="hidden md:table-cell px-4 py-2 text-left text-sm font-semibold text-gray-600">Comentarios</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Precio Total</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($despachos as $despacho)
                    <tr class="hover:bg-gray-50 border-t border-gray-200">
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $despacho->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $despacho->sucursal->nombre_sucursal ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $despacho->sucursal->tienda->nombre ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $despacho->fecha }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ ucfirst($despacho->estado ?? 'Sin estado') }}</td>
                        <td class="hidden md:table-cell px-4 py-3 text-sm text-gray-800">
                            <div class="max-w-xs truncate">{{ $despacho->comentarios ?? 'Sin comentarios' }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $despacho->precio_total }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('despachos.show', $despacho->id) }}" class="flex items-center gap-1 bg-blue-500 text-white px-3 py-1 rounded-full text-xs hover:bg-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Ver
                                </a>
                                <a href="{{ route('despachos.edit', $despacho->id) }}" class="flex items-center gap-1 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs hover:bg-yellow-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536M9 11l6-6 3.536 3.536-6 6H9v-3.536z"/>
                                    </svg>
                                    Editar
                                </a>
                                <form action="{{ route('despachos.destroy', $despacho->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este despacho?')" class="flex items-center gap-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 bg-red-500 text-white px-3 py-1 rounded-full text-xs hover:bg-red-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $despachos->links('pagination::tailwind') }}
    </div>
</div>
@endsection

@vite(['resources/js/app.js'])
