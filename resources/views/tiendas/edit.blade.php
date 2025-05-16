@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Editar Tienda: {{ $tienda->nombre }}</h1>

        <form action="{{ route('tiendas.update', $tienda) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Tienda</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $tienda->nombre) }}" required
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nombre')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Actualizar Tienda
                </button>
            </div>
        </form>
    </div>
@endsection
