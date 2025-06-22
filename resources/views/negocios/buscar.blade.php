@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-8 sm:py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header con buscador -->
        <div class="mb-8 sm:mb-12">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-700 tracking-tight mb-2">
                        Resultados de búsqueda
                    </h1>
                    @if(request('q'))
                    <p class="text-lg sm:text-xl text-primary-500">
                        Buscando: <span class="font-semibold text-secondary-600">"{{ request('q') }}"</span>
                    </p>
                    @endif
                </div>
                <span class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-sm sm:text-base font-semibold bg-primary-100 text-primary-700 shadow-sm">
                    {{ $negocios->total() }} {{ $negocios->total() == 1 ? 'negocio' : 'negocios' }}
                </span>
            </div>

            <!-- Buscador y Filtros en la parte superior -->
            <form action="{{ route('negocios.buscar') }}" method="GET" id="filtros-form" class="space-y-4">
                <!-- Fila 1: Buscador principal -->
                <div class="relative max-w-2xl">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <x-icons.navigation.search class="h-5 w-5 text-primary-400" />
                    </div>
                    <input
                        type="text"
                        name="q"
                        placeholder="Buscar negocios..."
                        class="w-full pl-12 pr-4 py-3 text-base bg-white/80 backdrop-blur-sm border-2 border-primary-200 rounded-xl shadow-sm focus:border-secondary-400 focus:ring-2 focus:ring-secondary-100 transition-all duration-300 placeholder-primary-400"
                        value="{{ request('q') }}">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-secondary-600 hover:bg-secondary-700 text-white px-4 py-1.5 rounded-lg font-semibold transition-all duration-300">
                        Buscar
                    </button>
                </div>

                <!-- Fila 2: Filtros dropdown -->
                <div class="flex flex-wrap gap-4">
                    <!-- Dropdown Categorías -->
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm border-2 border-primary-200 rounded-xl shadow-sm hover:border-primary-400 transition-all duration-300 text-primary-700 font-medium">
                            <x-icons.content.category class="w-4 h-4" />
                            Categorías
                            @if(request('categorias'))
                            <span class="w-2 h-2 bg-secondary-500 rounded-full"></span>
                            @endif
                            <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform group-hover:rotate-180" />
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 bg-white/95 backdrop-blur-sm border border-primary-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="p-4 max-h-60 overflow-y-auto">
                                <div class="space-y-2">
                                    @foreach($categorias as $categoria)
                                    <label class="flex items-center p-2 hover:bg-primary-50 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}"
                                            class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                            {{ in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-primary-700">{{ $categoria->nombre_categoria }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Características -->
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm border-2 border-primary-200 rounded-xl shadow-sm hover:border-primary-400 transition-all duration-300 text-primary-700 font-medium">
                            <x-icons.content.check-circle class="w-4 h-4" />
                            Características
                            @if(request('caracteristicas'))
                            <span class="w-2 h-2 bg-secondary-500 rounded-full"></span>
                            @endif
                            <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform group-hover:rotate-180" />
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 bg-white/95 backdrop-blur-sm border border-primary-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="p-4 max-h-60 overflow-y-auto">
                                <div class="space-y-2">
                                    @foreach($caracteristicas as $caracteristica)
                                    <label class="flex items-center p-2 hover:bg-secondary-50 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <input type="checkbox" name="caracteristicas[]" value="{{ $caracteristica->id_caracteristica }}"
                                            class="rounded border-secondary-300 text-secondary-600 focus:ring-secondary-500"
                                            {{ in_array($caracteristica->id_caracteristica, request('caracteristicas', [])) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-secondary-700">{{ $caracteristica->nombre }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Servicios Predefinidos -->
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm border-2 border-primary-200 rounded-xl shadow-sm hover:border-primary-400 transition-all duration-300 text-primary-700 font-medium">
                            <x-icons.content.lightning class="w-4 h-4" />
                            Servicios
                            @if(request('servicios'))
                            <span class="w-2 h-2 bg-secondary-500 rounded-full"></span>
                            @endif
                            <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform group-hover:rotate-180" />
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 bg-white/95 backdrop-blur-sm border border-primary-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="p-4 max-h-60 overflow-y-auto">
                                <div class="space-y-2">
                                    @foreach($serviciosPredefinidos as $servicio)
                                    <label class="flex items-center p-2 hover:bg-green-50 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <input type="checkbox" name="servicios[]" value="{{ $servicio->id_servicio_predefinido }}"
                                            class="rounded border-green-300 text-green-600 focus:ring-green-500"
                                            {{ in_array($servicio->id_servicio_predefinido, request('servicios', [])) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-green-700">{{ $servicio->nombre_servicio }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex gap-2">
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-secondary-600 hover:bg-secondary-700 text-white rounded-xl font-semibold transition-all duration-300">
                            <x-icons.actions.filter class="w-4 h-4" />
                            Aplicar
                        </button>
                        <a href="{{ route('negocios.buscar') }}" class="flex items-center gap-2 px-4 py-2 bg-primary-100 hover:bg-primary-200 text-primary-700 rounded-xl font-semibold transition-all duration-300">
                            <x-icons.actions.refresh class="w-4 h-4" />
                            Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        <div class="w-full">
            @if($negocios->isEmpty())
            <div class="text-center py-16 sm:py-20 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-primary-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl sm:text-3xl font-bold text-primary-700 mb-4">No se encontraron resultados</h3>
                <p class="text-lg text-primary-500 mb-8">Intenta con otros términos de búsqueda o ajusta los filtros.</p>
                <a href="{{ route('negocios.buscar') }}" class="inline-flex items-center gap-3 px-6 py-3 rounded-full font-semibold bg-primary-600 text-white shadow-lg hover:bg-primary-700 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Nueva búsqueda</span>
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($negocios as $negocio)
                <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}" class="group block bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-xl hover:border-primary-200 transition-all duration-500 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-200" tabindex="0">
                    <div class="relative">
                        @if($negocio->imagen_portada)
                        <div class="h-40 sm:h-44 lg:h-48 bg-primary-100 rounded-t-3xl overflow-hidden">
                            <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                                alt="{{ $negocio->nombre_negocio }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        </div>
                        @else
                        <div class="h-40 sm:h-44 lg:h-48 bg-gradient-to-br from-primary-100 to-primary-200 rounded-t-3xl flex items-center justify-center">
                            <svg class="h-10 w-10 sm:h-12 sm:w-12 text-primary-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $negocio->verificado ? 'bg-secondary-500/10 text-secondary-600 backdrop-blur-sm border border-secondary-200' : 'bg-yellow-500/10 text-yellow-600 backdrop-blur-sm border border-yellow-200' }}" @if(!$negocio->verificado) title="Pendiente de verificación. Completa los datos y espera la revisión del equipo." @endif>
                                <span class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-secondary-500' : 'bg-yellow-500' }}"></span>
                                <span class="hidden sm:inline">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                                <span class="sm:hidden">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-primary-800 tracking-tight mb-2 sm:mb-3 truncate" title="{{ $negocio->nombre_negocio }}">{{ $negocio->nombre_negocio }}</h3>
                        <p class="text-primary-500 text-sm sm:text-base mb-3 sm:mb-4 h-10 sm:h-12 line-clamp-2 leading-relaxed">{{ Str::limit($negocio->descripcion, 80) }}</p>

                        @if($negocio->ubicacion)
                        <div class="flex items-center text-sm sm:text-base text-primary-500 mb-3 sm:mb-4">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-2 flex-shrink-0">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="truncate font-medium text-xs sm:text-sm">{{ $negocio->ubicacion->direccion }}</span>
                        </div>
                        @endif

                        @if($negocio->categorias->isNotEmpty())
                        <div class="mb-3 sm:mb-4">
                            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                @foreach($negocio->categorias->take(2) as $categoria)
                                <span class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                    {{ $categoria->nombre_categoria }}
                                </span>
                                @endforeach
                                @if($negocio->categorias->count() > 2)
                                <span class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                    +{{ $negocio->categorias->count() - 2 }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($negocio->serviciosPredefinidos->isNotEmpty() || $negocio->serviciosPersonalizados->isNotEmpty())
                        <div class="mb-3 sm:mb-4">
                            @php
                            $serviciosCombinados = $negocio->serviciosPredefinidos->merge($negocio->serviciosPersonalizados);
                            $totalServicios = $serviciosCombinados->count();
                            @endphp
                            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                @foreach($serviciosCombinados->take(2) as $servicio)
                                <span class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                    {{ $servicio->nombre_servicio ?? $servicio->nombre }}
                                </span>
                                @endforeach
                                @if($totalServicios > 2)
                                <span class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                    +{{ $totalServicios - 2 }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="p-5 sm:p-6 pt-0 mt-2 border-t border-primary-100/50 flex justify-between items-center">
                        <span class="text-sm sm:text-base font-semibold text-secondary-600">
                            Ver detalles
                        </span>
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-secondary-100 rounded-xl flex items-center justify-center group-hover:bg-secondary-200 transition-colors duration-300">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-secondary-600 transition-transform group-hover:translate-x-1 group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Paginación -->
            @if($negocios->hasPages())
            <div class="mt-8 sm:mt-12">
                {{ $negocios->appends(request()->query())->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>
</div>

<script>
    // Auto-submit form cuando cambien los checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('#filtros-form input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.getElementById('filtros-form').submit();
            });
        });
    });
</script>
@endsection