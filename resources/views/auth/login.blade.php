<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

           <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="d-flex justify-content-center align-items-center vh-100" 
          style="background-image: url('{{ asset('img/compania-haceb.jpg') }}'); 
                 background-size: cover; 
                 background-position: center; 
                 background-repeat: no-repeat;">
        <div class="p-4 rounded shadow-lg" style="background: rgba(255, 255, 255, 0.7); width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <h1 class="h3">Bienvenido</h1>
                <p class="text-muted">Iniciar sesión</p>
            </div>

            <!-- Mensajes de sesión -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="text-danger small" />
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="text-danger small" />
                </div>

                <!-- Recordar -->
                <div class="mb-3 form-check">
                    <input type="checkbox" id="remember_me" class="form-check-input" name="remember">
                    <label class="form-check-label" for="remember_me">Recordarme</label>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none small">¿Olvidaste tu contraseña?</a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>
