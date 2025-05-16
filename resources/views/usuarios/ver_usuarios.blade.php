@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<!-- Incluye los estilos y scripts necesarios -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container mx-auto mt-4 md:mt-8 px-2 md:px-4 max-w-7xl">
    <!-- Título principal -->
    <h1 class="text-2xl md:text-3xl font-bold text-center text-[#2c3e50] mb-4 md:mb-6">Lista de Usuarios</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 md:px-4 md:py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de usuarios - Versión escritorio (oculta en móvil) -->
    <div class="hidden md:block overflow-x-auto">
        <table class="table-auto w-full border border-gray-300 rounded-lg">
            <thead class="bg-[#2c3e50] text-white">
                <tr>
                    <th class="px-3 py-2 md:px-4">Nombre</th>
                    <th class="px-3 py-2 md:px-4">Email</th>
                    <th class="px-3 py-2 md:px-4">Username</th>
                    <th class="px-3 py-2 md:px-4">Rol</th>
                    <th class="px-3 py-2 md:px-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-3 py-2 md:px-4 text-center">{{ $user->name }}</td>
                        <td class="px-3 py-2 md:px-4 text-center">{{ $user->email }}</td>
                        <td class="px-3 py-2 md:px-4 text-center">{{ $user->username }}</td>
                        <td class="px-3 py-2 md:px-4 text-center">{{ $user->role->name ?? 'Sin rol' }}</td>
                        <td class="px-3 py-2 md:px-4 flex justify-center gap-2">
                            <!-- Botón de Editar -->
                            <a href="{{ route('usuarios.edit', $user->id) }}" 
                               class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-1 px-2 rounded text-sm">
                                Editar
                            </a>
                            <!-- Botón de Eliminar -->
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm" 
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <!-- Si no hay usuarios -->
                    <tr>
                        <td colspan="5" class="px-3 py-2 md:px-4 text-center text-gray-500">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vista de tarjetas para móvil (visible solo en móvil) -->
    <div class="md:hidden space-y-4">
        @forelse ($users as $user)
            <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                <div class="mb-2">
                    <span class="font-semibold text-gray-600">Nombre:</span>
                    <span class="ml-2">{{ $user->name }}</span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-gray-600">Email:</span>
                    <span class="ml-2">{{ $user->email }}</span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-gray-600">Username:</span>
                    <span class="ml-2">{{ $user->username }}</span>
                </div>
                <div class="mb-3">
                    <span class="font-semibold text-gray-600">Rol:</span>
                    <span class="ml-2">{{ $user->role->name ?? 'Sin rol' }}</span>
                </div>
                <div class="flex gap-2 justify-end">
                    <!-- Botón de Editar -->
                    <a href="{{ route('usuarios.edit', $user->id) }}" 
                       class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-1.5 px-3 rounded text-sm">
                        Editar
                    </a>
                    <!-- Botón de Eliminar -->
                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded text-sm" 
                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-4 text-center text-gray-500">
                No hay usuarios registrados.
            </div>
        @endforelse
    </div>

    <!-- Botón para agregar nuevo usuario -->
    <div class="mt-4 md:mt-6 flex justify-center">
        <a href="{{ route('usuarios.create') }}" 
           class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-2 px-4 rounded text-sm md:text-base">
            Agregar Nuevo Usuario
        </a>
    </div>
</div>
@endsection