<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="max-w-xl mx-auto bg-white p-10 rounded-xl shadow-xl space-y-6">
        @csrf

        <h1 class="text-2xl font-bold text-center text-indigo-700">Crear Cuenta</h1>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required autofocus autocomplete="name" />
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Nombre de usuario</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required autocomplete="username" />
            @error('username')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required autocomplete="email" />
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input id="password" type="password" name="password"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required autocomplete="new-password" />
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required autocomplete="new-password" />
            @error('password_confirmation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rol -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Seleccionar rol</label>
            <select name="role" id="role"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                    required>
                @foreach (\App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                ¿Ya tienes cuenta?
            </a>
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition shadow">
                Registrarse
            </button>
        </div>
    </form>
</x-guest-layout>
