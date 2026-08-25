<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Blog de Avisos')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-950 text-white">
        <div class="max-w-4xl mx-auto flex items-center justify-between px-8 py-4">
            <a href="{{ route('inicio') }}" class="font-bold hover:text-blue-200 transition">Blog de Avisos</a>
            <div class="flex gap-4 text-sm">
                <a href="{{ route('inicio') }}" class="hover:text-blue-200 transition">Inicio</a>
                <a href="{{ route('contacto') }}" class="hover:text-blue-200 transition">Contacto</a>
            </div>
        </div>
    </nav>

    @yield('contenido')
</body>
</html>