@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles del Reporte</h2>
    <p><strong>ID del Reporte:</strong> {{ $reporte->id }}</p>
    <p><strong>Descripción:</strong> {{ $reporte->descripcion }}</p>
    <p><strong>Producto ID:</strong> {{ $reporte->producto_id }}</p>
    <p><strong>Empleado ID:</strong> {{ $reporte->empleado_id }}</p>
    <p><strong>Despacho ID:</strong> {{ $reporte->despacho_id }}</p>

    @if ($reporte->despacho)
        <p><strong>Detalles del Despacho:</strong></p>
        <p><strong>ID:</strong> {{ $reporte->despacho->id }}</p>
        <p><strong>Fecha:</strong> {{ $reporte->despacho->created_at }}</p>
    @else
        <p class="text-red-500">Este reporte no tiene un despacho asociado.</p>
    @endif
</div>
@endsection
