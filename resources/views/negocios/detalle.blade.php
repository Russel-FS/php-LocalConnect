@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 to-white">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 py-8">

            @if (session('error'))
                <div class="mb-8 p-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Hero Section-->
            <div
                class="relative overflow-hidden bg-white rounded-xl sm:rounded-2xl lg:rounded-3xl mb-8 sm:mb-12 lg:mb-16 xl:mb-20">
                <div class="absolute inset-0"></div>
                <div class="relative p-4 sm:p-6 md:p-8 lg:p-12 xl:p-16 2xl:p-24">
                    <div class="max-w-6xl mx-auto">
                        <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-12 xl:gap-16 items-center min-w-0">
                            <div class="space-y-4 sm:space-y-6 md:space-y-8 lg:space-y-10 min-w-0">
                                <div class="space-y-3 sm:space-y-4 md:space-y-6">
                                    <h1
                                        class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl font-bold text-primary-700 leading-tight tracking-tight">
                                        {{ $negocio->nombre_negocio }}
                                    </h1>
                                    <p
                                        class="text-sm sm:text-base md:text-lg lg:text-xl text-primary-500 leading-relaxed max-w-xl">
                                        {{ $negocio->descripcion }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-2 sm:gap-3 md:gap-4 min-w-0">
                                    @foreach ($negocio->categorias as $categoria)
                                        <span
                                            class="px-1.5 py-1 sm:px-2 sm:py-1.5 md:px-3 md:py-1.5 lg:px-4 lg:py-2 xl:px-5 xl:py-2.5 bg-white/90 backdrop-blur-sm border border-primary-200 text-primary-700 rounded-full text-xs sm:text-sm md:text-base font-semibold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                            {{ $categoria->nombre_categoria }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="flex items-start gap-2 sm:gap-3 md:gap-4 text-primary-500">
                                    @if ($negocio->ubicacion)
                                        <div
                                            class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 lg:w-10 lg:h-10 bg-primary-100 rounded-lg sm:rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0 mt-0.5 sm:mt-1">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-primary-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div
                                                class="text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-primary-700 truncate">
                                                {{ $negocio->ubicacion->direccion }}
                                            </div>
                                            @if ($negocio->ubicacion->distrito)
                                                <div
                                                    class="text-xs sm:text-sm md:text-base lg:text-lg text-primary-500 truncate">
                                                    {{ $negocio->ubicacion->distrito }}, {{ $negocio->ubicacion->ciudad }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2 sm:gap-3 md:gap-4">
                                    <span
                                        class="inline-flex items-center gap-1 sm:gap-1.5 md:gap-2 px-1.5 py-1 sm:px-2 sm:py-1.5 md:px-3 md:py-1.5 lg:px-4 lg:py-2 xl:px-5 xl:py-2.5 rounded-full text-xs sm:text-xs md:text-sm font-semibold
                                        {{ $negocio->verificado ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-yellow-100 text-yellow-700 border border-yellow-200' }}">
                                        <span
                                            class="w-1 h-1 sm:w-1.5 sm:h-1.5 md:w-2 md:h-2 lg:w-2.5 lg:h-2.5 rounded-full {{ $negocio->verificado ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                                        <span
                                            class="hidden md:inline">{{ $negocio->verificado ? 'Verificado' : 'Pendiente de verificación' }}</span>
                                        <span
                                            class="hidden sm:inline md:hidden">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                                        <span
                                            class="sm:hidden">{{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}</span>
                                    </span>
                                </div>
                            </div>

                            @if ($negocio->imagen_portada)
                                <div class="relative group order-first lg:order-last">
                                    <div
                                        class="aspect-square rounded-xl sm:rounded-2xl md:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl md:shadow-2xl group-hover:shadow-2xl sm:group-hover:shadow-3xl transition-all duration-500 group-hover:-translate-y-1 sm:group-hover:-translate-y-1.5 md:group-hover:-translate-y-2">
                                        <img src="{{ $negocio->imagen_portada }}" alt="{{ $negocio->nombre_negocio }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            loading="lazy">
                                    </div>
                                    <div
                                        class="absolute -bottom-1.5 -right-1.5 sm:-bottom-2 sm:-right-2 md:-bottom-3 md:-right-3 lg:-bottom-4 lg:-right-4 xl:-bottom-5 xl:-right-5 w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 xl:w-16 xl:h-16 2xl:w-20 2xl:h-20 bg-secondary-500 rounded-lg sm:rounded-xl md:rounded-2xl lg:rounded-3xl shadow-md sm:shadow-lg md:shadow-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 xl:w-10 xl:h-10 2xl:w-12 2xl:h-12 text-white"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <div class="relative group order-first lg:order-last">
                                    <div
                                        class="aspect-square rounded-xl sm:rounded-2xl md:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl md:shadow-2xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center group-hover:shadow-2xl sm:group-hover:shadow-3xl transition-all duration-500 group-hover:-translate-y-1 sm:group-hover:-translate-y-1.5 md:group-hover:-translate-y-2">
                                        <svg class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-32 lg:h-32 xl:w-36 xl:h-36 2xl:w-40 2xl:h-40 text-primary-400 group-hover:scale-110 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones de informacionnnn -->
            <div class="space-y-16">
                <!-- Servicios -->
                @if ($negocio->serviciosPredefinidos->isNotEmpty() || $negocio->serviciosPersonalizados->isNotEmpty())
                    <div class="space-y-12">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-primary-700 mb-4 tracking-tight">Nuestros Servicios</h2>
                            <p class="text-lg text-primary-500 max-w-3xl mx-auto leading-relaxed">Descubre todo lo que
                                tenemos para ofrecerte con la mejor calidad y atención personalizada</p>
                        </div>

                        <!-- Servicios predefinidos -->
                        @if ($negocio->serviciosPredefinidos->isNotEmpty())
                            <div
                                class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                                <div class="flex items-center gap-6 mb-10">
                                    <div class="w-10 h-10 bg-primary-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-primary-700">Servicios Estándar</h3>
                                        <p class="text-base text-primary-500">Servicios que ofrecemos de manera regular con
                                            la
                                            máxima calidad</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach ($negocio->serviciosPredefinidos as $servicio)
                                        <div class="group relative">
                                            <div
                                                class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-500">
                                                <div class="flex items-start gap-6">
                                                    <div
                                                        class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center group-hover:bg-primary-200 transition-all duration-300 group-hover:scale-110">
                                                        <svg class="w-7 h-7 text-primary-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-width="2"
                                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h4 class="font-bold text-primary-700 text-lg mb-2">
                                                            {{ $servicio->nombre_servicio }}</h4>
                                                        @if ($servicio->descripcion)
                                                            <p class="text-primary-500 text-xs leading-relaxed">
                                                                {{ $servicio->descripcion }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Servicios personalizados -->
                        @if ($negocio->serviciosPersonalizados->isNotEmpty())
                            <div
                                class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                                <div class="flex items-center gap-6 mb-10">
                                    <div class="w-10 h-10 bg-primary-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-width="2"
                                                d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-primary-700">Servicios Personalizados</h3>
                                        <p class="text-sm md:text-base text-primary-500">Servicios adaptados a tus
                                            necesidades
                                            específicas y requerimientos únicos</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach ($negocio->serviciosPersonalizados as $servicio)
                                        <div class="group relative">
                                            <div
                                                class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-500">
                                                <div class="flex items-start gap-6">
                                                    <div
                                                        class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center group-hover:bg-primary-200 transition-all duration-300 group-hover:scale-110">
                                                        <svg class="w-7 h-7 text-primary-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-width="2"
                                                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex flex-wrap items-center gap-4 mb-3">
                                                            <h4 class="font-bold text-primary-700 text-lg truncate">
                                                                {{ $servicio->nombre_servicio }}</h4>
                                                            <span
                                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium {{ $servicio->disponible ? 'bg-secondary-100 text-secondary-600 border border-secondary-200' : 'bg-red-100 text-red-600 border border-red-200' }}">
                                                                <span
                                                                    class="w-2 h-2 rounded-full {{ $servicio->disponible ? 'bg-secondary-500' : 'bg-red-500' }}"></span>
                                                                {{ $servicio->disponible ? 'Disponible' : 'No disponible' }}
                                                            </span>
                                                        </div>
                                                        @if ($servicio->descripcion)
                                                            <p
                                                                class="text-primary-500 text-xs leading-relaxed mb-4 truncate">
                                                                {{ $servicio->descripcion }}</p>
                                                        @endif
                                                        @if ($servicio->precio)
                                                            <div class="flex items-center gap-3">
                                                                <span class="text-2xl font-bold text-primary-600">S/
                                                                    {{ number_format($servicio->precio, 2) }}</span>
                                                                <span
                                                                    class="text-primary-400 text-sm font-medium">Precio</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Características del negocio -->
                @if ($negocio->caracteristicas->isNotEmpty())
                    <div class="space-y-12">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-primary-700 mb-4 tracking-tight">Lo que ofrecemos</h2>
                            <p class="text-lg text-primary-500 max-w-3xl mx-auto leading-relaxed">Características y
                                servicios que nos distinguen y hacen única tu experiencia</p>
                        </div>

                        <div
                            class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                                @foreach ($negocio->caracteristicas as $caracteristica)
                                    <div class="group relative">
                                        <div
                                            class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-500">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl flex items-center justify-center mb-6 group-hover:from-primary-200 group-hover:to-primary-300 transition-all duration-500 group-hover:scale-110">
                                                    <svg class="w-5 h-5 text-primary-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <h4 class="font-bold text-primary-700 text-lg mb-2">
                                                    {{ $caracteristica->nombre }}</h4>
                                                @if ($caracteristica->descripcion)
                                                    <p class="text-primary-500 text-xs leading-relaxed">
                                                        {{ $caracteristica->descripcion }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Información adicional -->
                <div class="space-y-16">
                    <!-- Horarios de atención -->
                    @if ($negocio->horarios->isNotEmpty())
                        <div class="space-y-8">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-primary-700 mb-4 tracking-tight">Horario de atención
                                </h2>
                                <p class="text-lg text-primary-500 max-w-2xl mx-auto">Estamos aquí para ti en los horarios
                                    que mejor te convengan</p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                                <div
                                    class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                                    @foreach ($negocio->horarios as $horario)
                                        <div
                                            class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 sm:p-6 border border-primary-100/50 hover:shadow-sm transition-all duration-300">
                                            <div class="text-center">
                                                <div
                                                    class="w-5 h-5 sm:w-6 sm:h-6 bg-primary-100 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <h3 class="font-bold text-primary-700 text-xs sm:text-sm mb-2 capitalize">
                                                    {{ $horario->dia_semana }}</h3>
                                                @if ($horario->cerrado)
                                                    <span
                                                        class="inline-flex items-center gap-1 sm:gap-2 px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium bg-red-50 text-red-600 border border-red-200">
                                                        <span
                                                            class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-red-500"></span>
                                                        <span class="hidden sm:inline">Cerrado</span>
                                                        <span class="sm:hidden">Cerrado</span>
                                                    </span>
                                                @else
                                                    <div class="text-primary-600 font-semibold text-xs sm:text-sm">
                                                        {{ \Carbon\Carbon::parse($horario->hora_apertura)->format('H:i') }}
                                                        - {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('H:i') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Información de contacto -->
                    @php $contactos = $negocio->contactos ?? collect(); @endphp
                    @if ($contactos->isNotEmpty())
                        <div class="space-y-8">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-primary-700 mb-4 tracking-tight">Información de contacto
                                </h2>
                                <p class="text-lg text-primary-500 max-w-2xl mx-auto">Conecta con nosotros de la manera que
                                    prefieras</p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @if ($contactos->where('tipo_contacto', 'telefono')->first())
                                        <div
                                            class="group bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-300">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="w-10 h-10 bg-primary-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-200 transition-colors">
                                                    <x-icons.outline.phone class="w-5 h-5 text-primary-600" />
                                                </div>
                                                <h3 class="font-bold text-primary-700 text-sm mb-2">Teléfono</h3>
                                                <p class="text-base text-primary-600 font-semibold">
                                                    {{ $contactos->where('tipo_contacto', 'telefono')->first()->valor_contacto }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($contactos->where('tipo_contacto', 'whatsapp')->first())
                                        <div
                                            class="group bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-300">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="w-10 h-10 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-200 transition-colors">
                                                    <x-icons.solid.whatsapp class="w-5 h-5 text-green-600" />
                                                </div>
                                                <h3 class="font-bold text-primary-700 text-sm mb-2">WhatsApp</h3>
                                                <p class="text-base text-primary-600 font-semibold">
                                                    {{ $contactos->where('tipo_contacto', 'whatsapp')->first()->valor_contacto }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($contactos->where('tipo_contacto', 'facebook')->first())
                                        <div
                                            class="group bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-300">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="w-10 h-10 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-200 transition-colors">
                                                    <x-icons.solid.facebook class="w-5 h-5 text-blue-600" />
                                                </div>
                                                <h3 class="font-bold text-primary-700 text-sm mb-2">Facebook</h3>
                                                <p class="text-base text-primary-600 font-semibold">
                                                    {{ $contactos->where('tipo_contacto', 'facebook')->first()->valor_contacto }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($contactos->where('tipo_contacto', 'instagram')->first())
                                        <div
                                            class="group bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-300">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="w-10 h-10 bg-pink-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-200 transition-colors">
                                                    <x-icons.solid.instagram class="w-5 h-5 text-pink-600" />
                                                </div>
                                                <h3 class="font-bold text-primary-700 text-sm mb-2">Instagram</h3>
                                                <p class="text-base text-primary-600 font-semibold">
                                                    {{ $contactos->where('tipo_contacto', 'instagram')->first()->valor_contacto }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($contactos->where('tipo_contacto', 'web')->first())
                                        <div
                                            class="group bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-primary-100/50 hover:shadow-sm transition-all duration-300">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="w-10 h-10 bg-primary-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-200 transition-colors">
                                                    <x-icons.outline.globe class="w-5 h-5 text-primary-600" />
                                                </div>
                                                <h3 class="font-bold text-primary-700 text-sm mb-2">Sitio web</h3>
                                                <a href="{{ $contactos->where('tipo_contacto', 'web')->first()->valor_contacto }}"
                                                    target="_blank"
                                                    class="text-base text-primary-600 font-semibold hover:text-secondary-600 transition">
                                                    {{ $contactos->where('tipo_contacto', 'web')->first()->valor_contacto }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Ubicación con mapa -->
                    @if ($negocio->ubicacion)
                        <div class="space-y-8">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-primary-700 mb-4 tracking-tight">Ubicación</h2>
                                <p class="text-lg text-primary-500 max-w-2xl mx-auto">Encuentra fácilmente nuestro negocio
                                    en el mapa</p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                                <div class="grid lg:grid-cols-2 gap-12 items-start">
                                    <div class="space-y-8">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 bg-primary-100 rounded-2xl flex items-center justify-center">
                                                <x-icons.outline.location-marker class="w-5 h-5 text-primary-600" />
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-primary-700">Dirección</h3>
                                                <p class="text-base text-primary-500">Ubicación exacta del negocio</p>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div class="text-primary-700 font-semibold text-lg">
                                                {{ $negocio->ubicacion->direccion }}</div>
                                            @if ($negocio->ubicacion->distrito)
                                                <div class="text-primary-500 text-base">
                                                    {{ $negocio->ubicacion->distrito }},
                                                    {{ $negocio->ubicacion->ciudad }}</div>
                                            @endif
                                            @if ($negocio->ubicacion->provincia)
                                                <div class="text-primary-500 text-base">
                                                    {{ $negocio->ubicacion->provincia }}
                                                </div>
                                            @endif
                                            <div class="text-primary-500 text-base">{{ $negocio->ubicacion->pais }}</div>
                                        </div>
                                    </div>

                                    <div class="h-96 rounded-2xl overflow-hidden shadow-lg">
                                        <x-common.mapa-ubicacion :negocio="$negocio" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Sección de comentarios -->
            <div class="space-y-8 mt-16">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-primary-700 mb-4 tracking-tight">Opiniones de clientes</h2>
                    <p class="text-lg text-primary-500 max-w-2xl mx-auto">Lo que dicen nuestros clientes sobre nosotros</p>
                </div>

                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-6 border border-primary-100/50 shadow-sm">
                    @if ($negocio->valoraciones->count())
                        <div class="space-y-6 mb-10">
                            @foreach ($negocio->valoraciones->sortByDesc('fecha_valoracion') as $valoracion)
                                <div
                                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 flex gap-4 items-start shadow-sm border border-primary-100/50">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-base select-none">
                                        {{ strtoupper(substr($valoracion->usuario->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="font-semibold text-primary-700">{{ $valoracion->usuario->name }}</span>
                                                <span
                                                    class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($valoracion->fecha_valoracion)->diffForHumans() }}</span>
                                            </div>
                                            @if (Auth::check() && Auth::id() == $valoracion->id_usuario)
                                                <div class="flex items-center gap-2">
                                                    <!-- Botones de editar -->
                                                    <button type="button"
                                                        onclick="editarComentario({{ $valoracion->id_valoracion }}, {{ $valoracion->calificacion }}, '{{ addslashes($valoracion->comentario) }}')"
                                                        class="text-primary-600 hover:text-primary-800 transition-colors p-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </button>
                                                    <!-- Botón de eliminar -->
                                                    <form method="POST"
                                                        action="{{ route('negocios.eliminar-comentario', $valoracion->id_valoracion) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este comentario?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-800 transition-colors p-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-0.5 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <x-icons.solid.star
                                                    class="w-4 h-4 {{ $i <= $valoracion->calificacion ? 'text-yellow-400' : 'text-gray-200' }}" />
                                            @endfor
                                        </div>
                                        <p class="text-primary-600 text-base leading-relaxed">
                                            {{ $valoracion->comentario }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-slate-400 mb-10 text-center">Aún no hay comentarios para este negocio.</p>
                    @endif
                    @if (Auth::check() && !$negocio->valoraciones->where('id_usuario', Auth::id())->count())
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-primary-100/50 p-6">
                            <h3 class="text-lg font-semibold text-primary-700 mb-4">Deja tu comentario</h3>
                            @if (session('success'))
                                <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                                    {{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="mb-4 p-3 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                                    {{ session('error') }}</div>
                            @endif
                            <form method="POST" action="{{ route('negocios.comentar', $negocio->id_negocio) }}"
                                class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block mb-2 text-primary-600 font-medium">Calificación</label>
                                    <div x-data="{ rating: 0 }" class="flex items-center gap-1">
                                        <template x-for="star in 5" :key="star">
                                            <button type="button" @click.prevent="rating = star"
                                                :class="rating >= star ? 'text-yellow-400' : 'text-gray-200'"
                                                class="focus:outline-none transition-colors duration-150">
                                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                                                </svg>
                                            </button>
                                        </template>
                                        <input type="hidden" name="calificacion" x-model="rating" required>
                                    </div>
                                    @if ($errors->has('calificacion'))
                                        <p class="text-sm text-red-600 mt-1">{{ $errors->first('calificacion') }}</p>
                                    @endif
                                </div>
                                <div>
                                    <label class="block mb-2 text-primary-600 font-medium">Comentario</label>
                                    <textarea name="comentario" rows="3" required maxlength="1000"
                                        class="w-full rounded-xl border border-primary-100 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-100/40 transition p-3 resize-none"
                                        placeholder="¿Qué te pareció este negocio?"></textarea>
                                    @if ($errors->has('comentario'))
                                        <p class="text-sm text-red-600 mt-1">{{ $errors->first('comentario') }}</p>
                                    @endif
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center gap-3 px-8 py-3 rounded-xl bg-secondary-500 text-white font-medium text-base shadow-sm hover:bg-secondary-600 hover:shadow-md transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Enviar comentario</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Formulario de edición de comentarios -->
            <div id="formulario-edicion" class="hidden mt-8">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-primary-100/50 p-6">
                    <h3 class="text-lg font-semibold text-primary-700 mb-4">Editar comentario</h3>
                    <form method="POST" id="form-editar-comentario" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block mb-2 text-primary-600 font-medium">Calificación</label>
                            <div x-data="{ rating: 0 }" class="flex items-center gap-1">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click.prevent="rating = star"
                                        :class="rating >= star ? 'text-yellow-400' : 'text-gray-200'"
                                        class="focus:outline-none transition-colors duration-150">
                                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                                        </svg>
                                    </button>
                                </template>
                                <input type="hidden" name="calificacion" x-model="rating" required>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-primary-600 font-medium">Comentario</label>
                            <textarea name="comentario" id="comentario-edicion" rows="3" required maxlength="1000"
                                class="w-full rounded-xl border border-primary-100 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-100/40 transition p-3 resize-none"
                                placeholder="¿Qué te pareció este negocio?"></textarea>
                        </div>
                        <div class="flex justify-end gap-3">
                            <button type="button" onclick="cancelarEdicion()"
                                class="px-6 py-3 rounded-full border-2 border-primary-200 bg-white text-primary-700 font-semibold text-base shadow-md hover:shadow-lg hover:bg-primary-50 hover:border-primary-400 transform hover:-translate-y-0.5 transition-all duration-300">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="inline-flex items-center gap-3 px-8 py-3 rounded-xl bg-secondary-500 text-white font-medium text-base shadow-sm hover:bg-secondary-600 hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Actualizar comentario</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- boton de regreso -->
            <div class="mt-16 text-center">
                <button type="button" onclick="history.back()"
                    class="inline-flex items-center gap-3 px-8 py-3 rounded-full font-semibold border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 hover:border-primary-400 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Volver</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // funcion para editar un comentario
        function editarComentario(idValoracion, calificacion, comentario) {
            document.getElementById('formulario-edicion').classList.remove('hidden');
            document.getElementById('form-editar-comentario').action = '{{ route('negocios.editar-comentario', ':id') }}'
                .replace(':id', idValoracion);
            document.getElementById('comentario-edicion').value = comentario;
            const ratingInput = document.querySelector('#form-editar-comentario input[name="calificacion"]');
            if (ratingInput && ratingInput._x_dataStack) {
                ratingInput._x_dataStack[0].rating = calificacion;
            }
            // desplazar hacia el formm de edicionnnnnnnnnnnn
            document.getElementById('formulario-edicion').scrollIntoView({
                behavior: 'smooth'
            });
        }
        /// funciona para cancelar edicion
        function cancelarEdicion() {
            document.getElementById('formulario-edicion').classList.add('hidden');
            document.getElementById('comentario-edicion').value = '';
        }
    </script>
@endsection
