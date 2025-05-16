<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Evitar espacios iniciales en el input de nombre de categoría
        $(document).on('input', '#nombre_categoria', function() {
            let value = $(this).val();
            $(this).val(value.replace(/^\s+/, '')); // Eliminar espacios iniciales
        });
    });
</script>
@extends('layouts.app')

@section('title', 'Lista de Categorías')

@section('content')
<div class="bg-gray-100 p-6">

    <!-- Contenedor principal -->
    <div class="max-w-6xl mx-auto">
        
        <!-- Formulario para agregar categoría -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-[#2c3e50] mb-4">Agregar Categoría</h2>
            <form action="{{ route('categorias.store') }}" method="POST" class="bg-white p-6 rounded shadow-lg">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la categoría</label>
                    <input type="text" name="nombre" id="nombre_categoria" class="w-full border-gray-300 rounded p-2 mt-1" required>
                </div>
                <button type="submit" class="bg-[#16a085] text-white px-6 py-2 rounded hover:bg-[#1abc9c] focus:outline-none focus:ring-2 focus:ring-[#16a085]">
                    Agregar categoría
                </button>
            </form>
        </div>

        <!-- Lista de categorías -->
        <div>
            <h2 class="text-2xl font-bold text-[#2c3e50] mb-4">Lista de Categorías</h2>
            <table class="min-w-full bg-white rounded shadow-lg">
                <thead>
                    <tr class="bg-[#2c3e50] text-white">
                        <th class="px-6 py-2">#</th>
                        <th class="px-6 py-2">Categorías</th>
                        <th class="px-6 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $index => $categoria)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-2">{{ $index + 1 }}</td>
                        <td class="px-6 py-2">{{ $categoria->nombre }}</td>
                        <td class="px-6 py-2 flex space-x-3 justify-center">
                            <!-- Botón Editar -->
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Editar
                            </a>
                            <!-- Botón Eliminar -->
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                               

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
