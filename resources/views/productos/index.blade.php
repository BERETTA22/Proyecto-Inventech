@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-6">Lista de Productos</h1>
        <a href="{{ route('productos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Crear Producto</a>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Nombre</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Cantidad</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Precio</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Categoría</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Imagen</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $producto->nombre }}</td>
                            <td class="px-4 py-2">{{ $producto->cantidad }}</td>
                            <td class="px-4 py-2">{{ number_format($producto->precio, 2) }}</td>
                            <td class="px-4 py-2">{{ $producto->categoria->nombre }}</td>
                            <td class="px-4 py-2">
                                @if($producto->multimedia)
                                <img src="{{ asset('storage/' . $producto->multimedia->tipo_archivo) }}" width="100" alt="Imagen">

                                @else
                                    <span class="text-gray-500">Sin Imagen</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('productos.edit', $producto->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
