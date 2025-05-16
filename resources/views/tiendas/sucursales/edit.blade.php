@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Editar Sucursal: {{ $sucursal->nombre_sucursal }}</h1>

        <form action="{{ route('sucursales.update', $sucursal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre_sucursal" class="block text-sm font-medium text-gray-700">Nombre de la Sucursal</label>
                <input type="text" name="nombre_sucursal" id="nombre_sucursal" value="{{ old('nombre_sucursal', $sucursal->nombre_sucursal) }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>

            <div class="mb-4">
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $sucursal->direccion) }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>

            <div class="mb-4">
                <label for="contacto" class="block text-sm font-medium text-gray-700">Contacto</label>
                <input type="text" name="contacto" id="contacto" value="{{ old('contacto', $sucursal->contacto) }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="tienda_id" class="block text-sm font-medium text-gray-700">Seleccionar Tienda</label>
                <select name="tienda_id" id="tienda_id"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @foreach ($tiendas as $tienda)
                        <option value="{{ $tienda->id }}" {{ $tienda->id == $sucursal->tienda_id ? 'selected' : '' }}>
                            {{ $tienda->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="w-full md:w-auto inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Actualizar Sucursal
                </button>
            </div>
        </form>
    </div>
@endsection
