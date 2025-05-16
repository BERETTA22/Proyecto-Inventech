@extends('layouts.employee')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Mis Despachos</h2>

    @if($despachos->isEmpty())
        <p class="text-gray-600">No tienes despachos asignados.</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach($despachos as $despacho)
                <li class="p-4 hover:bg-gray-100 transition rounded-lg">
                    <span class="font-semibold text-gray-700">ID:</span> {{ $despacho->id }}<br>
                    <span class="font-semibold text-gray-700">Sucursal:</span> 
                    {{ $despacho->sucursal->nombre_sucursal ?? 'N/A' }}<br>
                    <span class="font-semibold text-gray-700">Estado:</span> 
                    <span class="px-2 py-1 rounded text-white 
                        {{ $despacho->estado === 'completado' ? 'bg-green-500' : 'bg-yellow-500' }}">
                        {{ ucfirst($despacho->estado) }}
                    </span>
                    <br>
                    <a href="{{ route('empleados.despachos.detalle', $despacho->id) }}" 
                       class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Ver Detalle
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

