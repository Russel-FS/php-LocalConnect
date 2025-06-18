@extends('layouts.app')

@section('content')
    <div class="pt-16">
        <!-- Hero Section -->
        <div class="py-12 bg-white dark:bg-gray-900 sm:py-16">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-light tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                        <span class="block">Bienvenido a</span>
                        <span class="block text-primary-600">LocalConnect</span>
                    </h1>
                    <p
                        class="max-w-md mx-auto mt-3 text-base text-gray-500 dark:text-gray-400 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Descubre y conecta con los mejores negocios locales en tu área. Todo lo que necesitas, cerca de ti.
                    </p>
                </div>
            </div>
        </div>

        <!-- Featured Categories Section -->
        <div class="py-12 bg-gray-50 dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-light text-gray-900 dark:text-white">
                        Categorías Destacadas
                    </h2>
                    <p class="mt-3 text-gray-500 dark:text-gray-400">
                        Explora nuestras categorías más populares
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 mt-10 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Category Card 1 -->
                    <div
                        class="overflow-hidden transition-shadow bg-white rounded-lg shadow-sm dark:bg-gray-700 hover:shadow-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Restaurantes</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Descubre los mejores lugares para comer
                            </p>
                        </div>
                    </div>

                    <!-- Category Card 2 -->
                    <div
                        class="overflow-hidden transition-shadow bg-white rounded-lg shadow-sm dark:bg-gray-700 hover:shadow-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Servicios</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Encuentra profesionales cerca de ti
                            </p>
                        </div>
                    </div>

                    <!-- Category Card 3 -->
                    <div
                        class="overflow-hidden transition-shadow bg-white rounded-lg shadow-sm dark:bg-gray-700 hover:shadow-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tiendas</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Las mejores tiendas de tu zona
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="py-12 bg-primary-600">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-light text-white">
                        ¿Tienes un negocio?
                    </h2>
                    <p class="mt-3 text-xl text-white opacity-90">
                        Únete a nuestra comunidad y llega a más clientes
                    </p>
                    <div class="mt-8">
                        <a href="#"
                            class="inline-flex items-center px-6 py-3 text-base font-medium transition-colors bg-white border border-transparent rounded-md text-primary-600 hover:bg-gray-50">
                            Registrar mi negocio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
