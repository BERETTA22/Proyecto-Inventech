@extends('layouts.app') {{-- Asegúrate de que extiendes tu layout principal --}}

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold text-center mb-8 text-gray-800">Estadísticas de Productos</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Incluye la gráfica de productos más despachados --}}
        @include('reportedespachos.productosmasdespachados')

        {{-- Incluye la gráfica de productos en stock --}}
        @include('reportedespachos.productosenstock')
    </div>

</div>
@endsection
