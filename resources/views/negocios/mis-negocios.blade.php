@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-8 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 sm:gap-6 mb-8 sm:mb-12 lg:mb-16">
                <div class="flex items-center gap-4 sm:gap-6">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-primary-700 tracking-tight">Mis
                        Negocios</h1>
                    <span
                        class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-sm sm:text-base font-semibold bg-primary-100 text-primary-700 shadow-sm">
                        {{ $negocios->count() }}
                    </span>
                </div>
                <a href="{{ route('negocios.registro') }}"
                    class="hidden md:inline-flex items-center gap-3 px-6 py-3 rounded-full font-semibold border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 hover:border-primary-400 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5"
                            fill="white" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                    </svg>
                    <span>Nuevo Negocio</span>
                </a>
            </div>

            <!-- bootton flotante móvil -->
            <a href="{{ route('negocios.registro') }}"
                class="md:hidden fixed bottom-6 right-6 z-40 flex items-center justify-center w-14 h-14 rounded-full bg-white border border-primary-200 shadow-lg hover:bg-primary-50 hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <svg class="w-7 h-7 text-primary-700 group-hover:scale-110 transition-transform duration-300" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="white" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                </svg>
            </a>

            @if (session('success'))
                <div
                    class="mb-6 sm:mb-8 p-4 sm:p-6 bg-secondary-100 border border-secondary-200 text-secondary-800 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 sm:mb-8 p-4 sm:p-6 bg-red-100 border border-red-200 text-red-700 rounded-2xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($negocios->isEmpty())
                <div
                    class="text-center py-16 sm:py-20 lg:py-24 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm">
                    <div
                        class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 bg-primary-100 rounded-3xl flex items-center justify-center mx-auto mb-6 sm:mb-8">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 lg:w-16 lg:h-16 text-primary-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-primary-700 mb-4 sm:mb-6">Aún no tienes
                        negocios</h3>
                    <p
                        class="text-base sm:text-lg lg:text-xl text-primary-500 max-w-2xl mx-auto leading-relaxed mb-8 sm:mb-10">
                        ¿Listo para empezar? Registra tu primer negocio para que el mundo lo conozca.</p>
                    <div class="mt-8 sm:mt-10">
                        <a href="{{ route('negocios.registro') }}"
                            class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold bg-primary-600 text-white shadow-lg hover:bg-primary-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Registrar mi primer negocio</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach ($negocios as $negocio)
                        <div class="group block bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-xl hover:border-primary-200 transition-all duration-500 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-200"
                            tabindex="0">
                            <div class="relative">
                                @if ($negocio->imagen_portada)
                                    <div class="h-40 sm:h-44 lg:h-48 bg-primary-100 rounded-t-3xl overflow-hidden">
                                        <img src="{{ $negocio->imagen_portada }}" alt="{{ $negocio->nombre_negocio }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            loading="lazy">
                                    </div>
                                @else
                                    <div
                                        class="h-40 sm:h-44 lg:h-48 bg-gradient-to-br from-primary-100 to-primary-200 rounded-t-3xl flex items-center justify-center">
                                        <svg class="h-10 w-10 sm:h-12 sm:w-12 text-primary-400 group-hover:scale-110 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $negocio->verificado ? 'bg-secondary-500/10 text-secondary-600 backdrop-blur-sm border border-secondary-200' : 'bg-yellow-500/10 text-yellow-600 backdrop-blur-sm border border-yellow-200' }}"
                                        @if (!$negocio->verificado) title="Pendiente de verificación. Completa los datos y espera la revisión del equipo." @endif>
                                        <span
                                            class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-secondary-500' : 'bg-yellow-500' }}"></span>
                                        <span
                                            class="hidden sm:inline">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                                        <span
                                            class="sm:hidden">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                                    </span>
                                </div>
                            </div>

                            <div class="p-5 sm:p-6">
                                <h3 class="text-lg sm:text-xl font-bold text-primary-800 tracking-tight mb-2 sm:mb-3 truncate"
                                    title="{{ $negocio->nombre_negocio }}">{{ $negocio->nombre_negocio }}</h3>
                                <p
                                    class="text-primary-500 text-sm sm:text-base mb-3 sm:mb-4 h-10 sm:h-12 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($negocio->descripcion, 80) }}</p>

                                @if ($negocio->ubicacion)
                                    <div class="flex items-center text-sm sm:text-base text-primary-500 mb-3 sm:mb-4">
                                        <div
                                            class="w-7 h-7 sm:w-8 sm:h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-2 flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-primary-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <span
                                            class="truncate font-medium text-xs sm:text-sm">{{ $negocio->ubicacion->direccion }}</span>
                                    </div>
                                @endif

                                @if ($negocio->categorias->isNotEmpty())
                                    <div class="mb-3 sm:mb-4">
                                        <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                            @foreach ($negocio->categorias->take(2) as $categoria)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                                    {{ $categoria->nombre_categoria }}
                                                </span>
                                            @endforeach
                                            @if ($negocio->categorias->count() > 2)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                                    +{{ $negocio->categorias->count() - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if ($negocio->serviciosPredefinidos->isNotEmpty() || $negocio->serviciosPersonalizados->isNotEmpty())
                                    <div class="mb-3 sm:mb-4">
                                        @php
                                            $serviciosCombinados = $negocio->serviciosPredefinidos->merge(
                                                $negocio->serviciosPersonalizados,
                                            );
                                            $totalServicios = $serviciosCombinados->count();
                                        @endphp
                                        <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                            @foreach ($serviciosCombinados->take(2) as $servicio)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                    {{ $servicio->nombre_servicio ?? $servicio->nombre }}
                                                </span>
                                            @endforeach
                                            @if ($totalServicios > 2)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                    +{{ $totalServicios - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5 sm:p-6 pt-0 mt-2 border-t border-primary-100/50">
                                <!-- Acciones principales -->
                                <div class="flex justify-between items-center mb-3">
                                    <a href="{{ route('negocios.ver-propio', $negocio->id_negocio) }}"
                                        class="flex items-center gap-2 group">
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 bg-secondary-100 rounded-xl flex items-center justify-center group-hover:bg-secondary-200 transition-colors duration-300">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-secondary-600 transition-transform group-hover:translate-x-1 group-hover:scale-110"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                        <span class="text-sm sm:text-base font-semibold text-secondary-600">Ver
                                            detalles</span>
                                    </a>
                                    <a href="{{ route('negocios.editar', $negocio->id_negocio) }}"
                                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-primary-200 text-primary-700 text-xs font-semibold shadow-sm hover:bg-primary-50 hover:border-primary-400 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536M9 11l6 6M3 17.25V21h3.75l11.06-11.06a2.121 2.121 0 00-3-3L3 17.25z" />
                                        </svg>
                                        Editar
                                    </a>
                                </div>

                                <!-- Botón de estadísticas -->
                                <a href="{{ route('negocios.estadisticas', $negocio->id_negocio) }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-sm font-semibold shadow-sm hover:bg-blue-100 hover:border-blue-300 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Ver estadísticas
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
