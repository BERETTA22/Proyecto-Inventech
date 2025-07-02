@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-center text-[#2c3e50] mb-6">Crear Productos</h1>

    <form action="{{ route('productos.storeMultiple') }}" method="POST">
        @csrf

        <div id="productos-container">
            <div class="producto-group border border-gray-300 p-4 mb-6 rounded-lg relative">
                <!-- Botón eliminar oculto para el primero -->
                <button type="button" class="eliminar-producto absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded hidden">
                    Eliminar
                </button>

                <div class="mb-4">
                    <label class="block text-[#2c3e50] font-medium">Nombre:</label>
                    <input type="text" name="productos[0][nombre]" required
                        class="mt-1 block w-full p-2 border border-[#16a085] rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-[#2c3e50] font-medium">Cantidad:</label>
                    <input type="number" name="productos[0][cantidad]" required
                        class="mt-1 block w-full p-2 border border-[#16a085] rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-[#2c3e50] font-medium">Precio:</label>
                    <input type="number" step="0.01" name="productos[0][precio]" required
                        class="mt-1 block w-full p-2 border border-[#16a085] rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-[#2c3e50] font-medium">Categoría:</label>
                    <select name="productos[0][id_categoria]" required
                        class="mt-1 block w-full p-2 border border-[#16a085] rounded-md">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-[#2c3e50] font-medium">Seleccionar Imagen:</label>
                    <select name="productos[0][id_multimedia]" required
                        class="mt-1 block w-full p-2 border border-[#16a085] rounded-md">
                        <option value="">Seleccione una imagen</option>
                        @foreach ($multimedia as $imagen)
                            <option value="{{ $imagen->id }}">{{ basename($imagen->tipo_archivo) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-[#2c3e50] font-medium">Fecha:</label>
                    <input type="date" name="productos[0][fecha]" required
                        class="mt-1 block w-full p-2 border border-[#16a085] rounded-md">
                </div>
            </div>
        </div>

        <div class="flex justify-center mb-6">
            <button id="agregar-producto" type="button"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                + Agregar otro producto
            </button>
        </div>

        <div class="flex justify-center">
            <button type="submit"
                class="px-6 py-2 bg-[#16a085] text-white rounded-md hover:bg-[#1abc9c] focus:outline-none focus:ring-2 focus:ring-[#16a085] focus:ring-opacity-50">
                Guardar Productos
            </button>
        </div>
    </form>
</div>

@if (session('error'))
    <div class="bg-red-100 text-red-800 p-2 rounded mt-4">
        {{ session('error') }}
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let productoIndex = 1;

$(document).ready(function () {
    // Evitar espacios iniciales
    $(document).on('input', 'input, textarea', function () {
        let value = $(this).val();
        $(this).val(value.replace(/^\s+/, ''));
    });

    // Agregar nuevo producto
    $('#agregar-producto').click(function (e) {
        e.preventDefault();

        let nuevoProducto = $('.producto-group').first().clone();

        nuevoProducto.find('input, select').each(function () {
            let name = $(this).attr('name');
            if (name) {
                let nuevoName = name.replace(/\[\d+\]/, `[${productoIndex}]`);
                $(this).attr('name', nuevoName);
                $(this).val('');
            }
        });

        nuevoProducto.find('.eliminar-producto').removeClass('hidden');
        $('#productos-container').append(nuevoProducto);
        productoIndex++;
    });

    // Eliminar grupo de producto
    $(document).on('click', '.eliminar-producto', function () {
        $(this).closest('.producto-group').remove();
    });

    // Validación antes de enviar el formulario
    $('form').on('submit', function (e) {
        const nombres = [];
        let valido = true;
        let errores = [];

        $('.producto-group').each(function (i) {
            const nombre = $(this).find('input[name$="[nombre]"]').val().trim();

            if (nombre === '') {
                errores.push(`Producto ${i + 1}: El nombre no puede estar vacío.`);
                valido = false;
            }

            if (/^[\s.]+$/.test(nombre)) {
                errores.push(`Producto ${i + 1}: El nombre no puede ser solo puntos o espacios.`);
                valido = false;
            }

            if (!/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/.test(nombre)) {
                errores.push(`Producto ${i + 1}: El nombre debe contener al menos una letra.`);
                valido = false;
            }

            if (nombres.includes(nombre.toLowerCase())) {
                errores.push(`Producto ${i + 1}: El nombre "${nombre}" ya se repitió.`);
                valido = false;
            }

            nombres.push(nombre.toLowerCase());
        });

        if (!valido) {
            e.preventDefault();
            alert(errores.join('\n'));
        }
    });
});
</script>

@endsection
