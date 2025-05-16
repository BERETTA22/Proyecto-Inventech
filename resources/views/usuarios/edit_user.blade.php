<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Evitar espacios iniciales en los inputs
        $(document).on('input', 'input, textarea', function() {
            let value = $(this).val();
            $(this).val(value.replace(/^\s+/, '')); // Eliminar espacios iniciales
        });
    });
</script>
@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-6">Editar Usuario</h2>

        <!-- Formulario de edición de usuario -->
        <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                    required autofocus>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                    required>
                @error('username')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                <select id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == old('role', $user->role_id) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
@endsection
