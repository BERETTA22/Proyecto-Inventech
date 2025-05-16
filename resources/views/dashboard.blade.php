@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-gray-100 min-h-screen py-6 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 md:text-3xl">Panel de Control</h1>

        <!-- Sección de resumen -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            @foreach ([
                [
                    'color' => 'bg-gradient-to-r from-green-500 to-green-600',
                    'title' => 'Usuarios',
                    'count' => $userCount,
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'route' => route('usuarios.ver_usuarios')
                ],
                [
                    'color' => 'bg-gradient-to-r from-orange-500 to-orange-600',
                    'title' => 'Categorías',
                    'count' => $categoryCount,
                    'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                    'route' => route('categorias.index')
                ],
                [
                    'color' => 'bg-gradient-to-r from-blue-500 to-blue-600',
                    'title' => 'Productos',
                    'count' => $productCount,
                    'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                    'route' => route('productos.index')
                ],
                [
                    'color' => 'bg-gradient-to-r from-yellow-500 to-yellow-600',
                    'title' => 'Tiendas',
                    'count' => 2,
                    'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                    'route' => route('tiendas.index')
                ],
            ] as $item)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:scale-105 duration-300">
                <div class="p-5 {{ $item['color'] }} flex items-center space-x-4">
                    <div class="flex-shrink-0 bg-white/20 p-3 rounded-lg">
                        <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                        </svg>
                    </div>
                    <div class="ml-2 text-white">
                        <p class="text-sm font-medium uppercase tracking-wider">{{ $item['title'] }}</p>
                        <p class="text-3xl font-bold">{{ $item['count'] }}</p>
                    </div>
                </div>
                <div class="px-5 py-3 bg-gray-50">
                    <a href="{{ $item['route'] }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium flex items-center">
                        Ver detalles
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tablas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Productos más despachados -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Productos más despachados</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total hoy</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($productosMasDespachados as $producto)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $producto->nombre }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-500">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $producto->cantidad_hoy }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $producto->cantidad_total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 text-right">
                    <a href="{{ route('productos.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-900">Ver todos</a>
                </div>
            </div>

            <!-- Últimos despachos -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Últimos despachos</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sucursal</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Venta total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($ultimosDespachos as $index => $despacho)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $despacho->sucursal ?? $despacho->producto }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-500">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ \Carbon\Carbon::parse($despacho->fecha)->format('d M, Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-green-600">${{ number_format($despacho->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 text-right">
                    <a href="{{ route('despachos.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-900">Ver todos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
