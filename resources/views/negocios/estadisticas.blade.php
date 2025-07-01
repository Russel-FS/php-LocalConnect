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

            <!-- leshenda del grafico, xd  -->
            <div class="flex justify-center mb-6">
                <div
                    class="bg-white rounded-full px-5 py-2 shadow border border-gray-100 flex gap-4 items-center text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <span class="inline-block w-2.5 h-2.5 rounded-full" style="background:#6366f1"></span>
                        <b>Búsqueda</b>
                        <span class="hidden sm:inline">= aparece en resultados</span>
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="inline-block w-2.5 h-2.5 rounded-full" style="background:#3b82f6"></span>
                        <b>Detalle</b>
                        <span class="hidden sm:inline">= clics en ver detalles</span>
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="inline-block w-2.5 h-2.5 rounded-full" style="background:#ef4444"></span>
                        <b>Me gusta</b>
                        <span class="hidden sm:inline">= likes</span>
                    </span>
                </div>
            </div>

            <!-- Gráfico de evolución -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-12">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Evolución de vistas y me gusta</h3>
                <canvas id="graficoEvolucion" height="80"></canvas>
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
                            class="text-2xl font-bold text-blue-600">{{ number_format($estadisticas['vistas_busqueda']) }}</span>
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
                            class="text-2xl font-bold text-green-600">{{ number_format($estadisticas['vistas_detalle']) }}</span>
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
                        <span class="text-2xl font-bold text-red-600">{{ number_format($estadisticas['me_gusta']) }}</span>
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
                            class="text-2xl font-bold text-yellow-600">{{ number_format($estadisticas['favoritos']) }}</span>
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
                            $estadisticas['vistas_busqueda'] > 0
                                ? round(($estadisticas['vistas_detalle'] / $estadisticas['vistas_busqueda']) * 100, 1)
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
                        {{ $estadisticas['vistas_detalle'] }} de {{ $estadisticas['vistas_busqueda'] }} vistas se
                        convirtieron
                        en clics
                    </p>
                </div>

                <!-- ultima actualización -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Información de actualización</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Última actualización:</span>
                            <span class="font-medium text-gray-900">No disponible</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total de interacciones:</span>
                            <span class="font-medium text-gray-900">
                                {{ number_format($estadisticas['vistas_busqueda'] + $estadisticas['vistas_detalle'] + $estadisticas['me_gusta'] + $estadisticas['favoritos']) }}
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

@section('scripts')
    <script>
        // datos
        const labels = @json($labels);
        const vistas = @json($vistas);
        const meGusta = @json($meGusta);
        const vistasBusqueda = @json($vistasBusqueda);

        const ctx = document.getElementById('graficoEvolucion').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Vistas en búsqueda',
                        data: vistasBusqueda,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,0.08)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointBackgroundColor: '#6366f1',
                    },
                    {
                        label: 'Vistas de detalle',
                        data: vistas,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.08)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointBackgroundColor: '#3b82f6',

                    },
                    {
                        label: 'Me gusta',
                        data: meGusta,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239,68,68,0.08)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointBackgroundColor: '#ef4444',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#334155',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 13
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 13
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
