<?php
$title = 'Iniciar Sesión | LocalConnect';
$styles = [
    '/src/presentation/css/auth.css'
];
$scripts = [
    '/src/presentation/js/auth.js'
];

ob_start();
?>

<div class="max-w-md w-full space-y-6 glass-effect p-8 rounded-3xl shadow-2xl border border-gray-100 mx-auto">
    <!-- Logo y Título -->
    <div class="text-center">
        <div class="flex justify-center mb-4">
            <svg class="w-16 h-16 text-gray-800" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor" />
                <path d="M12 6C8.69 6 6 8.69 6 12C6 15.31 8.69 18 12 18C15.31 18 18 15.31 18 12C18 8.69 15.31 6 12 6ZM12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16Z" fill="currentColor" />
            </svg>
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">Bienvenido</h2>
        <p class="mt-1 text-sm text-gray-600">Ingresa tus credenciales para continuar</p>
    </div>

    <!-- Formulario -->
    <form class="mt-8 space-y-5" action="/auth/login" method="POST">
        <div class="space-y-4">
            <!-- Campo de Email -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                    <svg class="h-5 w-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                </div>
                <input id="email" name="email" type="email" required
                    class="input-glass block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-gray-300 transition-all duration-200"
                    placeholder="tu@email.com">
            </div>

            <!-- Campo de Contraseña -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                    <svg class="h-5 w-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                </div>
                <input id="password" name="password" type="password" required
                    class="input-glass block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-gray-300 transition-all duration-200"
                    placeholder="••••••••">
            </div>
        </div>

        <!-- Opciones adicionales -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox"
                    class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                <label for="remember-me" class="ml-2 block text-sm text-gray-600">Recordarme</label>
            </div>
            <a href="/auth/forgot-password" class="text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors duration-200">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        <!-- Botón de Inicio de Sesión -->
        <button type="submit"
            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl text-sm font-medium text-white bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-gray-950 focus:outline-none focus:border-gray-300 transition-all duration-200 shadow-lg">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                <polyline points="10 17 15 12 10 7" />
                <line x1="15" y1="12" x2="3" y2="12" />
            </svg>
            Iniciar Sesión
        </button>
    </form>

    <!-- Enlace de Registro -->
    <div class="text-center">
        <p class="text-sm text-gray-600">
            ¿No tienes una cuenta?
            <a href="/auth/register" class="font-medium text-gray-800 hover:text-gray-900 transition-colors duration-200">
                Regístrate aquí
            </a>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/main.php';
?>