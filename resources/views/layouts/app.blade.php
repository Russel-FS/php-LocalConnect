<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LocalConnect') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Leaflet CSS mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-white text-gray-800" style="font-family: 'Inter', sans-serif;">
    <!-- Navbar -->
    <nav class="bg-white w-full fixed z-50" style="box-shadow:none; border:none;">
        <div class="max-w-7xl mx-auto px-8 flex justify-between h-20 items-center">
            <a href="/" class="text-2xl font-light tracking-tight text-gray-800 select-none">LocalConnect</a>
            <div class="flex items-center space-x-10">
                @if(Auth::check())
                @if(Auth::user()->isAdmin())
                <a href="/admin" class="flex items-center gap-2 px-5 py-2 rounded-full bg-white text-gray-700 font-light text-base hover:bg-gray-100 transition-all duration-150 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3v5a1 1 0 001 1h6a1 1 0 001-1v-5h3a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z" />
                    </svg>
                    <span class="tracking-tight">Administrar</span>
                </a>
                @endif
                <a href="{{ route('negocios.mis-negocios') }}"
                    class="flex items-center gap-2 px-5 py-2 rounded-full bg-white text-gray-700 font-light text-base hover:bg-gray-100 transition-all duration-150 focus:outline-none">
                    @include('components.icons.ui.business', ['class' => 'w-5 h-5'])
                    <span class="tracking-tight">Mis Negocios</span>
                </a>
                <div x-data="{ open: false }" class="relative ml-2">
                    <button @click="open = !open" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 font-light text-lg focus:outline-none transition">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-44 bg-white rounded-xl py-2 z-50" x-cloak style="box-shadow: 0 2px 16px 0 rgba(0,0,0,0.04); border:none;"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2">
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 text-left px-5 py-2 text-gray-700 font-light text-base hover:bg-gray-100 transition">
                                @include('components.icons.actions.logout', ['class' => 'w-5 h-5'])
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="px-5 py-2 rounded-full bg-white text-gray-700 font-light text-base hover:bg-gray-100 transition-all duration-150 focus:outline-none">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="px-5 py-2 rounded-full bg-gray-800 text-white font-light text-base hover:bg-gray-900 transition-all duration-150 focus:outline-none">Registrarse</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- contenido principal -->
    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-24" style="border:none; box-shadow:none;">
        <div class="max-w-7xl mx-auto px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-base font-light text-gray-800 select-none">LocalConnect</div>
            <div class="flex space-x-8 text-sm text-gray-400">
                <a href="#" class="hover:text-gray-800 transition-colors">Acerca de</a>
                <a href="#" class="hover:text-gray-800 transition-colors">Contacto</a>
                <a href="#" class="hover:text-gray-800 transition-colors">Términos</a>
            </div>
            <div class="text-xs text-gray-300">&copy; {{ date('Y') }} LocalConnect</div>
        </div>
    </footer>
</body>

</html>