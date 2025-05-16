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
@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-[#2c3e50] mb-6">Crear Producto</h1>

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-[#2c3e50] font-medium">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <div class="mb-4">
                <label for="cantidad" class="block text-[#2c3e50] font-medium">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-[#2c3e50] font-medium">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio') }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <div class="mb-4">
                <label for="categoria" class="block text-[#2c3e50] font-medium">Categoría:</label>
                <select id="categoria" name="id_categoria" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="imagen" class="block text-[#2c3e50] font-medium">Seleccionar Imagen:</label>
                <select id="imagen" name="id_multimedia" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
                    <option value="">Seleccione una imagen</option>
                    @foreach ($multimedia as $imagen)
                        <option value="{{ $imagen->id }}" {{ old('id_multimedia') == $imagen->id ? 'selected' : '' }}>
                            {{ basename($imagen->tipo_archivo) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-[#2c3e50] font-medium">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <div class="mt-6 flex justify-center">
                <button type="submit"
                    class="px-6 py-2 bg-[#16a085] text-white rounded-md hover:bg-[#1abc9c] focus:outline-none focus:ring-2 focus:ring-[#16a085] focus:ring-opacity-50">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
@endsection
