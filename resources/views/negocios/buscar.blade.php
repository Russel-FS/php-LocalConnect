@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 py-8 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header con buscador -->
            <div class="mb-8 sm:mb-12">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 sm:gap-6 mb-8 sm:mb-10">
                    <div>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-800 tracking-tight mb-3">
                            Resultados de búsqueda
                        </h1>
                        @if (request('q'))
                            <p class="text-lg sm:text-xl text-primary-600 font-medium">
                                Buscando: <span
                                    class="font-semibold text-secondary-600 bg-secondary-100/80 backdrop-blur-sm px-3 py-1 rounded-full border border-secondary-200">"{{ request('q') }}"</span>
                            </p>
                        @endif
                    </div>
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm sm:text-base font-semibold bg-white/80 backdrop-blur-sm border border-primary-200/50 text-primary-700 shadow-sm">
                        {{ $negocios->total() }} {{ $negocios->total() == 1 ? 'negocio' : 'negocios' }}
                    </span>
                </div>

                <!-- Buscador y Filtros -->
                <form action="{{ route('negocios.buscar') }}" method="GET" id="filtros-form" class="space-y-6">
                    <!--  Buscador principal -->
                    <div class="relative max-w-2xl">
                        <div class="absolute left-5 top-5 z-10">
                            <x-icons.navigation.search class="h-5 w-5 text-primary-400" />
                        </div>
                        <input type="text" name="q" placeholder="Buscar negocios..."
                            class="w-full pl-14 pr-24 py-4 text-base bg-white/90 backdrop-blur-md border border-primary-200/60 rounded-2xl shadow-sm focus:border-secondary-400 focus:ring-2 focus:ring-secondary-100/50 transition-all duration-300 placeholder-primary-400 focus:bg-white/95"
                            value="{{ request('q') }}">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-primary-800 to-primary-700 hover:from-primary-700 hover:to-primary-600 text-white px-6 py-2.5 rounded-full font-medium transition-all duration-300 shadow-sm hover:shadow-md">
                            Buscar
                        </button>
                    </div>

                    <!--  Filtros dropdown -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Dropdown Categorías -->
                        <div class="relative group">
                            <button type="button"
                                class="flex items-center gap-3 px-5 py-3 bg-white/90 backdrop-blur-md border border-primary-200/60 rounded-full shadow-sm hover:bg-white hover:border-primary-400 transition-all duration-300 text-primary-700 font-medium">
                                <x-icons.content.category class="w-4 h-4" />
                                Categorías
                                @if (request('categorias'))
                                    <span class="w-2.5 h-2.5 bg-secondary-500 rounded-full"></span>
                                @endif
                                <x-icons.navigation.chevron-down
                                    class="w-4 h-4 transition-transform group-hover:rotate-180" />
                            </button>
                            <div
                                class="absolute top-full left-0 mt-2 w-72 bg-white/95 backdrop-blur-md border border-primary-200/60 rounded-2xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="p-5 max-h-64 overflow-y-auto custom-scroll">
                                    <div class="space-y-2">
                                        @foreach ($categorias as $categoria)
                                            <label
                                                class="flex items-center p-3 hover:bg-primary-50/80 rounded-xl transition-colors duration-200 cursor-pointer">
                                                <input type="checkbox" name="categorias[]"
                                                    value="{{ $categoria->id_categoria }}"
                                                    class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                                    {{ in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : '' }}>
                                                <span
                                                    class="ml-3 text-sm text-primary-700 font-medium">{{ $categoria->nombre_categoria }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown Características -->
                        <div class="relative group">
                            <button type="button"
                                class="flex items-center gap-3 px-5 py-3 bg-white/90 backdrop-blur-md border border-primary-200/60 rounded-full shadow-sm hover:bg-white hover:border-primary-400 transition-all duration-300 text-primary-700 font-medium">
                                <x-icons.content.check-circle class="w-4 h-4" />
                                Características
                                @if (request('caracteristicas'))
                                    <span class="w-2.5 h-2.5 bg-secondary-500 rounded-full"></span>
                                @endif
                                <x-icons.navigation.chevron-down
                                    class="w-4 h-4 transition-transform group-hover:rotate-180" />
                            </button>
                            <div
                                class="absolute top-full left-0 mt-2 w-72 bg-white/95 backdrop-blur-md border border-primary-200/60 rounded-2xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="p-5 max-h-64 overflow-y-auto custom-scroll">
                                    <div class="space-y-2">
                                        @foreach ($caracteristicas as $caracteristica)
                                            <label
                                                class="flex items-center p-3 hover:bg-primary-50/80 rounded-xl transition-colors duration-200 cursor-pointer">
                                                <input type="checkbox" name="caracteristicas[]"
                                                    value="{{ $caracteristica->id_caracteristica }}"
                                                    class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                                    {{ in_array($caracteristica->id_caracteristica, request('caracteristicas', [])) ? 'checked' : '' }}>
                                                <span
                                                    class="ml-3 text-sm text-primary-700 font-medium">{{ $caracteristica->nombre }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown Servicios Predefinidos -->
                        <div class="relative group">
                            <button type="button"
                                class="flex items-center gap-3 px-5 py-3 bg-white/90 backdrop-blur-md border border-primary-200/60 rounded-full shadow-sm hover:bg-white hover:border-primary-400 transition-all duration-300 text-primary-700 font-medium">
                                <x-icons.content.lightning class="w-4 h-4" />
                                Servicios
                                @if (request('servicios'))
                                    <span class="w-2.5 h-2.5 bg-secondary-500 rounded-full"></span>
                                @endif
                                <x-icons.navigation.chevron-down
                                    class="w-4 h-4 transition-transform group-hover:rotate-180" />
                            </button>
                            <div
                                class="absolute top-full left-0 mt-2 w-72 bg-white/95 backdrop-blur-md border border-primary-200/60 rounded-2xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="p-5 max-h-64 overflow-y-auto custom-scroll">
                                    <div class="space-y-2">
                                        @foreach ($serviciosPredefinidos as $servicio)
                                            <label
                                                class="flex items-center p-3 hover:bg-primary-50/80 rounded-xl transition-colors duration-200 cursor-pointer">
                                                <input type="checkbox" name="servicios[]"
                                                    value="{{ $servicio->id_servicio_predefinido }}"
                                                    class="rounded border-primary-300 text-secondary-600 focus:ring-secondary-500"
                                                    {{ in_array($servicio->id_servicio_predefinido, request('servicios', [])) ? 'checked' : '' }}>
                                                <span
                                                    class="ml-3 text-sm text-primary-700 font-medium">{{ $servicio->nombre_servicio }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex gap-3">
                            <button type="submit"
                                class="flex items-center gap-2.5 px-6 py-3 bg-gradient-to-r from-primary-800 to-primary-700 hover:from-primary-700 hover:to-primary-600 text-white rounded-full font-medium transition-all duration-300 shadow-sm hover:shadow-md">
                                <x-icons.actions.filter class="w-4 h-4" />
                                Aplicar
                            </button>
                            <a href="{{ route('negocios.buscar') }}"
                                class="flex items-center gap-2.5 px-6 py-3 bg-white/90 backdrop-blur-md border border-primary-200/60 text-primary-700 rounded-full font-medium transition-all duration-300 shadow-sm hover:bg-white hover:border-primary-400">
                                <x-icons.actions.refresh class="w-4 h-4" />
                                Limpiar
                            </a>
                        </div>
                    </div>
                </form>
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
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach ($negocios as $negocio)
                            <div
                                class="group bg-white rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col p-0">
                                <!-- Header con imagen y estado -->
                                <div
                                    class="relative w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden rounded-2xl">
                                    @if ($negocio->imagen_portada)
                                        <img src="{{ $negocio->imagen_portada }}" alt="{{ $negocio->nombre_negocio }}"
                                            class="object-cover w-full h-full" loading="lazy"
                                            style="border-radius: 0 0 1.5rem 1.5rem;">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <x-icons.ui.business
                                                class="h-12 w-12 text-primary-400 group-hover:text-primary-500 transition-colors duration-300" />
                                        </div>
                                    @endif
                                    <!-- Estado de verificación -->
                                    <span
                                        class="absolute top-4 right-4 badge-minimal {{ $negocio->verificado ? 'badge-aprobado' : '' }} bg-white/80 backdrop-blur-sm shadow-sm">
                                        {{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}
                                    </span>
                                </div>
                                <!-- Contenido principal -->
                                <div class="flex-1 flex flex-col px-6 pt-6 pb-4">
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
                                                        title="WhatsApp">
                                                        <x-icons.solid.whatsapp class="w-4 h-4 text-green-600" />
                                                    </a>
                                                @elseif($contacto->tipo_contacto === 'telefono')
                                                    <a href="tel:{{ $contacto->valor_contacto }}"
                                                        class="w-8 h-8 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center hover:from-blue-200 hover:to-blue-300 transition-all duration-300 shadow-sm hover:shadow-md"
                                                        title="Llamar">
                                                        <x-icons.outline.phone class="w-4 h-4 text-blue-600" />
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <!-- Footer con acción -->
                                <div
                                    class="w-full flex justify-between items-center px-6 pb-4 pt-2 mt-auto border-t border-gray-100">
                                    <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}"
                                        class="btn-link text-sm font-semibold">
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
    </style>
@endsection
