<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LocalConnect') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

<body class="font-sans antialiased bg-gray-50 text-gray-900" style="font-family: 'Inter', sans-serif;">
    <!-- Navbar moderno -->
    <nav class="bg-white/80 backdrop-blur-md w-full fixed z-50 border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16 lg:h-20 items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl flex items-center justify-center shadow-lg shadow-primary-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span
                        class="text-xl lg:text-2xl font-semibold tracking-tight text-gray-900 group-hover:text-primary-600 transition-colors duration-200">
                        LocalConnect
                    </span>
                </a>

                <!-- Navegación -->
                <div class="flex items-center gap-2 lg:gap-4">
                    @if (Auth::check())
                        @if (Auth::user()->isAdmin())
                            <a href="/admin"
                                class="hidden lg:flex items-center gap-2 px-4 py-2 rounded-xl text-gray-600 font-medium text-sm hover:bg-gray-100 hover:text-gray-900 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>Admin</span>
                            </a>
                        @endif

                        <a href="{{ route('negocios.mis-negocios') }}"
                            class="hidden lg:flex items-center gap-2 px-4 py-2 rounded-xl text-gray-600 font-medium text-sm hover:bg-gray-100 hover:text-gray-900 transition-all duration-200">
                            <x-icons.ui.business class="w-4 h-4" />
                            <span>Mis Negocios</span>
                        </a>

                        <!-- Avatar y menú de usuario -->
                        <div x-data="{ open: false }" class="relative hidden lg:block">
                            <button @click="open = !open"
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-700 font-semibold text-sm hover:from-gray-200 hover:to-gray-300 transition-all duration-200 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-3 w-56 bg-white rounded-2xl py-3 shadow-xl border border-gray-100 z-50"
                                x-cloak x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2">

                                <!-- Info del usuario -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>

                                <!-- Opciones del menú -->
                                <div class="py-2">
                                    <a href="{{ route('negocios.mis-negocios') }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <x-icons.ui.business class="w-4 h-4" />
                                        <span>Mis Negocios</span>
                                    </a>

                                    @if (Auth::user()->isAdmin())
                                        <a href="/admin"
                                            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            <span>Administrar</span>
                                        </a>
                                    @endif

                                    <form method="POST" action="{{ url('/logout') }}"
                                        class="border-t border-gray-100 mt-2 pt-2">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <x-icons.actions.logout class="w-4 h-4" />
                                            <span>Cerrar sesión</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Botones para usuarios no autenticados -->
                        <div class="flex items-center gap-2 lg:gap-3">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 rounded-xl text-gray-600 font-medium text-sm hover:bg-gray-100 hover:text-gray-900 transition-all duration-200">
                                Iniciar sesión
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-xl bg-gray-900 text-white font-medium text-sm hover:bg-gray-800 transition-all duration-200 shadow-sm">
                                Registrarse
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="pt-16 lg:pt-20 min-h-screen pb-20 lg:pb-0">
        @yield('content')
    </main>

    <!-- Mennu inferior flotante para móvillllll -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 shadow-lg">
        <div class="flex items-center justify-around px-2 py-2">
            <!-- Inicio -->
            <a href="/"
                class="flex flex-col items-center gap-1 px-3 py-2 rounded-xl transition-colors duration-200 {{ request()->is('/') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs font-medium">Inicio</span>
            </a>

            <!-- Buscar -->
            <a href="{{ route('negocios.buscar') }}"
                class="flex flex-col items-center gap-1 px-3 py-2 rounded-xl transition-colors duration-200 {{ request()->routeIs('negocios.buscar') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span class="text-xs font-medium">Buscar</span>
            </a>

            @if (Auth::check())
                <!-- Mis Negocios -->
                <a href="{{ route('negocios.mis-negocios') }}"
                    class="flex flex-col items-center gap-1 px-3 py-2 rounded-xl transition-colors duration-200 {{ request()->routeIs('negocios.mis-negocios') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <x-icons.ui.business class="w-6 h-6" />
                    <span class="text-xs font-medium">Mis Negocios</span>
                </a>
            @endif

            <!-- Cuenta -->
            @if (Auth::check())
                <a href="/perfil"
                    class="flex flex-col items-center gap-1 px-3 py-2 rounded-xl transition-colors duration-200 {{ request()->is('perfil*') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <div
                        class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <span
                            class="text-xs font-semibold text-gray-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <span class="text-xs font-medium">Cuenta</span>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="flex flex-col items-center gap-1 px-3 py-2 rounded-xl transition-colors duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-xs font-medium">Iniciar sesión</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Footer moderno -->
    <footer class="bg-white border-t border-gray-100 mt-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Logo y descripción -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="text-xl font-semibold text-gray-900">LocalConnect</span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed max-w-md">
                        Conectamos negocios locales con su comunidad. Encuentra y descubre los mejores servicios cerca
                        de ti.
                    </p>
                </div>

                <!-- Enlaces rápidos -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Enlaces</h3>
                    <div class="space-y-3">
                        <a href="#"
                            class="block text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">Acerca
                            de</a>
                        <a href="#"
                            class="block text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">Contacto</a>
                        <a href="#"
                            class="block text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">Términos</a>
                        <a href="#"
                            class="block text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">Privacidad</a>
                    </div>
                </div>

                <!-- Contacto -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Contacto</h3>
                    <div class="space-y-3">
                        <p class="text-sm text-gray-600">info@localconnect.com</p>
                        <p class="text-sm text-gray-600">+1 (555) 123-4567</p>
                        <div class="flex gap-3 pt-2">
                            <a href="#"
                                class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 transition-colors duration-200">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 transition-colors duration-200">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 transition-colors duration-200">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Línea divisoria y copyright -->
            <div
                class="border-t border-gray-100 mt-8 pt-8 flex flex-col lg:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} LocalConnect. Todos los derechos
                    reservados.</p>
                <div class="flex items-center gap-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700 transition-colors duration-200">Términos de
                        servicio</a>
                    <a href="#" class="hover:text-gray-700 transition-colors duration-200">Política de
                        privacidad</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
