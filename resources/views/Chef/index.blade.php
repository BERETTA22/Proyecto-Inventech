@extends('layouts.app')

@section('title', 'Lista de Chefs')

@section('content')

<!-- Asegúrate de incluir el archivo de estilos de Tailwind -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold text-center mb-6">Lista de Chefs</h1>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Especialidad</th>
                    <th class="px-4 py-2">Experiencia</th>
                    <th class="px-4 py-2">Nacionalidad</th>
                    <th class="px-4 py-2">Restaurante</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($chef as $chef)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-4 py-2 text-center">{{ $chef->Nombre }}</td>
                        <td class="px-4 py-2 text-center">{{ $chef->Especialidad }}</td>
                        <td class="px-4 py-2 text-center">{{ $chef->Años_experiencia }}</td>
                        <td class="px-4 py-2 text-center">{{ $chef->Nacionalidad }}</td>
                        <td class="px-4 py-2 text-center">{{ $chef->Restaurante }}</td>
                        <td class="px-4 py-2 flex justify-center gap-2">
                            <a href="{{ route('chef.edit', $chef->id) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Editar
                            </a>
                            <form action="{{ route('chef.destroy', $chef->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" 
                                        onclick="return confirm('¿Estás seguro de eliminar este chef?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        <a href="{{ route('chef.create') }}" 
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Agregar Nuevo Chef
        </a>
    </div>
</div>
@endsection
