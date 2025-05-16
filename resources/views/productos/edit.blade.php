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
        <h1 class="text-3xl font-semibold text-center text-[#2c3e50] mb-6">Editar Producto</h1>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo: Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-[#2c3e50] font-medium">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <!-- Campo: Cantidad -->
            <div class="mb-4">
                <label for="cantidad" class="block text-[#2c3e50] font-medium">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad', $producto->cantidad) }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <!-- Campo: Precio -->
            <div class="mb-4">
                <label for="precio" class="block text-[#2c3e50] font-medium">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio', $producto->precio) }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <!-- Campo: Categoría -->
            <div class="mb-4">
                <label for="id_categoria" class="block text-gray-700 text-sm font-bold mb-2">Categoría:</label>
                <select id="id_categoria" name="id_categoria" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('id_categoria', $producto->id_categoria) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo: Imagen -->
            <div class="mb-4">
                <label for="imagen" class="block text-[#2c3e50] font-medium">Seleccionar Imagen:</label>
                <select id="imagen" name="id_multimedia" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
                    <option value="">Seleccione una imagen</option>
                    @foreach ($multimedia as $imagen)
                        <option value="{{ $imagen->id }}" data-imagen="{{ asset('storage/' . str_replace('public/', '', $imagen->tipo_archivo)) }}" {{ old('id_multimedia', $producto->id_multimedia) == $imagen->id ? 'selected' : '' }}>
                            {{ basename($imagen->tipo_archivo) }}
                        </option>
                    @endforeach
                </select>
                <!-- Vista previa de la imagen -->
                <div class="mt-4">
                    <img id="vista-previa" src="{{ $producto->multimedia ? asset('storage/' . str_replace('public/', '', $producto->multimedia->tipo_archivo)) : '' }}" alt="Vista previa de la imagen" class="w-24 h-24 object-cover rounded-lg shadow-md">
                </div>
            </div>

            <!-- Campo: Fecha -->
            <div class="mb-4">
                <label for="fecha" class="block text-[#2c3e50] font-medium">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($producto->fecha)->format('Y-m-d')) }}" required
                    class="mt-1 block w-full p-2 border border-[#16a085] rounded-md focus:ring-[#16a085] focus:border-[#16a085]">
            </div>

            <!-- Botón: Actualizar Producto -->
            <div class="mt-6 flex justify-center">
                <button type="submit"
                    class="px-6 py-2 bg-[#16a085] text-white rounded-md hover:bg-[#1abc9c] focus:outline-none focus:ring-2 focus:ring-[#16a085] focus:ring-opacity-50">
                    Actualizar Producto
                </button>
            </div>
        </form>
    </div>

    <!-- Script para la vista previa de la imagen -->
    <script>
        document.getElementById('imagen').addEventListener('change', function() {
            const imagenSeleccionada = this.options[this.selectedIndex].getAttribute('data-imagen');
            const vistaPrevia = document.getElementById('vista-previa');
            if (imagenSeleccionada) {
                vistaPrevia.src = imagenSeleccionada;
                vistaPrevia.style.display = 'block';
            } else {
                vistaPrevia.src = '';
                vistaPrevia.style.display = 'none';
            }
        });
    </script>
@endsection