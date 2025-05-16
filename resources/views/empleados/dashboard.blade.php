@extends('layouts.employee')

@section('title', 'Dashboard')
@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Hola, {{ Auth::user()->name }} 👋</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
            <h2 class="text-xl font-semibold text-gray-700">Despachos completados</h2>
            <p class="text-3xl mt-2 text-blue-600">{{ $despachosCompletados }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
            <h2 class="text-xl font-semibold text-gray-700">Pendientes por completar</h2>
            <p class="text-3xl mt-2 text-yellow-600">{{ $despachosPendientes }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
            <h2 class="text-xl font-semibold text-gray-700">Última actividad</h2>
            <p class="text-sm mt-2 text-gray-600">Último despacho: {{ $ultimoDespacho?->fecha ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Despachos recientes</h2>
        <ul class="divide-y divide-gray-200">
            @forelse ($despachosRecientes as $despacho)
                <li class="py-3">
                    <p class="text-gray-800 font-medium">#{{ $despacho->id }} - {{ $despacho->estado }} - {{ $despacho->fecha }}</p>
                    <p class="text-sm text-gray-500">{{ $despacho->comentarios }}</p>
                </li>
            @empty
                <li class="py-3 text-gray-500">No hay despachos recientes.</li>
            @endforelse
        </ul>
    </div>
</div>


@endsection