@extends('layouts.app')

@section('content')
<!-- Asumiendo que este código es parte de tu archivo 'despachos.create.blade.php' -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Cuando se cambie la tienda
        $('#tienda_select').change(function() {
            var tiendaId = $(this).val();  // Obtener el ID de la tienda seleccionada

            // Verificar si se seleccionó una tienda válida
            if (tiendaId) {
                // Realizar la solicitud Ajax para obtener las sucursales
                $.ajax({
                    url: '/sucursales/' + tiendaId, // Cambiar ruta según la nueva configuración
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Limpiar el campo de sucursales
                        $('#sucursal_select').empty();
                        
                        // Agregar una opción por defecto
                        $('#sucursal_select').append('<option value="">Seleccione una sucursal</option>');
                        
                        // Si hay sucursales, agregarlas al select
                        if (response.length > 0) {
                            $.each(response, function(index, sucursal) {
                                $('#sucursal_select').append('<option value="' + sucursal.id + '">' + sucursal.nombre_sucursal + '</option>');
                            });
                        } else {
                            // Si no hay sucursales, mostrar un mensaje
                            $('#sucursal_select').append('<option value="">No hay sucursales disponibles</option>');
                        }
                    },
                    error: function() {
                        alert('Error al cargar las sucursales');
                    }
                });
            } else {
                // Si no se seleccionó tienda, limpiar el campo de sucursales
                $('#sucursal_select').empty();
                $('#sucursal_select').append('<option value="">Seleccione una tienda primero</option>');
            }
        });

         // Obtener precio del producto al seleccionar
         $(document).on('change', 'select[name^="productos"]', function() {
            var productoId = $(this).val();
            var precioInput = $(this).closest('.product-entry').find('input[name^="productos"][name$="[precio_unitario]"]');

            if (productoId) {
                $.ajax({
                    url: '/productos/' + productoId + '/precio',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        precioInput.val(response.precio);
                    },
                    error: function() {
                        console.error('Error al obtener el precio del producto');
                    }
                });
            } else {
                precioInput.val('');
            }
        });


        // Añadir productos dinámicamente
        let productoIndex = 1;
        $('#add-product').click(function() {
            let newProductField = `
                <div class="product-entry mb-6 p-4 border border-gray-300 rounded-lg shadow-sm bg-gray-50" data-index="${productoIndex}">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Producto ${productoIndex + 1}</h4>
                    <label for="producto-${productoIndex}" class="block text-sm font-medium text-gray-700">Selecciona un producto</label>
                    <select id="producto-${productoIndex}" name="productos[${productoIndex}][id]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    <label for="cantidad-${productoIndex}" class="block text-sm font-medium text-gray-700 mt-2">Cantidad</label>
                    <input type="number" name="productos[${productoIndex}][cantidad]" id="cantidad-${productoIndex}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="1">
                    <label for="precio_unitario-${productoIndex}" class="block text-sm font-medium text-gray-700 mt-2">Precio Unitario</label>
                    <input type="number" name="productos[${productoIndex}][precio_unitario]" id="precio_unitario-${productoIndex}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0" step="0.01">
                    <button type="button" class="remove-product mt-2 text-red-600 hover:text-red-800">Eliminar producto</button>
                </div>
            `;
            $('#productos-container').append(newProductField);
            productoIndex++;

            // Eliminar producto
            $('.remove-product').click(function() {
                $(this).closest('.product-entry').remove();
            });
        });
    });

    $(document).ready(function() {
        function calcularPrecioTotal() {
            let total = 0;
            $('.product-entry').each(function() {
                let cantidad = $(this).find('input[name^="productos"][name$="[cantidad]"]').val();
                let precio = $(this).find('input[name^="productos"][name$="[precio_unitario]"]').val();
                cantidad = cantidad ? parseFloat(cantidad) : 0;
                precio = precio ? parseFloat(precio) : 0;
                total += cantidad * precio;
            });
            $('#precio_total').val(total.toFixed(2));
        }

        // Calcular precio cuando cambia la cantidad o el precio unitario
        $(document).on('input', 'input[name^="productos"][name$="[cantidad]"], input[name^="productos"][name$="[precio_unitario]"]', function() {
            calcularPrecioTotal();
        });

        // Calcular también cuando se agregue un nuevo producto
        $('#add-product').click(function() {
            setTimeout(calcularPrecioTotal, 100); // Dar tiempo a que se agregue el nuevo producto antes de recalcular
        });

        // Calcular al eliminar un producto
        $(document).on('click', '.remove-product', function() {
            $(this).closest('.product-entry').remove();
            calcularPrecioTotal();
        });
    });
    $(document).ready(function() {
        // Evitar espacios iniciales en los inputs
        $(document).on('input', 'input, textarea', function() {
            let value = $(this).val();
            $(this).val(value.replace(/^\s+/, '')); // Eliminar espacios iniciales
        });
    });
    
</script>
@if (session('error'))
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- Formulario de despacho -->
<form action="{{ route('despachos.store') }}" method="POST" class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    @csrf
    <!-- Selector de tienda -->
    <div class="mb-4">
        <label for="tienda_select" class="block text-sm font-medium text-gray-700">Selecciona una tienda</label>
        <select id="tienda_select" name="tienda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Seleccione una tienda</option>
            @foreach($tiendas as $tienda)
                <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Selector de sucursal -->
    <div class="mb-4">
        <label for="sucursal_select" class="block text-sm font-medium text-gray-700">Selecciona una sucursal</label>
        <select id="sucursal_select" name="id_sucursal" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Seleccione una sucursal</option>
        </select>
    </div>

    <!-- Campo de precio total -->
    <div class="mb-4">
        <label for="precio_total" class="block text-sm font-medium text-gray-700">Precio total</label>
        <input type="number" name="precio_total" id="precio_total" value="{{ old('precio_total') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01"readonly>
        @error('precio_total')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo de fecha -->
    <div class="mb-4">
        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('fecha')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <!-- Selector de productos -->
    <div id="productos-container" class="mb-4">
        <div class="product-entry mb-6 p-4 border border-gray-300 rounded-lg shadow-sm bg-gray-50" data-index="0">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">Producto 1</h4>
            <label for="producto-0" class="block text-sm font-medium text-gray-700">Selecciona un producto</label>
            <select id="producto-0" name="productos[0][id]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
            <label for="cantidad-0" class="block text-sm font-medium text-gray-700 mt-2">Cantidad</label>
            <input type="number" name="productos[0][cantidad]" id="cantidad-0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="1">
            <label for="precio_unitario-0" class="block text-sm font-medium text-gray-700 mt-2">Precio Unitario</label>
            <input type="number" name="productos[0][precio_unitario]" id="precio_unitario-0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0" step="0.01" readonly>
        </div>
    </div>
    
    <!-- Botón para agregar productos -->
    <div class="mb-4">
        <button type="button" id="add-product" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Agregar Producto
        </button>
    </div>

    <div class="mb-4">
    <label for="empleado_select" class="block text-sm font-medium text-gray-700">Selecciona un empleado</label>
    <select id="empleado_select" name="empleado_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Seleccione un empleado</option>
        @foreach($empleados as $empleado)
            <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
        @endforeach
    </select>
</div>

    <!-- Campo de estado -->
    <div class="mb-4">
        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
        <select id="estado" name="estado" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="pendiente">Pendiente</option>
            <option value="en_proceso">En proceso</option>
            <option value="completado">Completado</option>
        </select>
    </div>

    <!-- Campo de comentarios -->
    <div class="mb-4">
        <label for="comentarios" class="block text-sm font-medium text-gray-700">Comentarios</label>
        <textarea id="comentarios" name="comentarios" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="4">{{ old('comentarios') }}</textarea>
    </div>

    <!-- Botón de submit -->
    <div class="mb-4">
        <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Crear Despacho
        </button>
    </div>
</form>



@endsection
