<x-guest-layout>
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-image: url('/path/to/your/background.jpg'); background-size: cover; background-position: center;">
        <div class="p-4 rounded shadow-lg" style="background: rgba(255, 255, 255, 0.5); width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <h1 class="h5">Recuperar contraseña</h1>
                <p class="text-muted">¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.</p>
            </div>

            <!-- Mensajes de sesión -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Dirección de correo -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                </div>

                <!-- Botón enviar -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Enviar enlace de restablecimiento
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
