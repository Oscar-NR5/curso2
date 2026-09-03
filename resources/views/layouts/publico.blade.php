<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Bitácora de Avisos')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell">
    <nav class="site-nav">
        <div class="nav-inner">
            <a href="{{ route('avisos.index') }}" class="brand">Bitácora de Avisos</a>
            <div class="nav-links">
                <a href="{{ route('avisos.index') }}" class="nav-link">Avisos</a>
                <a href="{{ route('contacto') }}" class="nav-link">Contacto</a>
                @auth
                    <span class="user-name">Hola, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-button">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </nav>
    @yield('contenido')
</body>
</html>