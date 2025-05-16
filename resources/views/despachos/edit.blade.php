<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    var tiendaIdInicial = $('#tienda').val(); 
    var sucursalSeleccionada = "{{ $despacho->id_sucursal }}"; 

    function cargarSucursales(tiendaId) {
        if (tiendaId) {
            $.ajax({
                url: '/sucursales/' + tiendaId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#id_sucursal').empty();
                    $('#id_sucursal').append('<option value="">Seleccione una sucursal</option>');

                    if (response.length > 0) {
                        $.each(response, function(index, sucursal) {
                            var selected = sucursal.id == sucursalSeleccionada ? 'selected' : '';
                            $('#id_sucursal').append('<option value="' + sucursal.id + '" ' + selected + '>' + sucursal.nombre_sucursal + '</option>');
                        });
                    } else {
                        $('#id_sucursal').append('<option value="">No hay sucursales disponibles</option>');
                    }
                },
                error: function() {
                    alert('Error al cargar las sucursales');
                }
            });
        } else {
            $('#id_sucursal').empty();
            $('#id_sucursal').append('<option value="">Seleccione una tienda primero</option>');
        }
    }

    if (tiendaIdInicial) {
        cargarSucursales(tiendaIdInicial);
    }

    $('#tienda').change(function() {
        var tiendaId = $(this).val();
        cargarSucursales(tiendaId);
    });
});
</script>

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Editar Despacho</h1>

    <form action="{{ route('despachos.update', $despacho->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="tienda" class="block text-sm font-medium text-gray-600">Tienda</label>
            <select id="tienda" name="tienda" class="w-full px-4 py-2 mt-2 border rounded-md">
                @foreach($tiendas as $tienda)
                    <option value="{{ $tienda->id }}" {{ $tienda->id == $despacho->tienda_id ? 'selected' : '' }}>
                        {{ $tienda->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="id_sucursal" class="block text-sm font-medium text-gray-600">Sucursal</label>
            <select id="id_sucursal" name="id_sucursal" class="w-full px-4 py-2 mt-2 border rounded-md">
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}" {{ $sucursal->id == $despacho->id_sucursal ? 'selected' : '' }}>
                        {{ $sucursal->nombre_sucursal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fecha" class="block text-sm font-medium text-gray-600">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $despacho->fecha) }}" class="w-full px-4 py-2 mt-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label for="productos" class="block text-sm font-medium text-gray-600">Productos</label>
            <table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="px-6 py-2 text-left text-sm font-semibold text-gray-600">Producto</th>
                        <th class="px-6 py-2 text-left text-sm font-semibold text-gray-600">Cantidad</th>
                        <th class="px-6 py-2 text-left text-sm font-semibold text-gray-600">Precio Unitario</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($despacho->productos as $productoEnDespacho)
        <tr>
            <td class="px-6 py-2">
                <label class="text-sm text-gray-600">{{ $productoEnDespacho->nombre }}</label>
                <input type="hidden" name="productos[{{ $productoEnDespacho->id }}][id]" value="{{ $productoEnDespacho->id }}">
            </td>
            <td class="px-6 py-2">
                <input type="number" name="productos[{{ $productoEnDespacho->id }}][cantidad]" value="{{ $productoEnDespacho->pivot->cantidad }}" class="w-full px-4 py-2 mt-2 border rounded-md">
            </td>
            <td class="px-6 py-2">
                <input type="number" name="productos[{{ $productoEnDespacho->id }}][precio_unitario]" value="{{ $productoEnDespacho->pivot->precio_unitario }}" class="w-full px-4 py-2 mt-2 border rounded-md">
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
       
        {{-- Formulario para actualizar el estado --}}
            <form action="{{ route('empleados.despachos.actualizarEstado', $despacho->id) }}" method="POST">
                
                <label class="font-medium text-gray-600">Estado:</label>
                <select name="estado" class="border rounded px-3 py-1 ml-2">
                    <option value="pendiente" {{ $despacho->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_proceso" {{ $despacho->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="completado" {{ $despacho->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="cancelado" {{ $despacho->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>

                <div class="mb-4">
            <label for="comentarios" class="block text-sm font-medium text-gray-600">Fecha</label>
            <input type="text" id="comentarios" name="comentarios" value="{{ old('comentarios', $despacho->comentarios) }}" class="w-full px-4 py-2 mt-2 border rounded-md">
        </div>


        <div class="mb-4">
            <button type="submit" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">Actualizar Despacho</button>
        </div>
    </form>
</div>
@endsection