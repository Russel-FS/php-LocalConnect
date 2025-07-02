@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-primary-50 py-8 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="mb-8 sm:mb-12" x-data="{ menuMobil: false }">
                <div class="mx-auto">
                    <div class="bg-white rounded-2xl p-6 mb-6">
                        <div class="flex flex-col lg:flex-row gap-4 items-center mb-4">
                            <form action="{{ route('negocios.buscar') }}" method="GET" id="filtros-form" class="w-full">
                                <div class="flex flex-col lg:flex-row gap-4 items-center">
                                    <!-- Buscador -->
                                    <div class="flex-1 min-w-0">
                                        <div class="relative group">
                                            <input type="text" name="q" placeholder="¿Qué negocio buscas hoy?"
                                                class="w-full pl-4 pr-12 py-3 text-sm bg-white rounded-full border border-gray-200 focus:border-primary-400 focus:ring-1 focus:ring-primary-100 transition-all duration-300 placeholder-gray-400"
                                                value="{{ request('q') }}">
                                            <button type="submit"
                                                class="absolute right-2 top-1/2 -translate-y-1/2 z-10 p-2 bg-gray-900 text-white rounded-full hover:bg-gray-800 transition-colors duration-200 flex items-center justify-center">
                                                <x-icons.navigation.search class="h-4 w-4" />
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón de filtros para móvil -->
                                    <div class="lg:hidden">
                                        <button type="button"
                                            class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 rounded-lg hover:bg-gray-50"
                                            @click="menuMobil = true">
                                            <x-icons.actions.filter class="w-4 h-4" />
                                            Filtros
                                            @if (request('categorias') || request('caracteristicas') || request('servicios'))
                                                <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                            @endif
                                        </button>
                                    </div>

                                    <!-- Filtros principales (solo desktopw) -->
                                    <div class="hidden lg:flex flex-wrap gap-3 items-center">
                                        <!-- Categorías -->
                                        <div class="relative" x-data="{ open: false }">
                                            <button type="button"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 rounded-lg hover:bg-gray-50"
                                                @click="open = !open">
                                                <x-icons.content.category class="w-4 h-4" />
                                                Categorías
                                                @if (request('categorias'))
                                                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                                @endif
                                                <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform"
                                                    x-bind:class="open ? 'rotate-180' : ''" />
                                            </button>
                                            <div x-show="open" @click.away="open = false"
                                                class="absolute top-full left-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-100 z-50"
                                                x-transition>
                                                <div class="p-5">
                                                    <div class="flex items-center gap-2 mb-4">
                                                        <x-icons.content.category class="w-5 h-5 text-primary-600" />
                                                        <h4 class="text-sm font-semibold text-gray-900">Categorías</h4>
                                                    </div>
                                                    <div class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                                                        @foreach ($categorias as $categoria)
                                                            <label
                                                                class="flex items-center gap-3 p-3 rounded-full bg-white border border-gray-100 text-sm cursor-pointer hover:bg-gray-50 transition-all duration-200">
                                                                <input type="checkbox" name="categorias[]"
                                                                    value="{{ $categoria->id_categoria }}"
                                                                    class="w-4 h-4 accent-primary-500 rounded border-gray-300"
                                                                    {{ in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : '' }}>
                                                                <span
                                                                    class="text-gray-700 font-normal">{{ $categoria->nombre_categoria }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Características -->
                                        <div class="relative" x-data="{ open: false }">
                                            <button type="button"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 rounded-lg hover:bg-gray-50"
                                                @click="open = !open">
                                                <x-icons.content.check-circle class="w-4 h-4" />
                                                Características
                                                @if (request('caracteristicas'))
                                                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                                @endif
                                                <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform"
                                                    x-bind:class="open ? 'rotate-180' : ''" />
                                            </button>
                                            <div x-show="open" @click.away="open = false"
                                                class="absolute top-full left-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-100 z-50"
                                                x-transition>
                                                <div class="p-5">
                                                    <div class="flex items-center gap-2 mb-4">
                                                        <x-icons.content.check-circle class="w-5 h-5 text-primary-600" />
                                                        <h4 class="text-sm font-semibold text-gray-900">Características</h4>
                                                    </div>
                                                    <div class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                                                        @foreach ($caracteristicas as $caracteristica)
                                                            <label
                                                                class="flex items-center gap-3 p-3 rounded-full bg-white border border-gray-100 text-sm cursor-pointer hover:bg-gray-50 transition-all duration-200">
                                                                <input type="checkbox" name="caracteristicas[]"
                                                                    value="{{ $caracteristica->id_caracteristica }}"
                                                                    class="w-4 h-4 accent-primary-500 rounded border-gray-300"
                                                                    {{ in_array($caracteristica->id_caracteristica, request('caracteristicas', [])) ? 'checked' : '' }}>
                                                                <span
                                                                    class="text-gray-700 font-normal">{{ $caracteristica->nombre }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Servicios -->
                                        <div class="relative" x-data="{ open: false }">
                                            <button type="button"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 rounded-lg hover:bg-gray-50"
                                                @click="open = !open">
                                                <x-icons.content.lightning class="w-4 h-4" />
                                                Servicios
                                                @if (request('servicios'))
                                                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                                @endif
                                                <x-icons.navigation.chevron-down class="w-4 h-4 transition-transform"
                                                    x-bind:class="open ? 'rotate-180' : ''" />
                                            </button>
                                            <div x-show="open" @click.away="open = false"
                                                class="absolute top-full left-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-100 z-50"
                                                x-transition>
                                                <div class="p-5">
                                                    <div class="flex items-center gap-2 mb-4">
                                                        <x-icons.content.lightning class="w-5 h-5 text-primary-600" />
                                                        <h4 class="text-sm font-semibold text-gray-900">Servicios</h4>
                                                    </div>
                                                    <div class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                                                        @foreach ($serviciosPredefinidos as $servicio)
                                                            <label
                                                                class="flex items-center gap-3 p-3 rounded-full bg-white border border-gray-100 text-sm cursor-pointer hover:bg-gray-50 transition-all duration-200">
                                                                <input type="checkbox" name="servicios[]"
                                                                    value="{{ $servicio->id_servicio_predefinido }}"
                                                                    class="w-4 h-4 accent-primary-500 rounded border-gray-300"
                                                                    {{ in_array($servicio->id_servicio_predefinido, request('servicios', [])) ? 'checked' : '' }}>
                                                                <span
                                                                    class="text-gray-700 font-normal">{{ $servicio->nombre_servicio }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botones de acción -->
                                        <div class="flex gap-2">
                                            <button type="submit"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors duration-200 rounded-lg hover:bg-primary-50">
                                                <x-icons.actions.filter class="w-4 h-4" />
                                                Aplicar
                                            </button>
                                            <a href="{{ route('negocios.buscar') }}"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors duration-200 rounded-lg hover:bg-gray-50">
                                                <x-icons.actions.refresh class="w-4 h-4" />
                                                Limpiar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Información de búsquedaa -->
                        <div
                            class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                @if (request('q'))
                                    <p class="text-sm text-gray-600">
                                        Buscando: <span class="font-medium text-primary-700">"{{ request('q') }}"</span>
                                    </p>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500 font-medium">
                                {{ $negocios->total() }}
                                {{ $negocios->total() == 1 ? 'negocio encontrado' : 'negocios encontrados' }}
                            </span>
                        </div>

                        <!-- Filtros activos -->
                        @if (request('categorias') || request('caracteristicas') || request('servicios'))
                            <div class="flex flex-wrap gap-2 justify-start pt-4 border-t border-gray-100">
                                @if (request('categorias'))
                                    @foreach (request('categorias') as $categoriaId)
                                        @php
                                            $categoria = $categorias->find($categoriaId);
                                        @endphp
                                        @if ($categoria)
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-100 text-primary-700 text-xs font-medium rounded-full border border-primary-200">
                                                <x-icons.content.category class="w-3 h-3" />
                                                {{ $categoria->nombre_categoria }}
                                                <a href="{{ route('negocios.buscar', array_merge(request()->except('categorias'), ['categorias' => array_diff(request('categorias', []), [$categoriaId])])) }}"
                                                    class="ml-1 hover:text-primary-900 transition-colors duration-200">×</a>
                                            </span>
                                        @endif
                                    @endforeach
                                @endif

                                @if (request('caracteristicas'))
                                    @foreach (request('caracteristicas') as $caracteristicaId)
                                        @php
                                            $caracteristica = $caracteristicas->find($caracteristicaId);
                                        @endphp
                                        @if ($caracteristica)
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-secondary-100 text-secondary-700 text-xs font-medium rounded-full border border-secondary-200">
                                                <x-icons.content.check-circle class="w-3 h-3" />
                                                {{ $caracteristica->nombre }}
                                                <a href="{{ route('negocios.buscar', array_merge(request()->except('caracteristicas'), ['caracteristicas' => array_diff(request('caracteristicas', []), [$caracteristicaId])])) }}"
                                                    class="ml-1 hover:text-secondary-900 transition-colors duration-200">×</a>
                                            </span>
                                        @endif
                                    @endforeach
                                @endif

                                @if (request('servicios'))
                                    @foreach (request('servicios') as $servicioId)
                                        @php
                                            $servicio = $serviciosPredefinidos->find($servicioId);
                                        @endphp
                                        @if ($servicio)
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-secondary-100 text-secondary-700 text-xs font-medium rounded-full border border-secondary-200">
                                                <x-icons.content.lightning class="w-3 h-3" />
                                                {{ $servicio->nombre_servicio }}
                                                <a href="{{ route('negocios.buscar', array_merge(request()->except('servicios'), ['servicios' => array_diff(request('servicios', []), [$servicioId])])) }}"
                                                    class="ml-1 hover:text-secondary-900 transition-colors duration-200">×</a>
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Drawer de filtros para móvil tengo sueñooooooooooooooooo revisen el codigo de filtro de desktop creo que algo falla -->
                <div class="lg:hidden">
                    <div x-show="menuMobil" x-cloak class="fixed inset-0 z-50 flex justify-end">
                        <!-- Backdrop negro -->
                        <div x-show="menuMobil" x-transition:enter="transition-opacity ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="absolute inset-0 bg-black/20 backdrop-blur-sm" @click="menuMobil = false"></div>

                        <!-- Panel de filtros -->
                        <div x-show="menuMobil" x-transition:enter="transition-transform ease-out duration-300"
                            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition-transform ease-in duration-200"
                            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                            class="relative w-4/5 h-screen bg-white shadow-2xl flex flex-col" style="width: 80vw;">
                            <!-- Header -->
                            <div class="flex items-center justify-between px-6 py-6 border-b border-gray-100">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900">Filtros</h2>
                                    <p class="text-sm text-gray-500 mt-1">Personaliza tu búsqueda</p>
                                </div>
                                <button @click="menuMobil = false"
                                    class="p-2 rounded-full hover:bg-gray-100 transition-colors duration-200">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Contenido scrolleable -->
                            <div class="flex-1 overflow-y-auto custom-scrollbar px-6 py-6">
                                <form action="{{ route('negocios.buscar') }}" method="GET" id="filtros-form-movil"
                                    class="flex flex-col gap-8">
                                    <!-- Categorías -->
                                    <div>
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <x-icons.content.category class="w-4 h-4 text-gray-600" />
                                            </div>
                                            <div>
                                                <h3 class="text-base font-semibold text-gray-900">Categorías</h3>
                                                <p class="text-sm text-gray-500">Tipo de negocio</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-2">
                                            @foreach ($categorias as $categoria)
                                                <label
                                                    class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 border-2 border-transparent text-sm cursor-pointer hover:bg-gray-100 hover:border-gray-200 transition-all duration-200 group">
                                                    <input type="checkbox" name="categorias[]"
                                                        value="{{ $categoria->id_categoria }}"
                                                        class="w-5 h-5 accent-gray-600 rounded border-gray-300"
                                                        {{ in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : '' }}>
                                                    <span
                                                        class="text-gray-700 font-medium group-hover:text-gray-900">{{ $categoria->nombre_categoria }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Características -->
                                    <div>
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <x-icons.content.check-circle class="w-4 h-4 text-gray-600" />
                                            </div>
                                            <div>
                                                <h3 class="text-base font-semibold text-gray-900">Características</h3>
                                                <p class="text-sm text-gray-500">Servicios especiales</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-2">
                                            @foreach ($caracteristicas as $caracteristica)
                                                <label
                                                    class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 border-2 border-transparent text-sm cursor-pointer hover:bg-gray-100 hover:border-gray-200 transition-all duration-200 group">
                                                    <input type="checkbox" name="caracteristicas[]"
                                                        value="{{ $caracteristica->id_caracteristica }}"
                                                        class="w-5 h-5 accent-gray-600 rounded border-gray-300"
                                                        {{ in_array($caracteristica->id_caracteristica, request('caracteristicas', [])) ? 'checked' : '' }}>
                                                    <span
                                                        class="text-gray-700 font-medium group-hover:text-gray-900">{{ $caracteristica->nombre }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Servicios -->
                                    <div>
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <x-icons.content.lightning class="w-4 h-4 text-gray-600" />
                                            </div>
                                            <div>
                                                <h3 class="text-base font-semibold text-gray-900">Servicios</h3>
                                                <p class="text-sm text-gray-500">Lo que ofrecen</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-2">
                                            @foreach ($serviciosPredefinidos as $servicio)
                                                <label
                                                    class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 border-2 border-transparent text-sm cursor-pointer hover:bg-gray-100 hover:border-gray-200 transition-all duration-200 group">
                                                    <input type="checkbox" name="servicios[]"
                                                        value="{{ $servicio->id_servicio_predefinido }}"
                                                        class="w-5 h-5 accent-gray-600 rounded border-gray-300"
                                                        {{ in_array($servicio->id_servicio_predefinido, request('servicios', [])) ? 'checked' : '' }}>
                                                    <span
                                                        class="text-gray-700 font-medium group-hover:text-gray-900">{{ $servicio->nombre_servicio }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Botones modernos -->
                            <div class="px-6 py-6 border-t border-gray-100 bg-gray-50">
                                <div class="flex gap-3">
                                    <button type="submit" form="filtros-form-movil"
                                        class="flex-1 py-4 rounded-2xl bg-gray-900 text-white font-semibold hover:bg-gray-800 transition-all duration-200 text-sm">
                                        Aplicar filtros
                                    </button>
                                    <a href="{{ route('negocios.buscar') }}"
                                        class="flex-1 py-4 rounded-2xl bg-white text-gray-600 font-semibold hover:bg-gray-100 transition-all duration-200 text-center text-sm border-2 border-gray-200">
                                        Limpiar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Título-->
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-primary-800 tracking-tight">
                        Resultados de búsqueda
                    </h1>
                </div>
            </div>

            <!-- Resultados -->
            <div class="w-full">
                @if ($negocios->isEmpty())
                    <div
                        class="text-center py-20 sm:py-24 bg-white/90 backdrop-blur-md rounded-3xl border border-primary-200/60 shadow-sm">
                        <div
                            class="w-24 h-24 sm:w-28 sm:h-28 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-8">
                            <x-icons.navigation.search class="w-12 h-12 sm:w-14 sm:h-14 text-primary-400" />
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-primary-800 mb-4">No se encontraron resultados</h3>
                        <p class="text-lg text-primary-600 mb-10 max-w-md mx-auto">Intenta con otros términos de búsqueda o
                            ajusta los filtros para encontrar lo que buscas.</p>
                        <a href="{{ route('negocios.buscar') }}"
                            class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-medium bg-gradient-to-r from-primary-800 to-primary-700 text-white shadow-sm hover:from-primary-700 hover:to-primary-600 transition-all duration-300">
                            <x-icons.actions.refresh class="w-5 h-5" />
                            <span>Nueva búsqueda</span>
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach ($negocios as $negocio)
                            <div
                                class="fade-in-card group bg-white rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex flex-col p-0">
                                <!-- Header -->
                                <div
                                    class="relative w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden rounded-2xl img-responsive-rappi">
                                    @if ($negocio->imagen_portada)
                                        <img src="{{ $negocio->imagen_portada }}" alt="{{ $negocio->nombre_negocio }}"
                                            class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105"
                                            loading="lazy" style="border-radius: 0 0 1.5rem 1.5rem;">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <x-icons.ui.business
                                                class="h-12 w-12 text-primary-400 group-hover:text-primary-500 transition-colors duration-300" />
                                        </div>
                                    @endif
                                    <!-- Badge Promo -->
                                    @if ($negocio->promociones && $negocio->promociones->count() > 0)
                                        <span
                                            class="absolute top-4 left-4 bg-pink-100 text-pink-600 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">Promo</span>
                                    @endif
                                    <!-- Estado de verificación -->
                                    <span
                                        class="absolute top-4 right-4 badge-minimal {{ $negocio->verificado ? 'badge-aprobado' : '' }} bg-white/80 backdrop-blur-sm shadow-sm">
                                        {{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}
                                    </span>
                                </div>
                                <!-- Contenido principal -->
                                <div class="flex-1 flex flex-col px-6 pt-6 pb-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <!-- Avatar inicial usuario -->
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-base select-none">
                                            {{ strtoupper(substr($negocio->usuario->name ?? $negocio->usuario->email, 0, 1)) }}
                                        </div>
                                        <span
                                            class="text-xs text-gray-500 font-medium truncate">{{ $negocio->usuario->name ?? $negocio->usuario->email }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug truncate mb-1"
                                        title="{{ $negocio->nombre_negocio }}">
                                        {{ $negocio->nombre_negocio }}
                                    </h3>
                                    <p class="text-sm text-gray-500 leading-relaxed mb-2">
                                        {{ $negocio->descripcion }}
                                    </p>
                                    @if ($negocio->ubicacion)
                                        <div class="flex items-center gap-2 text-gray-400 text-xs mb-2">
                                            <x-icons.outline.location-marker class="w-4 h-4" />
                                            <span class="truncate font-medium">{{ $negocio->ubicacion->direccion }},
                                                {{ $negocio->ubicacion->distrito }}</span>
                                        </div>
                                    @endif
                                    @php
                                        $diasEspanol = [
                                            'monday' => 'lunes',
                                            'tuesday' => 'martes',
                                            'wednesday' => 'miércoles',
                                            'thursday' => 'jueves',
                                            'friday' => 'viernes',
                                            'saturday' => 'sábado',
                                            'sunday' => 'domingo',
                                        ];
                                        $hoy = $diasEspanol[strtolower(date('l'))];
                                        $horarioHoy = $negocio->horarios->where('dia_semana', $hoy)->first();
                                    @endphp
                                    @if ($horarioHoy)
                                        <div class="flex items-center gap-2 text-gray-400 text-xs mb-2">
                                            <x-icons.content.clock class="w-4 h-4" />
                                            @if ($horarioHoy->cerrado)
                                                <span class="font-medium text-red-600">Cerrado hoy</span>
                                            @else
                                                <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($horarioHoy->hora_apertura)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($horarioHoy->hora_cierre)->format('H:i') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    <!-- Categorías -->
                                    @if ($negocio->categorias->isNotEmpty())
                                        <div class="flex flex-wrap gap-1.5 mb-2">
                                            @foreach ($negocio->categorias as $categoria)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100/80 text-primary-700 border border-primary-200/60">
                                                    {{ $categoria->nombre_categoria }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <!-- Características destacadas -->
                                    @if ($negocio->caracteristicas->isNotEmpty())
                                        <div class="flex flex-wrap gap-1.5 mb-2">
                                            @foreach ($negocio->caracteristicas->take(3) as $caracteristica)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-secondary-100/80 text-secondary-700 border border-secondary-200/60">
                                                    {{ $caracteristica->nombre }}
                                                </span>
                                            @endforeach
                                            @if ($negocio->caracteristicas->count() > 3)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100/80 text-primary-700 border border-primary-200/60">
                                                    +{{ $negocio->caracteristicas->count() - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    <!-- Servicios -->
                                    @if ($negocio->serviciosPredefinidos->count() > 0 || $negocio->serviciosPersonalizados->count() > 0)
                                        <div class="flex flex-wrap gap-1.5 mb-2">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-secondary-100/80 text-secondary-700 border border-secondary-200/60">
                                                <x-icons.content.lightning class="w-3 h-3" />
                                                {{ $negocio->serviciosPredefinidos->count() + $negocio->serviciosPersonalizados->count() }}
                                                servicios
                                            </span>
                                        </div>
                                    @endif
                                    <!-- Contactos rápidos -->
                                    @if ($negocio->contactos->isNotEmpty())
                                        <div class="flex items-center gap-2 mb-2">
                                            @foreach ($negocio->contactos->where('activo', true)->take(2) as $contacto)
                                                @if ($contacto->tipo_contacto === 'whatsapp')
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contacto->valor_contacto) }}"
                                                        target="_blank"
                                                        class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center hover:from-green-200 hover:to-green-300 transition-all duration-300 shadow-sm hover:shadow-md"
                                                        title="WhatsApp" aria-label="WhatsApp">
                                                        <x-icons.solid.whatsapp class="w-4 h-4 text-green-600" />
                                                    </a>
                                                @elseif($contacto->tipo_contacto === 'telefono')
                                                    <a href="tel:{{ $contacto->valor_contacto }}"
                                                        class="w-8 h-8 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center hover:from-blue-200 hover:to-blue-300 transition-all duration-300 shadow-sm hover:shadow-md"
                                                        title="Llamar" aria-label="Llamar">
                                                        <x-icons.outline.phone class="w-4 h-4 text-blue-600" />
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <!-- valoreaciones-->
                                    @if ($negocio->valoraciones->count() > 0)
                                        @php
                                            $promedio = round($negocio->valoraciones->avg('calificacion'), 1);
                                        @endphp
                                        <div class="flex items-center gap-1 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $promedio ? 'text-yellow-400' : 'text-gray-200' }}"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                                                </svg>
                                            @endfor
                                            <span
                                                class="ml-2 text-xs text-gray-500 font-semibold">{{ $promedio }}</span>
                                            <span
                                                class="text-xs text-gray-400">({{ $negocio->valoraciones->count() }})</span>
                                        </div>
                                    @endif
                                </div>
                                <!-- Footer y acciones -->
                                <div
                                    class="w-full flex justify-between items-center px-6 pb-4 pt-2 mt-auto border-t border-gray-100">
                                    <!-- Botones de favoritos y me gusta -->
                                    <div class="flex items-center gap-4">
                                        @php
                                            $esFavorito =
                                                auth()->check() &&
                                                $negocio->favoritos->where('id_usuario', auth()->id())->count() > 0;
                                            $esMeGusta =
                                                auth()->check() &&
                                                $negocio->meGusta->where('id_usuario', auth()->id())->count() > 0;
                                        @endphp
                                        <!-- Favorito -->
                                        <form
                                            action="{{ $esFavorito ? route('negocios.favorito.quitar', $negocio->id_negocio) : route('negocios.favorito.agregar', $negocio->id_negocio) }}"
                                            method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit"
                                                class="group flex items-center gap-1 text-yellow-500 hover:text-yellow-600 focus:outline-none">
                                                <svg class="w-5 h-5 {{ $esFavorito ? 'fill-yellow-400' : 'fill-none' }}"
                                                    stroke="currentColor" viewBox="0 0 20 20">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                                                </svg>
                                                <span class="text-xs">{{ $negocio->favoritos->count() }}</span>
                                            </button>
                                        </form>
                                        <!-- Me gusta -->
                                        <form
                                            action="{{ $esMeGusta ? route('negocios.megusta.quitar', $negocio->id_negocio) : route('negocios.megusta.agregar', $negocio->id_negocio) }}"
                                            method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit"
                                                class="group flex items-center gap-1 text-pink-500 hover:text-pink-600 focus:outline-none">
                                                <svg class="w-5 h-5 {{ $esMeGusta ? 'fill-pink-400' : 'fill-none' }}"
                                                    stroke="currentColor" viewBox="0 0 20 20">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                                                </svg>
                                                <span class="text-xs">{{ $negocio->meGusta->count() }}</span>
                                            </button>
                                        </form>
                                    </div>
                                    <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}"
                                        class="btn-link text-sm font-semibold"
                                        aria-label="Ver detalles de {{ $negocio->nombre_negocio }}">
                                        Ver detalles
                                        <svg class="w-4 h-4 ml-1 inline-block text-primary-600" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    @if ($negocios->hasPages())
                        <div class="mt-12 sm:mt-16">
                            {{ $negocios->appends(request()->query())->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <script>
        // Auto-submitr form cuando cambien los checkboxesss xd son las 1 am y yo haciendo esto.
        document.addEventListener('DOMContentLoaded', function() {
            // Para el formulario de desktop
            const checkboxes = document.querySelectorAll('#filtros-form input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    document.getElementById('filtros-form').submit();
                });
            });

            // Para el formulario móvil
            const checkboxesMovil = document.querySelectorAll('#filtros-form-movil input[type="checkbox"]');
            checkboxesMovil.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Pequeño delay para que se vea el cambio visual
                    setTimeout(() => {
                        document.getElementById('filtros-form-movil').submit();
                    }, 300);
                });
            });
        });
    </script>

    <style>
        .badge-minimal {
            background: #f9f9f9;
            color: #bfa94a;
            font-size: 0.75rem;
            padding: 0.18rem 0.8rem;
            border-radius: 9999px;
            font-weight: 500;
            letter-spacing: 0.01em;
            display: inline-block;
        }

        .badge-aprobado {
            background: #f0fdfa;
            color: var(--color-secondary-700);
        }

        .btn-link {
            background: none;
            border: none;
            color: var(--color-primary-600);
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            border-radius: 9999px;
            transition: background 0.2s, color 0.2s;
        }

        .btn-link:hover {
            background: var(--color-primary-50);
            color: var(--color-primary-800);
        }

        .fade-in-card {
            opacity: 0;
            transform: translateY(24px);
            animation: fadeInCard 0.7s cubic-bezier(.4, 0, .2, 1) forwards;
        }

        @keyframes fadeInCard {
            to {
                opacity: 1;
                transform: none;
            }
        }

        /* Scrollbarr*/
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /*contenedor de filtros*/
        .filter-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        @media (max-width: 640px) {
            .img-responsive-rappi {
                aspect-ratio: 1/1;
            }
        }

        @media (min-width: 641px) {
            .img-responsive-rappi {
                aspect-ratio: 16/9;
            }
        }
    </style>
@endsection
