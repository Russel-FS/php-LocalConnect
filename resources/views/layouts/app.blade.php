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
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Navbar -->
    <nav class="fixed z-50 w-full bg-white/80 backdrop-blur border-b border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex items-center space-x-2 select-none">
                    <span class="text-2xl font-bold tracking-tight text-primary-600">LocalConnect</span>
                </a>
                <div class="flex items-center space-x-2">
                    <a href="#" class="btn-apple">Iniciar sesisssón</a>
                    <a href="#" class="btn-apple-solid">Registrarse</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- contenido principal -->
    <main class="pt-20 min-h-[80vh]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-24 text-gray-400 bg-white/80 border-t border-gray-100">
        <div class="mx-auto max-w-7xl px-4 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
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