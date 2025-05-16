@extends('layouts.app')

@section('title', 'Lista de Categorías')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    @vite('resources/css/app.css') <!-- Asegúrate de que Vite esté configurado -->
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Evitar espacios iniciales en los inputs
        $(document).on('input', 'input, textarea', function() {
            let value = $(this).val();
            $(this).val(value.replace(/^\s+/, '')); // Eliminar espacios iniciales
        });
    });
</script>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Editar Categoría</h2>

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT') <!-- Método PUT para actualizar -->

            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la categoría</label>
                <input 
                    type="text" 
                    name="nombre" 
                    id="nombre" 
                    value="{{ old('nombre', $categoria->nombre) }}" 
                    class="w-full border-gray-300 rounded p-2 mt-1"
                    required
                >
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('categorias.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
@endsection
