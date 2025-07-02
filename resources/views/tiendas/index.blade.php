@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Lista de Tiendas</h1>

        <!-- Botones superiores -->
        <div class="flex flex-col md:flex-row md:space-x-4 mb-6 space-y-2 md:space-y-0">
            <a href="{{ route('tiendas.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 text-center">
                Crear Nueva Tienda
            </a>
            <a href="{{ route('sucursales.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-center">
                Crear Nueva Sucursal
            </a>
            <a href="{{ route('sucursales.index') }}"
                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-center">
                Ver Sucursales
            </a>
        </div>

        <!-- Lista de tiendas -->
        <ul class="space-y-6">
            @foreach ($tiendas as $tienda)
                <li class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 border border-gray-300 rounded-md shadow-sm">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold">{{ $tienda->nombre }}</h3>

                        <p class="text-sm {{ $tienda->estado ? 'text-green-600' : 'text-red-600' }} font-medium">
                            Estado: {{ $tienda->estado ? 'Activa' : 'Inactiva' }}
                        </p>

                        <p class="text-sm text-gray-600 mt-2">Sucursales:</p>
                        <ul class="list-disc pl-5 text-sm text-gray-600">
                            @foreach ($tienda->sucursales as $sucursal)
                                <li>{{ $sucursal->nombre_sucursal }} - {{ $sucursal->direccion }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-4 md:mt-0 flex space-x-3">
                        <a href="{{ route('tiendas.edit', $tienda) }}"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                            Editar
                        </a>

                        <form action="{{ route('tiendas.toggleEstado', $tienda) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="{{ $tienda->estado ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-2 rounded-md">
                                {{ $tienda->estado ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
