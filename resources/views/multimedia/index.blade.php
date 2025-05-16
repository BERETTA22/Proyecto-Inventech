@extends('layouts.app')

@section('title', 'Gestión de Multimedia')
@php use Illuminate\Support\Str; @endphp
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="bg-gray-100 min-h-screen flex flex-col items-center justify-start p-6">
    <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">Gestión de Multimedia</h1>

        <!-- Formulario para subir archivos -->
        <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <div class="flex items-center space-x-4">
                <input 
                    type="file" 
                    name="file" 
                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:outline-none" 
                    required>
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">
                    Subir archivo
                </button>
            </div>
        </form>

        <!-- Mostrar mensaje de éxito -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border-l-4 border-green-500 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Listado de archivos subidos -->
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Archivos subidos</h2>
        @if($files->isEmpty())
            <p class="text-gray-500">No hay archivos subidos.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($files as $file)
                    <div class="bg-gray-50 border border-gray-300 rounded-lg p-4 shadow-md">
                        @php
                            // Generar la ruta correcta para mostrar la imagen
                            $path = asset('storage/' . $file->tipo_archivo);
                           
                        @endphp

                        <!-- Visualización según el tipo de archivo -->
                        @if(Str::endsWith(strtolower($file->nombre_archivo), ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Imagen -->
                            <img src="{{ $path }}" alt="{{ $file->nombre_archivo }}" class="w-full h-48 object-cover rounded">
                        @elseif(Str::endsWith(strtolower($file->nombre_archivo), ['mp4', 'webm', 'ogg']))
                            <!-- Video -->
                            <video controls class="w-full h-48">
                                <source src="{{ $path }}" type="video/mp4">
                                Tu navegador no soporta videos.
                            </video>
                        @elseif(Str::endsWith(strtolower($file->nombre_archivo), ['mp3', 'wav', 'ogg']))
                            <!-- Audio -->
                            <audio controls class="w-full">
                                <source src="{{ $path }}" type="audio/mpeg">
                                Tu navegador no soporta audio.
                            </audio>
                        @else
                            <!-- Archivo genérico -->
                            <p class="text-gray-700">
                                Archivo: 
                                <a href="{{ $path }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ $file->nombre_archivo }}
                                </a>
                            </p>
                        @endif

                        <!-- Botón para eliminar -->
                        <form action="{{ route('multimedia.destroy', $file->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-sm w-full">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
