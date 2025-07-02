@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="container mx-auto mt-4 md:mt-8 px-2 md:px-4 max-w-7xl">
    <h1 class="text-2xl md:text-3xl font-bold text-center text-[#2c3e50] mb-4 md:mb-6">Lista de Usuarios</h1>

    <!-- Vista en tabla (solo en escritorio) -->
    <div class="hidden md:block overflow-x-auto">
        <table class="table-auto w-full border border-gray-300 rounded-lg">
            <thead class="bg-[#2c3e50] text-white">
                <tr>
                    <th class="px-3 py-2">Nombre</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Username</th>
                    <th class="px-3 py-2">Rol</th>
                    <th class="px-3 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="usuarios-table" class="bg-white">
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">Cargando usuarios...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Vista en tarjetas (solo en móvil) -->
    <div id="usuarios-cards" class="md:hidden space-y-4 mt-4">
        <!-- Aquí se cargan dinámicamente -->
    </div>

    <!-- Botón agregar -->
    <div class="mt-4 md:mt-6 flex justify-center">
        <a href="{{ route('usuarios.create') }}" 
           class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-2 px-4 rounded text-sm md:text-base">
            Agregar Nuevo Usuario
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const tableBody = document.getElementById('usuarios-table');
        const cardsContainer = document.getElementById('usuarios-cards');

        try {
            const res = await fetch('http://localhost:8080/api/users');
            const users = await res.json();

            if (users.length === 0) {
                tableBody.innerHTML = `
                    <tr><td colspan="5" class="text-center text-gray-500 py-4">No hay usuarios registrados.</td></tr>`;
                cardsContainer.innerHTML = `
                    <div class="bg-white rounded-lg shadow p-4 text-center text-gray-500">
                        No hay usuarios registrados.
                    </div>`;
                return;
            }

            // Limpiar contenidos previos
            tableBody.innerHTML = '';
            cardsContainer.innerHTML = '';

            users.forEach(user => {
                // Tabla (escritorio)
                const row = document.createElement('tr');
                row.className = 'border-b border-gray-200 hover:bg-gray-100';
                row.innerHTML = `
                    <td class="px-3 py-2 text-center">${user.name}</td>
                    <td class="px-3 py-2 text-center">${user.email}</td>
                    <td class="px-3 py-2 text-center">${user.username}</td>
                    <td class="px-3 py-2 text-center">${getRole(user.roleId)}</td>
                    <td class="px-3 py-2 flex justify-center gap-2">
                        <a href="/usuarios/${user.id}/edit" 
                           class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-1 px-2 rounded text-sm">
                            Editar
                        </a>
                        <form action="/usuarios/${user.id}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);

                // Tarjeta (móvil)
                const card = document.createElement('div');
                card.className = 'bg-white rounded-lg shadow-md p-4 border border-gray-200';
                card.innerHTML = `
                    <div class="mb-2">
                        <span class="font-semibold text-gray-600">Nombre:</span>
                        <span class="ml-2">${user.name}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold text-gray-600">Email:</span>
                        <span class="ml-2">${user.email}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold text-gray-600">Username:</span>
                        <span class="ml-2">${user.username}</span>
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold text-gray-600">Rol:</span>
                        <span class="ml-2">${getRole(user.roleId)}</span>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <a href="/usuarios/${user.id}/edit" 
                           class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-1.5 px-3 rounded text-sm">
                            Editar
                        </a>
                        <form action="/usuarios/${user.id}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded text-sm">
                                Eliminar
                            </button>
                        </form>
                    </div>
                `;
                cardsContainer.appendChild(card);
            });

        } catch (err) {
            tableBody.innerHTML = `
                <tr><td colspan="5" class="text-center text-red-500 py-4">
                    Error cargando usuarios: ${err.message}
                </td></tr>`;
            cardsContainer.innerHTML = `
                <div class="bg-white rounded-lg shadow p-4 text-center text-red-500">
                    Error cargando usuarios: ${err.message}
                </div>`;
        }

        function getRole(id) {
            switch (id) {
                case 1: return 'Administrador';
                case 2: return 'Empleado';
                case 3: return 'Cliente';
                default: return 'Sin rol';
            }
        }
    });
</script>
@endsection
