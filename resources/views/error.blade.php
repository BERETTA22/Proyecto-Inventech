<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-red-600">¡Error!</h1>
        <p class="mt-4 text-gray-700">Algo salió mal. Por favor, intenta nuevamente.</p>
        <a href="{{ url('/dashboard') }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            Volver al Dashboard
        </a>
    </div>
</body>
</html>