@extends('layouts.app')

@section('title', 'Editar Chef')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-center text-2xl font-semibold mb-6">Editar Chef</h1>

    <form action="{{ route('chef.update', $chef->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Chef</label>
            <input type="text" name="nombre" id="nombre" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('nombre', $chef->Nombre) }}" required>
        </div>

        <div class="mb-4">
            <label for="experiencia" class="block text-sm font-medium text-gray-700">Años de experiencia</label>
            <input type="text" name="experiencia" id="experiencia" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('experiencia', $chef->Años_experiencia) }}" required>
        </div>

        <div class="mb-4">
            <label for="nacionalidad" class="block text-sm font-medium text-gray-700">Nacionalidad</label>
            <input type="text" name="nacionalidad" id="nacionalidad" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('nacionalidad', $chef->Nacionalidad) }}" required>
        </div>

        <div class="mb-4">
            <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
            <input type="text" name="especialidad" id="especialidad" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('especialidad', $chef->Especialidad) }}" required>
        </div>

        <div class="mb-4">
            <label for="restaurante" class="block text-sm font-medium text-gray-700">Restaurante</label>
            <input type="text" name="restaurante" id="restaurante" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('restaurante', $chef->Restaurante) }}" required>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar Chef</button>
    </form>
</div>
@endsection
