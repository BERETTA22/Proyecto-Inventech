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

    <!-- Estilos responsive adicionales -->
    <style>
        /* Estilos base */
        .sidebar {
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            background-color: #1e293b;
            color: white;
            z-index: 50;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }

        /* Botón de menú móvil */
        .mobile-menu-button {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 60;
            background-color: #1e293b;
            color: white;
            border-radius: 0.375rem;
            padding: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        /* Overlay para móvil cuando el menú está abierto */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }

        /* Estilos responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 240px;
            }
            .main-content {
                margin-left: 240px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .mobile-menu-button {
                display: block;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">
        <!-- Botón de menú móvil -->
        <button 
            class="mobile-menu-button" 
            @click="sidebarOpen = !sidebarOpen"
            aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Overlay para cerrar el menú en móvil -->
        <div 
            class="sidebar-overlay" 
            :class="{'show': sidebarOpen}" 
            @click="sidebarOpen = false">
        </div>

        <!-- Sidebar -->
        <aside 
            class="sidebar" 
            :class="{'open': sidebarOpen}"
            @keydown.escape="sidebarOpen = false">
            <nav>
                <!-- Sección INVENTECH -->
                <div class="sidebar-header">
                    INVENTECH
                </div>

                <!-- Navegación -->
                <ul class="p-4">
                    <!-- Panel de control -->
                    <li class="mb-4">
                        <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Panel de control</span>
                        </a>
                    </li>

                    <!-- Accesos -->
                    <li class="mb-4">
                        <a href="{{ route('usuarios.ver_usuarios') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Accesos</span>
                        </a>
                    </li>

                    <!-- Categorías -->
                    <li class="mb-4">
                        <a href="{{ route('categorias.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            <span>Categorías</span>
                        </a>
                    </li>

                    <!-- Productos -->
                    <li class="mb-4">
                        <a href="{{ route('productos.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2-2H7m4 4H5m7-6V5h3a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h3V5"></path>
                            </svg>
                            <span>Productos</span>
                        </a>
                    </li>

                    <!-- Multimedia -->
                    <li class="mb-4">
                        <a href="{{ route('multimedia.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18M3 12h18"></path>
                            </svg>
                            <span>Multimedia</span>
                        </a>
                    </li>

                    <!-- Despachos -->
                    <li class="mb-4">
                        <a href="{{ route('despachos.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20.5V3.5M6 16l6 6 6-6M6 8l6-6 6 6"></path>
                            </svg>
                            <span>Despachos</span>
                        </a>
                    </li>

                    <!-- Reporte de despachos -->
                    <li class="mb-4">
                        <a href="{{ route('reportedespachos.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Reporte de despachos</span>
                        </a>
                    </li>

                    <!-- Tiendas -->
                    <li class="mb-4">
                        <a href="{{ route('tiendas.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition-colors" @click="sidebarOpen = false">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Tiendas</span>
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
        </div>
    </div>
</body>
</html>