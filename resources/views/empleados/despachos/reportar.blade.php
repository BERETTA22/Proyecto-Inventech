@extends('layouts.employee')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Reportar Problema</h2>

    {{-- Mostrar mensajes de éxito o error --}}
    @if (session('success'))
        <div class="p-3 mb-4 text-green-700 bg-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="p-3 mb-4 text-red-700 bg-red-200 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- Verificar que existen los datos antes de mostrarlos --}}
    @isset($despacho, $producto)
        <p class="text-gray-700">Despacho ID: <strong>{{ $despacho->id }}</strong></p>
        <p class="text-gray-700">Producto: <strong>{{ $producto->nombre }}</strong></p>
    @else
        <p class="text-red-500">Error: Datos no disponibles.</p>
    @endisset

    {{-- Formulario para reportar problema --}}
    <form action="{{ route('reportes.store') }}" method="POST" class="mt-4">
        @csrf

        {{-- Inputs ocultos para mantener los IDs del despacho y producto --}}
        <input type="hidden" name="producto_id" value="{{ $producto->id ?? '' }}">
        <input type="hidden" name="despacho_id" value="{{ $despacho->id ?? '' }}">

        {{-- Campo de descripción del problema --}}
        <label for="descripcion" class="block text-gray-700 font-semibold">Describe el problema:</label>
        <textarea id="descripcion" name="descripcion" class="w-full border-gray-300 rounded-lg p-2 mt-2"
                  placeholder="Escribe una descripción detallada del problema">{{ old('descripcion') }}</textarea>

        {{-- Mostrar mensaje de error si falta la descripción --}}
        @error('descripcion')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        {{-- Botón para enviar el formulario --}}
        <button type="submit" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
            Enviar Reporte
        </button>
    </form>
</div>
@endsection
