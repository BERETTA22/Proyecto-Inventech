@extends('layouts.app')

@section('title', 'Lista de Categorías')

@section('content')
<div class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">

        <!-- Formulario para agregar categoría -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-[#2c3e50] mb-4">Agregar Categoría</h2>
            <form id="form-categoria" action="{{ route('categorias.store') }}" method="POST" class="bg-white p-6 rounded shadow-lg">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la categoría</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        id="nombre_categoria" 
                        class="w-full border-gray-300 rounded p-2 mt-1" 
                        value="{{ old('nombre') }}" 
                        required
                    >
                    @error('nombre')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
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
                        <th class="px-6 py-2">Categoría</th>
                        <th class="px-6 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $index => $categoria)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-3">{{ $categoria->nombre }}</td>
                        <td class="px-6 py-3">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('categorias.edit', $categoria->id) }}"
                                   class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Editar
                                </a>
                                <form action="{{ route('categorias.toggleEstado', $categoria->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-4 py-1 rounded text-white {{ $categoria->estado ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                                        {{ $categoria->estado ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        // Eliminar espacios iniciales y múltiples espacios seguidos
        $(document).on('input', '#nombre_categoria', function () {
            let value = $(this).val();
            // Quitar espacios al inicio y más de un espacio seguido
            value = value.replace(/^\s+/, '').replace(/\s{2,}/g, ' ');
            $(this).val(value);
        });

        $('#form-categoria').on('submit', function (e) {
            const nombre = $('#nombre_categoria').val().trim();

            // Regex: al menos una letra, permite letras, números y . , - ( ) con espacios normales
            const regexValido = /^(?=.*[a-zA-ZáéíóúÁÉÍÓÚñÑ])[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s.,()\-]{2,255}$/;

            if (nombre === '') {
                alert('El nombre de la categoría no puede estar vacío.');
                e.preventDefault();
                return;
            }

            if (!regexValido.test(nombre)) {
                alert('El nombre debe tener al menos una letra y puede incluir números y caracteres como . , - ().');
                e.preventDefault();
                return;
            }

            if (nombre.length < 2 || nombre.length > 255) {
                alert('El nombre debe tener entre 2 y 255 caracteres.');
                e.preventDefault();
                return;
            }
        });
    });
</script>

@endsection
