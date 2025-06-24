@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-6">Lista de Productos</h1>
        <a href="{{ route('productos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Crear Producto</a>


        <form method="GET" action="{{ route('productos.index') }}" class="mb-4 flex flex-wrap items-end gap-4">
    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div>
        <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
        <select name="id_categoria" id="id_categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="">-- Todas --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('id_categoria') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
    <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
</div>

    <div class="flex items-end">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Filtrar</button>
    </div>

    <div class="flex items-end">
        <a href="{{ route('productos.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">Limpiar</a>
    </div>

  

</form>

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
                        
                                <form action="{{ route('productos.toggleEstado', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="{{ $producto->estado ? 'text-yellow-600' : 'text-green-600' }}">
                                        {{ $producto->estado ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

    <div class="mt-4">
    {{ $productos->links() }}
</div>

@endsection
