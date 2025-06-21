<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LocalConnect') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <!-- Leaflet CSS mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-bg text-gray-900">
    <!-- Navbar -->
    <nav class="navbar-main">
        <div class="mx-auto max-w-7xl px-6 flex justify-between h-16 items-center">
            <a href="/" class="text-2xl font-extrabold tracking-tight text-primary-600 select-none">LocalConnect</a>
            <div class="flex items-center space-x-2">
                @if(Auth::check())
                <a href="{{ route('negocios.mis-negocios') }}" class="btn-outline">Mis Negocios</a>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="btn-outline">Cerrar sesión</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn-outline">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn-solid">Registrarse</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- contenido principal -->
    <main class="pt-16 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-24 text-primary-400 bg-white/90 border-t border-gray-100">
        <div class="mx-auto max-w-7xl px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-lg font-semibold text-primary-600 select-none">LocalConnect</div>
            <div class="flex space-x-6 text-sm">
                <a href="#" class="hover:text-primary-600 transition-colors">Acerca de</a>
                <a href="#" class="hover:text-primary-600 transition-colors">Contacto</a>
                <a href="#" class="hover:text-primary-600 transition-colors">Términos</a>
            </div>
            <div class="text-xs">&copy; {{ date('Y') }} LocalConnect</div>
        </div>
    </footer>
</body>

</html>