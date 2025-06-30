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

<body class="font-sans antialiased bg-slate-50 text-slate-900" style="font-family: 'Inter', sans-serif;">
    <!-- Navbar Rediseñado -->
    <nav class="bg-white/90 backdrop-blur-lg w-full fixed z-50 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16 lg:h-20 items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-slate-600 to-slate-700 rounded-xl flex items-center justify-center shadow-lg shadow-slate-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span
                        class="text-xl lg:text-2xl font-semibold tracking-tight text-slate-900 group-hover:text-slate-700 transition-colors duration-200">
                        LocalConnect
                    </span>
                </a>
                <!-- Enlaces principales -->
                <div class="hidden lg:flex gap-2 mx-auto">
                    <a href="/"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 font-medium text-sm hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <x-icons.outline.home class="w-4 h-4" />
                        Inicio
                    </a>
                    <a href="{{ route('negocios.buscar') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 font-medium text-sm hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <x-icons.outline.search class="w-4 h-4" />
                        Buscar
                    </a>
                    <a href="#por-que"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 font-medium text-sm hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <x-icons.content.check-circle class="w-4 h-4" />
                        ¿Por qué?
                    </a>
                    <a href="#contacto"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 font-medium text-sm hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <x-icons.outline.phone class="w-4 h-4" />
                        Contacto
                    </a>
                </div>
                <!-- Acciones y usuario -->
                <div class="flex items-center gap-2 lg:gap-4">
                    <a href="{{ route('negocios.registro') }}"
                        class="hidden lg:inline-flex items-center gap-2 px-6 py-2 rounded-full bg-primary-600 text-white font-semibold text-sm shadow-md hover:bg-primary-700 transition-all duration-200">
                        <x-icons.actions.plus class="w-4 h-4" />
                        Registrar mi negocio
                    </a>
                    @if (Auth::check())
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-700 font-semibold text-sm hover:from-slate-200 hover:to-slate-300 transition-all duration-200 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-3 w-56 bg-white/95 backdrop-blur-md rounded-2xl py-4 shadow-xl border border-slate-200 z-50"
                                x-cloak x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2">
                                <div class="px-4 pb-2">
                                    <span
                                        class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">Mi
                                        cuenta</span>
                                    <div class="px-2 py-3 rounded-xl bg-slate-50/80">
                                        <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="py-2 space-y-1 px-1">
                                    @if (Auth::user()->isAdmin())
                                        <a href="/admin"
                                            class="flex items-center gap-3 px-4 py-2 rounded-xl text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200">
                                            <x-icons.outline.home class="w-4 h-4" />
                                            <span>Panel Admin</span>
                                        </a>
                                        <a href="/admin/negocios"
                                            class="flex items-center gap-3 px-4 py-2 rounded-xl text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200">
                                            <x-icons.outline.folder class="w-4 h-4" />
                                            <span>Negocios</span>
                                        </a>
                                        <a href="/admin/solicitudes"
                                            class="flex items-center gap-3 px-4 py-2 rounded-xl text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200">
                                            <x-icons.outline.folder class="w-4 h-4" />
                                            <span>Solicitudes</span>
                                        </a>
                                    @endif
                                    <a href="/perfil"
                                        class="flex items-center gap-3 px-4 py-2 rounded-xl text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200">
                                        <x-icons.outline.user class="w-4 h-4" />
                                        Perfil
                                    </a>
                                    <a href="{{ route('negocios.mis-negocios') }}"
                                        class="flex items-center gap-3 px-4 py-2 rounded-xl text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200">
                                        <x-icons.outline.folder class="w-4 h-4" />
                                        Mis Negocios
                                    </a>
                                </div>
                                <div class="mt-2 pt-2 border-t border-slate-100 px-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-sm text-slate-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                            <x-icons.actions.logout class="w-4 h-4" />
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- usuario no authenticado-->
                        <div class="flex items-center gap-2 lg:gap-3">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 rounded-xl text-slate-600 font-medium text-sm hover:bg-slate-100 hover:text-slate-900 transition-all duration-200">
                                Iniciar sesión
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-xl bg-slate-900 text-white font-medium text-sm hover:bg-slate-800 transition-all duration-200 shadow-sm">
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

    <!-- navagecion mobil inferior flotanteeeeee -->
    <div class="lg:hidden fixed bottom-4 left-4 right-4 z-40">
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-xl border border-slate-200/60">
            <div class="flex items-center justify-around px-2 py-3">
                <!-- Inicio -->
                <a href="/"
                    class="flex flex-col items-center gap-1 px-3 py-2 rounded-2xl transition-all duration-300 {{ request()->is('/') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:text-primary-700 hover:bg-primary-50' }}">
                    @if (request()->is('/'))
                        <x-icons.solid.home class="w-5 h-5 text-primary-700" />
                    @else
                        <x-icons.outline.home class="w-5 h-5" />
                    @endif
                    <span class="text-xs font-medium">Inicio</span>
                </a>

                <!-- Buscar -->
                <a href="{{ route('negocios.buscar') }}"
                    class="flex flex-col items-center gap-1 px-3 py-2 rounded-2xl transition-all duration-300 {{ request()->routeIs('negocios.buscar') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:text-primary-700 hover:bg-primary-50' }}">
                    @if (request()->routeIs('negocios.buscar'))
                        <x-icons.solid.search class="w-5 h-5 text-primary-700" />
                    @else
                        <x-icons.outline.search class="w-5 h-5" />
                    @endif
                    <span class="text-xs font-medium">Buscar</span>
                </a>

                @if (Auth::check())
                    <!-- Mis Negocios -->
                    <a href="{{ route('negocios.mis-negocios') }}"
                        class="flex flex-col items-center gap-1 px-3 py-2 rounded-2xl transition-all duration-300 {{ request()->routeIs('negocios.mis-negocios') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:text-primary-700 hover:bg-primary-50' }}">
                        @if (request()->routeIs('negocios.mis-negocios'))
                            <x-icons.solid.folder class="w-5 h-5 text-primary-700" />
                        @else
                            <x-icons.outline.folder class="w-5 h-5" />
                        @endif
                        <span class="text-xs font-medium">Mis Negocios</span>
                    </a>
                @endif

                <!-- Cuenta -->
                @if (Auth::check())
                    <a href="/perfil"
                        class="flex flex-col items-center gap-1 px-3 py-2 rounded-2xl transition-all duration-300 {{ request()->is('perfil*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:text-primary-700 hover:bg-primary-50' }}">
                        @if (request()->is('perfil*'))
                            <x-icons.solid.user class="w-5 h-5 text-primary-700" />
                        @else
                            <x-icons.outline.user class="w-5 h-5" />
                        @endif
                        <span class="text-xs font-medium">Cuenta</span>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="flex flex-col items-center gap-1 px-3 py-2 rounded-2xl transition-all duration-300 text-slate-600 hover:text-primary-700 hover:bg-primary-50">
                        <x-icons.outline.user class="w-5 h-5" />
                        <span class="text-xs font-medium">Iniciar sesión</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer  -->
    <footer class="bg-white border-t border-slate-200 mt-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Logo y descripción -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-slate-600 to-slate-700 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="text-xl font-semibold text-slate-900">LocalConnect</span>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed max-w-md">
                        Conectamos negocios locales con su comunidad. Encuentra y descubre los mejores servicios cerca
                        de ti.
                    </p>
                </div>

                <!-- Enlaces rápidos -->
                <div>
                    <h3 class="font-semibold text-slate-900 mb-4">Enlaces</h3>
                    <div class="space-y-3">
                        <a href="#"
                            class="block text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">Acerca
                            de</a>
                        <a href="#"
                            class="block text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">Contacto</a>
                        <a href="#"
                            class="block text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">Términos</a>
                        <a href="#"
                            class="block text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">Privacidad</a>
                    </div>
                </div>

                <!-- Contacto -->
                <div>
                    <h3 class="font-semibold text-slate-900 mb-4">Contacto</h3>
                    <div class="space-y-3">
                        <p class="text-sm text-slate-600">flores@localconnect.com</p>
                        <p class="text-sm text-slate-600">+1 (555) 123-4567</p>
                        <div class="flex gap-3 pt-2">
                            <a href="#"
                                class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-200 transition-colors duration-200">
                                <svg class="w-4 h-4 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-200 transition-colors duration-200">
                                <svg class="w-4 h-4 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-200 transition-colors duration-200">
                                <svg class="w-4 h-4 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Línea divisoria yy copyright -->
            <div
                class="border-t border-slate-100 mt-8 pt-8 flex flex-col lg:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500">&copy; {{ date('Y') }} LocalConnect. Todos los derechos
                    reservados.</p>
                <div class="flex items-center gap-6 text-sm text-slate-500">
                    <a href="#" class="hover:text-slate-700 transition-colors duration-200">Términos de
                        servicio</a>
                    <a href="#" class="hover:text-slate-700 transition-colors duration-200">Política de
                        privacidad</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
