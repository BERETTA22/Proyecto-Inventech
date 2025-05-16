<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav>
                <!-- Sección INVENTECH -->
                <div class="sidebar-header">
                    INVENTECH
                </div>

                <!-- Navegación -->
                <ul class="p-4">
                    <!-- Panel de control -->
                    <li class="mb-4">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Panel de control</span>
                        </a>
                    </li>

                    <!-- Despachos -->
                    <li class="mb-4">
                        <a href="{{ route('empleados.despachos.mis-despachos') }}" class="submenu-toggle flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20.5V3.5M6 16l6 6 6-6M6 8l6-6 6 6"></path>
                            </svg>
                            <span>Mis Despachos</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <div class="main-content">
            @include('layouts.navigation')

           <!-- Page Content -->
<main class="p-4">
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow mb-4">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Main content here -->
    @yield('content')
</main>
