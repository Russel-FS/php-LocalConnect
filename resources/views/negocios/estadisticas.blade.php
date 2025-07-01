@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-primary-50 py-8 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="mb-8 sm:mb-12">
                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-bold text-primary-800 tracking-tight mb-4">
                        Estadísticas de {{ $negocio->nombre_negocio }}
                    </h1>
                    <p class="text-lg text-primary-600 max-w-2xl mx-auto">
                        Analiza el rendimiento y la visibilidad de tu negocio en LocalConnect
                    </p>
                </div>
            </div>

            <!-- datos de estatidisticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Vistas de búsqueda -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <x-icons.navigation.search class="w-6 h-6 text-blue-600" />
                        </div>
                        <span
                            class="text-2xl font-bold text-blue-600">{{ number_format($estadisticas->vistas_busqueda) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Vistas en búsqueda</h3>
                    <p class="text-sm text-gray-500">Veces que apareció en resultados</p>
                </div>

                <!-- Vistas de detalle -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <x-icons.outline.eye class="w-6 h-6 text-green-600" />
                        </div>
                        <span
                            class="text-2xl font-bold text-green-600">{{ number_format($estadisticas->vistas_detalle) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Vistas de detalle</h3>
                    <p class="text-sm text-gray-500">Clics en "Ver detalles"</p>
                </div>

                <!-- Me gusta -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <x-icons.solid.star class="w-6 h-6 text-red-600" />
                        </div>
                        <span class="text-2xl font-bold text-red-600">{{ number_format($negocio->meGusta->count()) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Me gusta</h3>
                    <p class="text-sm text-gray-500">Reacciones positivas</p>
                </div>

                <!-- Favoritos -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                            </svg>
                        </div>
                        <span
                            class="text-2xl font-bold text-yellow-600">{{ number_format($negocio->favoritos->count()) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Favoritos</h3>
                    <p class="text-sm text-gray-500">Guardados por usuarios</p>
                </div>
            </div>

            <!-- datos de metricas adicionales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Tasa de conversión</h3>
                    @php
                        // Calcular la tasa de conversión para calcular el porcentaje de vistas de detalle sobre vistas de búsqueda
                        $tasaConversion =
                            $estadisticas->vistas_busqueda > 0
                                ? round(($estadisticas->vistas_detalle / $estadisticas->vistas_busqueda) * 100, 1)
                                : 0;
                    @endphp
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-500"
                                    style="width: {{ min($tasaConversion, 100) }}%"></div>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-primary-600">{{ $tasaConversion }}%</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        {{ $estadisticas->vistas_detalle }} de {{ $estadisticas->vistas_busqueda }} vistas se convirtieron
                        en clics
                    </p>
                </div>

                <!-- ultima actualización -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Información de actualización</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Última actualización:</span>
                            <span class="font-medium text-gray-900">
                                {{ $estadisticas->actualizado_en ? \Carbon\Carbon::parse($estadisticas->actualizado_en)->diffForHumans() : 'Nunca' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total de interacciones:</span>
                            <span class="font-medium text-gray-900">
                                {{ number_format($estadisticas->vistas_busqueda + $estadisticas->vistas_detalle + $negocio->meGusta->count() + $negocio->favoritos->count()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- acciones -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}"
                    class="inline-flex items-center gap-3 px-8 py-3 rounded-full font-semibold bg-primary-600 text-white hover:bg-primary-700 transition-all duration-200">
                    <x-icons.outline.eye class="w-5 h-5" />
                    Ver mi negocio
                </a>
                <a href="{{ route('negocios.mis-negocios') }}"
                    class="inline-flex items-center gap-3 px-8 py-3 rounded-full font-semibold border border-primary-200 bg-white text-primary-700 hover:bg-primary-50 transition-all duration-200">
                    <x-icons.outline.home class="w-5 h-5" />
                    Mis negocios
                </a>
            </div>
        </div>
    </div>
@endsection
