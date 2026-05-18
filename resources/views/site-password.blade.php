<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sitio en preparación</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="w-full max-w-sm px-6">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Sitio en preparación</h1>
            <p class="text-gray-500 mt-2 text-sm">Ingresa la contraseña para ver el sitio.</p>
        </div>

        <form method="POST" action="{{ route('site.unlock') }}" class="bg-white shadow-md rounded-xl px-8 py-8 space-y-5">
            @csrf

            @if($error)
                <div class="text-sm text-red-600 text-center">{{ $error }}</div>
            @endif

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autofocus
                    autocomplete="current-password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    placeholder="••••••••"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-gray-800 text-white text-sm font-medium py-2 rounded-lg hover:bg-gray-700 transition-colors"
            >
                Ingresar
            </button>
        </form>
    </div>
</body>
</html>
