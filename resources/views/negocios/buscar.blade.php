@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-8 sm:py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header con buscador -->
        <div class="mb-8 sm:mb-12">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 sm:gap-6 mb-8 sm:mb-10">
                <div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-700 tracking-tight mb-3">
                        Resultados de búsqueda
                    </h1>
                    @if(request('q'))
                    <p class="text-lg sm:text-xl text-primary-600 font-medium">
                        Buscando: <span class="font-semibold text-secondary-600 bg-secondary-100 px-2 py-1 rounded-lg">"{{ request('q') }}"</span>
                    </p>
                    @endif
                </div>
                <span class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm sm:text-base font-semibold bg-white/80 backdrop-blur-sm border border-primary-200 text-primary-700 shadow-sm">
                    {{ $negocios->total() }} {{ $negocios->total() == 1 ? 'negocio' : 'negocios' }}
                </span>
            </div>

            <!-- Buscador y Filtros en la parte superior -->
            <form action="{{ route('negocios.buscar') }}" method="GET" id="filtros-form" class="space-y-6">
                <!-- Fila 1: Buscador principal -->
                <div class="relative max-w-2xl">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <x-icons.navigation.search class="h-5 w-5 text-primary-400" />
                    </div>
                    <input
                        type="text"
                        name="q"
                        placeholder="Buscar negocios..."
                        class="w-full pl-14 pr-24 py-4 text-base bg-white/80 backdrop-blur-sm border border-primary-200 rounded-xl shadow-sm focus:border-secondary-400 focus:ring-2 focus:ring-secondary-100 transition-all duration-200 placeholder-primary-400 focus:bg-white"
                        value="{{ request('q') }}">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-secondary-600 hover:bg-secondary-700 text-white px-6 py-2.5 rounded-lg font-semibold transition-all duration-200 shadow-sm">
                        Buscar
                    </button>
                </div>

                <!-- Fila 2: Filtros dropdown -->
                <div class="flex flex-wrap gap-4">
                    <!-- Dropdown Categorías -->
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-3 px-5 py-3 bg-white/80 backdrop-blur-sm border border-primary-200 rounded-xl shadow-sm hover:bg-white hover:border-primary-400 transition-all duration-200 text-primary-700 font-medium">
                            <x-icons.content.category class="w-4 h-4" />
                            Categorías
                            @if(request('categorias'))
                            <span class="w-2.5 h-2.5 bg-secondary-500 rounded-full"></span>
                            @endif
                            <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform group-hover:rotate-180" />
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-72 bg-white/95 backdrop-blur-sm border border-primary-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-5 max-h-64 overflow-y-auto">
                                <div class="space-y-2">
                                    @foreach($categorias as $categoria)
                                    <label class="flex items-center p-3 hover:bg-primary-50 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}"
                                            class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                            {{ in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm text-primary-700 font-medium">{{ $categoria->nombre_categoria }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Características -->
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-3 px-5 py-3 bg-white/80 backdrop-blur-sm border border-primary-200 rounded-xl shadow-sm hover:bg-white hover:border-primary-400 transition-all duration-200 text-primary-700 font-medium">
                            <x-icons.content.check-circle class="w-4 h-4" />
                            Características
                            @if(request('caracteristicas'))
                            <span class="w-2.5 h-2.5 bg-secondary-500 rounded-full"></span>
                            @endif
                            <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform group-hover:rotate-180" />
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-72 bg-white/95 backdrop-blur-sm border border-primary-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-5 max-h-64 overflow-y-auto">
                                <div class="space-y-2">
                                    @foreach($caracteristicas as $caracteristica)
                                    <label class="flex items-center p-3 hover:bg-primary-50 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <input type="checkbox" name="caracteristicas[]" value="{{ $caracteristica->id_caracteristica }}"
                                            class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                            {{ in_array($caracteristica->id_caracteristica, request('caracteristicas', [])) ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm text-primary-700 font-medium">{{ $caracteristica->nombre }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Servicios Predefinidos -->
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-3 px-5 py-3 bg-white/80 backdrop-blur-sm border border-primary-200 rounded-xl shadow-sm hover:bg-white hover:border-primary-400 transition-all duration-200 text-primary-700 font-medium">
                            <x-icons.content.lightning class="w-4 h-4" />
                            Servicios
                            @if(request('servicios'))
                            <span class="w-2.5 h-2.5 bg-secondary-500 rounded-full"></span>
                            @endif
                            <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform group-hover:rotate-180" />
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-72 bg-white/95 backdrop-blur-sm border border-primary-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-5 max-h-64 overflow-y-auto">
                                <div class="space-y-2">
                                    @foreach($serviciosPredefinidos as $servicio)
                                    <label class="flex items-center p-3 hover:bg-primary-50 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <input type="checkbox" name="servicios[]" value="{{ $servicio->id_servicio_predefinido }}"
                                            class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                            {{ in_array($servicio->id_servicio_predefinido, request('servicios', [])) ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm text-primary-700 font-medium">{{ $servicio->nombre_servicio }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex gap-3">
                        <button type="submit" class="flex items-center gap-2.5 px-6 py-3 bg-secondary-600 hover:bg-secondary-700 text-white rounded-xl font-semibold transition-all duration-200 shadow-sm">
                            <x-icons.actions.filter class="w-4 h-4" />
                            Aplicar
                        </button>
                        <a href="{{ route('negocios.buscar') }}" class="flex items-center gap-2.5 px-6 py-3 bg-white/80 backdrop-blur-sm border border-primary-200 text-primary-700 rounded-xl font-semibold transition-all duration-200 shadow-sm hover:bg-white">
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
            <div class="text-center py-20 sm:py-24 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-200 shadow-sm">
                <div class="w-24 h-24 sm:w-28 sm:h-28 bg-primary-100 rounded-3xl flex items-center justify-center mx-auto mb-8">
                    <x-icons.navigation.search class="w-12 h-12 sm:w-14 sm:h-14 text-primary-400" />
                </div>
                <h3 class="text-2xl sm:text-3xl font-bold text-primary-700 mb-4">No se encontraron resultados</h3>
                <p class="text-lg text-primary-600 mb-10 max-w-md mx-auto">Intenta con otros términos de búsqueda o ajusta los filtros para encontrar lo que buscas.</p>
                <a href="{{ route('negocios.buscar') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl font-semibold bg-secondary-600 text-white shadow-sm hover:bg-secondary-700 transition-all duration-200">
                    <x-icons.actions.refresh class="w-5 h-5" />
                    <span>Nueva búsqueda</span>
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($negocios as $negocio)
                <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}" class="group block bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-200 shadow-sm hover:shadow-lg hover:border-primary-300 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary-200" tabindex="0">
                    <div class="relative">
                        @if($negocio->imagen_portada)
                        <div class="h-48 sm:h-52 lg:h-56 bg-primary-100 rounded-t-3xl overflow-hidden">
                            <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                                alt="{{ $negocio->nombre_negocio }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        </div>
                        @else
                        <div class="h-48 sm:h-52 lg:h-56 bg-gradient-to-br from-primary-100 to-primary-200 rounded-t-3xl flex items-center justify-center">
                            <x-icons.ui.business class="h-12 w-12 sm:h-14 sm:w-14 text-primary-400 group-hover:text-primary-500 transition-colors duration-300" />
                        </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $negocio->verificado ? 'bg-secondary-100 text-secondary-700 border border-secondary-200' : 'bg-yellow-100 text-yellow-700 border border-yellow-200' }}" @if(!$negocio->verificado) title="Pendiente de verificación. Completa los datos y espera la revisión del equipo." @endif>
                                <span class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-secondary-500' : 'bg-yellow-500' }}"></span>
                                <span class="hidden sm:inline">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                                <span class="sm:hidden">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-7">
                        <h3 class="text-xl sm:text-2xl font-bold text-primary-800 tracking-tight mb-3 sm:mb-4 truncate group-hover:text-primary-700 transition-colors duration-200" title="{{ $negocio->nombre_negocio }}">{{ $negocio->nombre_negocio }}</h3>
                        <p class="text-primary-600 text-sm sm:text-base mb-4 sm:mb-5 h-12 sm:h-14 line-clamp-2 leading-relaxed">{{ Str::limit($negocio->descripcion, 90) }}</p>

                        @if($negocio->ubicacion)
                        <div class="flex items-center text-sm sm:text-base text-primary-600 mb-4 sm:mb-5">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 bg-primary-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                <x-icons.outline.location-marker class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600" />
                            </div>
                            <span class="truncate font-medium text-xs sm:text-sm">{{ $negocio->ubicacion->direccion }}</span>
                        </div>
                        @endif

                        @if($negocio->categorias->isNotEmpty())
                        <div class="mb-4 sm:mb-5">
                            <div class="flex flex-wrap gap-2">
                                @foreach($negocio->categorias->take(2) as $categoria)
                                <span class="inline-flex items-center px-3 py-1.5 sm:px-3.5 sm:py-2 rounded-xl text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                    {{ $categoria->nombre_categoria }}
                                </span>
                                @endforeach
                                @if($negocio->categorias->count() > 2)
                                <span class="inline-flex items-center px-3 py-1.5 sm:px-3.5 sm:py-2 rounded-xl text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                    +{{ $negocio->categorias->count() - 2 }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($negocio->serviciosPredefinidos->isNotEmpty() || $negocio->serviciosPersonalizados->isNotEmpty())
                        <div class="mb-4 sm:mb-5">
                            @php
                            $serviciosCombinados = $negocio->serviciosPredefinidos->merge($negocio->serviciosPersonalizados);
                            $totalServicios = $serviciosCombinados->count();
                            @endphp
                            <div class="flex flex-wrap gap-2">
                                @foreach($serviciosCombinados->take(2) as $servicio)
                                <span class="inline-flex items-center px-3 py-1.5 sm:px-3.5 sm:py-2 rounded-xl text-xs font-semibold bg-secondary-100 text-secondary-700 border border-secondary-200">
                                    {{ $servicio->nombre_servicio ?? $servicio->nombre }}
                                </span>
                                @endforeach
                                @if($totalServicios > 2)
                                <span class="inline-flex items-center px-3 py-1.5 sm:px-3.5 sm:py-2 rounded-xl text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                                    +{{ $totalServicios - 2 }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="p-6 sm:p-7 pt-0 mt-2 border-t border-primary-200 flex justify-between items-center">
                        <span class="text-sm sm:text-base font-semibold text-secondary-600 group-hover:text-secondary-700 transition-colors duration-200">
                            Ver detalles
                        </span>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-secondary-100 rounded-xl flex items-center justify-center group-hover:bg-secondary-200 transition-colors duration-200">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-secondary-600 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Paginación -->
            @if($negocios->hasPages())
            <div class="mt-12 sm:mt-16">
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