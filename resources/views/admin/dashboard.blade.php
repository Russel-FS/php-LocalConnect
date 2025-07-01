@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-primary-50 to-white min-h-dvh py-15">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">


            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-12 text-center tracking-tight">Panel de
                Administración</h1>

            <!-- datos principales -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center mb-2">
                        <x-icons.outline.folder class="w-6 h-6 text-primary-600" />
                    </div>
                    <span class="text-2xl font-bold text-primary-700">{{ $totalNegocios }}</span>
                    <span class="text-primary-400 mt-1 text-xs font-medium">Negocios</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center mb-2">
                        <x-icons.outline.check-circle class="w-6 h-6 text-yellow-500" />
                    </div>
                    <span class="text-2xl font-bold text-yellow-600">{{ $negociosPendientes }}</span>
                    <span class="text-yellow-500 mt-1 text-xs font-medium">Pendientes</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center mb-2">
                        <x-icons.outline.user class="w-6 h-6 text-secondary-600" />
                    </div>
                    <span class="text-2xl font-bold text-secondary-700">{{ $totalUsuarios }}</span>
                    <span class="text-secondary-500 mt-1 text-xs font-medium">Usuarios</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center mb-2">
                        <x-icons.outline.category class="w-6 h-6 text-primary-400" />
                    </div>
                    <span class="text-2xl font-bold text-primary-400">{{ $totalCategorias }}</span>
                    <span class="text-primary-400 mt-1 text-xs font-medium">Categorías</span>
                </div>
            </div>

            <!-- Reportes -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-12">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 text-center">Reportes</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Reporte Dashboard -->
                    <div class="space-y-4">
                        <h4 class="text-base font-semibold text-gray-800 mb-3">Reporte del Dashboard</h4>
                        <a href="{{ route('admin.reportes.dashboard-pdf') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                    clip-rule="evenodd" />
                            </svg>
                            Descargar PDF
                        </a>
                        <p class="text-xs text-gray-500">Incluye métricas principales, top categorías y negocios populares
                        </p>
                    </div>

                    <!-- Reporte Negocios -->
                    <div class="space-y-4">
                        <h4 class="text-base font-semibold text-gray-800 mb-3">Reporte de Negocios</h4>
                        <a href="{{ route('admin.reportes.negocios-pdf') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                    clip-rule="evenodd" />
                            </svg>
                            Descargar PDF
                        </a>
                        <p class="text-xs text-gray-500">Lista completa de negocios con estadísticas detalladas</p>
                    </div>
                </div>
            </div>

            <!-- metricas de interacciones -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-2">
                        <x-icons.outline.eye class="w-5 h-5 text-blue-600" />
                    </div>
                    <span class="text-xl font-bold text-blue-600">{{ number_format($totalVistas) }}</span>
                    <span class="text-blue-500 mt-1 text-xs font-medium">Vistas</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center mb-2">
                        <x-icons.outline.heart class="w-5 h-5 text-red-600" />
                    </div>
                    <span class="text-xl font-bold text-red-600">{{ number_format($totalMeGusta) }}</span>
                    <span class="text-red-500 mt-1 text-xs font-medium">Me gusta</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-yellow-600">{{ number_format($totalFavoritos) }}</span>
                    <span class="text-yellow-500 mt-1 text-xs font-medium">Favoritos</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mb-2">
                        <x-icons.outline.star class="w-5 h-5 text-green-600" />
                    </div>
                    <span class="text-xl font-bold text-green-600">{{ number_format($totalValoraciones) }}</span>
                    <span class="text-green-500 mt-1 text-xs font-medium">Valoraciones</span>
                </div>
            </div>

            <!-- graficso -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <!--grafico de cambios -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Evolución (Últimos 30 días)</h3>
                    <div class="w-full" style="height: 300px;">
                        <canvas id="graficoEvolucion" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- estados de negocio -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Estados de Negocios</h3>
                    <div class="w-full" style="height: 300px;">
                        <canvas id="graficoEstados" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>

            <!-- populares -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <!-- Top categorías -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Categorías</h3>
                    <div class="space-y-3">
                        @foreach ($topCategorias as $index => $categoria)
                            <div
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center group-hover:from-primary-200 group-hover:to-primary-300 transition-all duration-300">
                                            <x-icons.outline.category class="w-5 h-5 text-primary-600" />
                                        </div>
                                        @if ($index < 3)
                                            <div
                                                class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-bold text-white">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span
                                            class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors">{{ $categoria->nombre_categoria }}</span>
                                        <div class="text-xs text-gray-500 mt-0.5">{{ $categoria->negocios_count }}
                                            negocios
                                            registrados</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-primary-400 rounded-full"></div>
                                    <span
                                        class="text-sm font-bold text-primary-600">{{ $categoria->negocios_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- negocios  populares -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Negocios Más Populares</h3>
                    <div class="space-y-3">
                        @foreach ($negociosPopulares as $index => $negocio)
                            <div
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-white rounded-xl border border-blue-100 hover:border-blue-200 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300">
                                            <x-icons.outline.business class="w-5 h-5 text-blue-600" />
                                        </div>
                                        @if ($index < 3)
                                            <div
                                                class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-bold text-white">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span
                                            class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $negocio->nombre_negocio }}</span>
                                        <div class="flex items-center gap-3 mt-1">
                                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                                <x-icons.outline.eye class="w-3 h-3" />
                                                <span>{{ $negocio->vistas_count }}</span>
                                            </div>
                                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                                <x-icons.outline.heart class="w-3 h-3" />
                                                <span>{{ $negocio->me_gusta_count }}</span>
                                            </div>
                                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                                                </svg>
                                                <span>{{ $negocio->favoritos_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                    <span class="text-sm font-bold text-blue-600">{{ $negocio->vistas_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Accones rapidasss -->
            <div class="bg-white rounded-xl shadow-sm p-8 mb-10">
                <h3 class="text-xl font-semibold text-gray-900 mb-8 text-center">Acciones Rápidas</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <a href="/admin/negocios"
                        class="group flex flex-col items-center p-6 rounded-2xl bg-white border-2 border-primary-400 hover:shadow-md transition-all duration-300">
                        <div
                            class="w-14 h-14 rounded-2xl bg-primary-50 shadow-sm flex items-center justify-center mb-4 group-hover:shadow-md transition-all duration-300">
                            <x-icons.outline.folder class="w-7 h-7 text-primary-600" />
                        </div>
                        <span class="text-base font-semibold text-gray-900">Negocios</span>
                        <span class="text-sm text-gray-500 mt-1">Gestionar todos</span>
                    </a>

                    <a href="/admin/solicitudes"
                        class="group flex flex-col items-center p-6 rounded-2xl bg-white border-2 border-yellow-400 hover:shadow-md transition-all duration-300">
                        <div
                            class="w-14 h-14 rounded-2xl bg-yellow-50 shadow-sm flex items-center justify-center mb-4 group-hover:shadow-md transition-all duration-300">
                            <x-icons.outline.check-circle class="w-7 h-7 text-yellow-600" />
                        </div>
                        <span class="text-base font-semibold text-gray-900">Solicitudes</span>
                        <span class="text-sm text-gray-500 mt-1">Revisar pendientes</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center p-6 rounded-2xl bg-white border-2 border-blue-400 hover:shadow-md transition-all duration-300">
                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-50 shadow-sm flex items-center justify-center mb-4 group-hover:shadow-md transition-all duration-300">
                            <x-icons.outline.category class="w-7 h-7 text-blue-600" />
                        </div>
                        <span class="text-base font-semibold text-gray-900">Categorías</span>
                        <span class="text-sm text-gray-500 mt-1">Administrar</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center p-6 rounded-2xl bg-white border-2 border-green-400 hover:shadow-md transition-all duration-300">
                        <div
                            class="w-14 h-14 rounded-2xl bg-green-50 shadow-sm flex items-center justify-center mb-4 group-hover:shadow-md transition-all duration-300">
                            <x-icons.outline.user class="w-7 h-7 text-green-600" />
                        </div>
                        <span class="text-base font-semibold text-gray-900">Usuarios</span>
                        <span class="text-sm text-gray-500 mt-1">Gestionar</span>
                    </a>
                </div>
            </div>

            <!-- ultimas solicitudesssssssss-->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-slate-900">Últimas Solicitudes de Negocios</h2>
                <a href="/admin/solicitudes" class="text-primary-600 hover:underline font-medium text-sm">Ver todas</a>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-0 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-400 uppercase text-xs tracking-wider bg-white">
                            <th class="py-4 px-4 font-normal">Nombre</th>
                            <th class="py-4 px-4 font-normal">Usuario</th>
                            <th class="py-4 px-4 font-normal">Ubicación</th>
                            <th class="py-4 px-4 font-normal">Fecha</th>
                            <th class="py-4 px-4 font-normal">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasSolicitudes as $negocio)
                            <tr class="border-b last:border-0 hover:bg-primary-50/40 transition-all group">
                                <td
                                    class="py-4 px-4 font-semibold text-slate-900 whitespace-nowrap group-hover:text-primary-700 transition-colors">
                                    {{ $negocio->nombre_negocio }}</td>
                                <td class="py-4 px-4 text-slate-700 whitespace-nowrap">
                                    {{ $negocio->usuario->name ?? '-' }}
                                </td>
                                <td class="py-4 px-4 text-slate-500 whitespace-nowrap">
                                    @if ($negocio->ubicacion)
                                        {{ $negocio->ubicacion->direccion ?? '' }}
                                        @if ($negocio->ubicacion->ciudad)
                                            , {{ $negocio->ubicacion->ciudad }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-slate-400 whitespace-nowrap">
                                    {{ $negocio->created_at ? $negocio->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <a href="{{ route('admin.negocios.show', $negocio) }}"
                                        class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-medium transition-colors text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                                        </svg>
                                        Ver detalles
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400">No hay solicitudes pendientes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // grafico de evolucion
        const ctxEvolucion = document.getElementById('graficoEvolucion').getContext('2d');
        new Chart(ctxEvolucion, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Negocios',
                    data: @json($negociosArray),
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                }, {
                    label: 'Usuarios',
                    data: @json($usuariosArray),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                }, {
                    label: 'Vistas',
                    data: @json($vistasArray),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                }, {
                    label: 'Me gusta',
                    data: @json($meGustaArray),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239,68,68,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Gráfico de estadosssssssss
        const ctxEstados = document.getElementById('graficoEstados').getContext('2d');
        new Chart(ctxEstados, {
            type: 'doughnut',
            data: {
                labels: ['Aprobados', 'Pendientes'],
                datasets: [{
                    data: [@json($estadosNegocios['Aprobados']), @json($estadosNegocios['Pendientes'])],
                    backgroundColor: ['#10b981', '#f59e0b'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });
    </script>
@endsection
