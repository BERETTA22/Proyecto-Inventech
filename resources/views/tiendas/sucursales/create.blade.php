@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Crear Sucursal</h1>

        <form action="{{ route('sucursales.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="tienda_id" class="block text-sm font-medium text-gray-700">Seleccionar Tienda</label>
                <select name="tienda_id" id="tienda_id" required
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccione una tienda</option>
                    @foreach ($tiendas as $tienda)
                        <option value="{{ $tienda->id }}" {{ old('tienda_id') == $tienda->id ? 'selected' : '' }}>
                            {{ $tienda->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('tienda_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nombre_sucursal" class="block text-sm font-medium text-gray-700">Nombre de la Sucursal</label>
                <input type="text" id="nombre_sucursal" name="nombre_sucursal" value="{{ old('nombre_sucursal') }}"
                    required
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nombre_sucursal')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('direccion')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contacto" class="block text-sm font-medium text-gray-700">Contacto</label>
                <input type="text" id="contacto" name="contacto" value="{{ old('contacto') }}"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Crear Sucursal
                </button>
            </div>
        </form>
    </div>
@endsection
