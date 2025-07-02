@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold mb-6">Crear Sucursales</h1>

    <form action="{{ route('sucursales.storeMultiple') }}" method="POST">
        @csrf
        <div id="form-container">
            <!-- Grupo de campos para una sucursal -->
            <div class="sucursal-form border p-4 mb-6 rounded-md bg-gray-50 relative">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Sucursal</h2>
                    <!-- Botón cerrar -->
                    <button
                        type="button"
                        class="cerrar-form hidden text-red-500 hover:text-red-700 text-2xl leading-none px-2"
                        aria-label="Cerrar formulario"
                    >
                        &times;
                    </button>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Seleccionar Tienda</label>
                    <select name="sucursales[0][tienda_id]" required
                        class="mt-2 p-3 w-full border border-gray-300 rounded-md">
                        <option value="">Seleccione una tienda</option>
                        @foreach ($tiendas as $tienda)
                            <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre de la Sucursal</label>
                    <input type="text" name="sucursales[0][nombre_sucursal]" required
                        class="mt-2 p-3 w-full border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="sucursales[0][direccion]" required
                        class="mt-2 p-3 w-full border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Contacto</label>
                    <input type="text" name="sucursales[0][contacto]"
                        class="mt-2 p-3 w-full border border-gray-300 rounded-md">
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <button type="button" id="agregar-formulario"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Agregar otra sucursal
            </button>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                Guardar todas
            </button>
        </div>
    </form>
</div>

<script>
    let sucursalIndex = 1;

    document.getElementById('agregar-formulario').addEventListener('click', function () {
        const container = document.getElementById('form-container');
        const original = document.querySelector('.sucursal-form');
        const clone = original.cloneNode(true);

        // Limpiar valores del clon
        clone.querySelectorAll('input, select').forEach(el => el.value = '');

        // Actualizar índices en los name=""
        clone.querySelectorAll('input, select').forEach(el => {
            if (el.name) {
                el.name = el.name.replace(/\[\d+\]/, `[${sucursalIndex}]`);
            }
        });

        // Mostrar el botón de cerrar
        const closeBtn = clone.querySelector('.cerrar-form');
        if (closeBtn) {
            closeBtn.classList.remove('hidden');
        }

        container.appendChild(clone);
        sucursalIndex++;
    });

    // Eliminar sucursal al hacer clic en el botón cerrar
    document.getElementById('form-container').addEventListener('click', function (e) {
        if (e.target.closest('.cerrar-form')) {
            const sucursalForm = e.target.closest('.sucursal-form');
            sucursalForm.remove();
        }
    });
</script>
@endsection
