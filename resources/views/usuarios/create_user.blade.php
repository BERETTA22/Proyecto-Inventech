<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
         // Validar antes de enviar
        $('form').on('submit', function (e) {
            const name = $('#name').val().trim();
            const username = $('#username').val().trim();
            const email = $('#email').val().trim();
            const password = $('#password').val();
            const passwordConfirmation = $('#password_confirmation').val();

            // Expresiones regulares
            const nameRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,255}$/;
            const usernameRegex = /^(?=.*[A-Za-z])[A-Za-z0-9_]{4,255}$/;
            const emailRegex = /^[\w\.-]+@[\w\.-]+\.(com)$/i;

            // Validaciones
            if (!nameRegex.test(name)) {
                alert('El nombre debe tener solo letras (mínimo 2 caracteres).');
                e.preventDefault();
                return;
            }

            if (!usernameRegex.test(username)) {
                alert('El username debe tener letras y puede incluir números o guiones bajos (mínimo 4 caracteres).');
                e.preventDefault();
                return;
            }

            if (!emailRegex.test(email)) {
                alert('El correo debe ser válido y terminar en .com.');
                e.preventDefault();
                return;
            }

            if (password.length < 8) {
                alert('La contraseña debe tener al menos 8 caracteres.');
                e.preventDefault();
                return;
            }

            if (password !== passwordConfirmation) {
                alert('Las contraseñas no coinciden.');
                e.preventDefault();
                return;
            }
        });
    });
        // Evitar espacios iniciales en los inputs
        $(document).on('input', 'input, textarea', function() {
            let value = $(this).val();
            $(this).val(value.replace(/^\s+/, '')); // Eliminar espacios iniciales
        });

</script>
@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-3xl font-bold text-center text-[#2c3e50] mb-6">Registrar Nuevo Usuario</h1>
    <form method="POST" action="{{ route('usuarios.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
            @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input 
                id="username" 
                type="text" 
                name="username" 
                value="{{ old('username') }}" 
                required 
                autocomplete="username" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
            @error('username')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
            @error('email')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
            @error('password')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmar Contraseña</label>
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
            @error('password_confirmation')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rol -->
        <div class="mb-4">
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
            <select 
                id="role" 
                name="role" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                @foreach (\App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
            @error('role')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón de Enviar -->
        <div class="flex items-center justify-end mt-4">
            <button 
                type="submit" 
                class="bg-[#16a085] hover:bg-[#1abc9c] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Registrar
            </button>
        </div>
    </form>
</div>
@endsection
