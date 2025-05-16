@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Lista de Tiendas</h1>

        <a href="{{ route('tiendas.create') }}"
            class="w-full md:w-auto inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4">
            Crear Nueva Tienda
        </a>

        <!-- Botón para crear una nueva sucursal -->
        <a href="{{ route('sucursales.create') }}"
            class="w-full md:w-auto inline-block bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 mb-4">
            Crear Nueva Sucursal
        </a>

        <a href="{{ route('sucursales.index') }}"
            class="w-full md:w-auto inline-block bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 mb-4">
            Ver sucursales
        </a>

        <ul class="space-y-6">
            @foreach ($tiendas as $tienda)
                <li class="flex justify-between items-center p-4 border border-gray-300 rounded-md shadow-sm">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $tienda->nombre }}</h3>

                        <!-- Mostrar las sucursales asociadas a la tienda -->
                        <p class="text-sm text-gray-600">Sucursales:</p>
                        <ul class="list-disc pl-5 text-sm text-gray-600">
                            @foreach ($tienda->sucursales as $sucursal)
                                <li>{{ $sucursal->nombre_sucursal }} - {{ $sucursal->direccion }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('tiendas.edit', $tienda) }}"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Editar</a>

                        <form action="{{ route('tiendas.destroy', $tienda) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
