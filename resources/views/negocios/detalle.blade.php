@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if(session('error'))
        <div class="mb-8 p-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl">
            {{ session('error') }}
        </div>
        @endif

        <!-- Hero Section-->
        <div class="relative overflow-hidden bg-gradient-to-br from-primary-50 to-white rounded-3xl mb-16">
            <div class="absolute inset-0 bg-gradient-to-r from-secondary-500/5 to-primary-500/5"></div>
            <div class="relative p-12 lg:p-20">
                <div class="max-w-4xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <h1 class="text-5xl lg:text-6xl font-bold text-primary-700 leading-tight tracking-tight">
                                    {{ $negocio->nombre_negocio }}
                                </h1>
                                <p class="text-xl text-primary-500 leading-relaxed max-w-lg">
                                    {{ $negocio->descripcion }}
                                </p>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                @foreach($negocio->categorias as $categoria)
                                <span class="px-4 py-2 bg-white/80 backdrop-blur-sm border border-primary-200 text-primary-700 rounded-full text-sm font-medium shadow-sm">
                                    {{ $categoria->nombre_categoria }}
                                </span>
                                @endforeach
                            </div>

                            <div class="flex items-center gap-3 text-primary-500">
                                @if($negocio->ubicacion)
                                <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-lg">
                                    <span class="font-semibold text-primary-700">{{ $negocio->ubicacion->direccion }}</span>
                                    @if($negocio->ubicacion->distrito)
                                    , {{ $negocio->ubicacion->distrito }}, {{ $negocio->ubicacion->ciudad }}
                                    @endif
                                </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $negocio->verificado ? 'bg-secondary-500/10 text-secondary-600 border border-secondary-200' : 'bg-yellow-500/10 text-yellow-600 border border-yellow-200' }}">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $negocio->verificado ? 'bg-secondary-500' : 'bg-yellow-500' }}"></span>
                                    {{ $negocio->verificado ? 'Verificado' : 'Pendiente de verificación' }}
                                </span>
                            </div>
                        </div>

                        @if($negocio->imagen_portada)
                        <div class="relative">
                            <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl">
                                <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                                    alt="{{ $negocio->nombre_negocio }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-secondary-500 rounded-2xl shadow-lg flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        @else
                        <div class="relative">
                            <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                <svg class="w-32 h-32 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Secciones de información - Estilo Apple -->
        <div class="space-y-16">
            <!-- Servicios -->
            @if($negocio->serviciosPredefinidos->isNotEmpty() || $negocio->serviciosPersonalizados->isNotEmpty())
            <div class="space-y-8">
                <div class="text-center">
                    <h2 class="text-4xl font-bold text-primary-700 mb-4">Nuestros Servicios</h2>
                    <p class="text-lg text-primary-500 max-w-2xl mx-auto">Descubre todo lo que tenemos para ofrecerte con la mejor calidad y atención</p>
                </div>

                <!-- Servicios predefinidos -->
                @if($negocio->serviciosPredefinidos->isNotEmpty())
                <div class="bg-gradient-to-br from-white to-primary-50/30 rounded-3xl p-8 border border-primary-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-700">Servicios Estándar</h3>
                            <p class="text-primary-500">Servicios que ofrecemos de manera regular</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($negocio->serviciosPredefinidos as $servicio)
                        <div class="group bg-white rounded-2xl p-6 border border-primary-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-primary-700 text-lg mb-2">{{ $servicio->nombre_servicio }}</h4>
                                    @if($servicio->descripcion)
                                    <p class="text-primary-500 text-sm leading-relaxed">{{ $servicio->descripcion }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Servicios personalizados -->
                @if($negocio->serviciosPersonalizados->isNotEmpty())
                <div class="bg-gradient-to-br from-white to-primary-50/30 rounded-3xl p-8 border border-primary-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-700">Servicios Personalizados</h3>
                            <p class="text-primary-500">Servicios adaptados a tus necesidades específicas</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($negocio->serviciosPersonalizados as $servicio)
                        <div class="group bg-white rounded-2xl p-6 border border-primary-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h4 class="font-bold text-primary-700 text-lg">{{ $servicio->nombre_servicio }}</h4>
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $servicio->disponible ? 'bg-secondary-100 text-secondary-600' : 'bg-red-100 text-red-600' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $servicio->disponible ? 'bg-secondary-500' : 'bg-red-500' }}"></span>
                                            {{ $servicio->disponible ? 'Disponible' : 'No disponible' }}
                                        </span>
                                    </div>
                                    @if($servicio->descripcion)
                                    <p class="text-primary-500 text-sm leading-relaxed mb-3">{{ $servicio->descripcion }}</p>
                                    @endif
                                    @if($servicio->precio)
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-bold text-primary-600">S/ {{ number_format($servicio->precio, 2) }}</span>
                                        <span class="text-primary-400 text-sm">Precio</span>
                                    </div>
                                    @endif
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
            @if($negocio->caracteristicas->isNotEmpty())
            <div class="space-y-8">
                <div class="text-center">
                    <h2 class="text-4xl font-bold text-primary-700 mb-4">Lo que ofrecemos</h2>
                    <p class="text-lg text-primary-500 max-w-2xl mx-auto">Características y servicios que nos distinguen</p>
                </div>

                <div class="bg-gradient-to-br from-white to-primary-50/30 rounded-3xl p-8 border border-primary-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($negocio->caracteristicas as $caracteristica)
                        <div class="group bg-white rounded-2xl p-6 border border-primary-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center mb-4 group-hover:from-primary-200 group-hover:to-primary-300 transition-all duration-300">
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-primary-700 text-lg mb-2">{{ $caracteristica->nombre }}</h4>
                                @if($caracteristica->descripcion)
                                <p class="text-primary-500 text-sm leading-relaxed">{{ $caracteristica->descripcion }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Información adicional -->
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Horarios de atención -->
                @if($negocio->horarios->isNotEmpty())
                <div>
                    <h2 class="text-3xl font-bold text-primary-700 mb-6">Horario de atención</h2>
                    <div class="bg-white rounded-2xl p-8 border border-primary-100">
                        <table class="w-full">
                            <tbody class="divide-y divide-primary-100">
                                @foreach($negocio->horarios as $horario)
                                <tr class="border-b border-primary-100">
                                    <td class="py-4 px-0 font-medium text-primary-700 text-sm capitalize">{{ $horario->dia_semana }}</td>
                                    <td class="py-4 px-0 text-sm">
                                        @if($horario->cerrado)
                                        <span class="text-primary-500 font-medium">Cerrado</span>
                                        @else
                                        <span class="text-primary-600">{{ \Carbon\Carbon::parse($horario->hora_apertura)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('H:i') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- Información de contacto -->
                @php $contactos = $negocio->contactos ?? collect(); @endphp
                @if($contactos->isNotEmpty())
                <div>
                    <h2 class="text-3xl font-bold text-primary-700 mb-6">Información de contacto</h2>
                    <div class="bg-white rounded-2xl p-8 border border-primary-100 space-y-6">
                        @if($contactos->where('tipo_contacto', 'telefono')->first())
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                                <x-icons.outline.phone class="w-6 h-6 text-primary-500" />
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Teléfono</p>
                                <p class="text-lg text-primary-700 font-semibold">{{ $contactos->where('tipo_contacto', 'telefono')->first()->valor_contacto }}</p>
                            </div>
                        </div>
                        @endif

                        @if($contactos->where('tipo_contacto', 'whatsapp')->first())
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <x-icons.solid.whatsapp class="w-6 h-6 text-green-500" />
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">WhatsApp</p>
                                <p class="text-lg text-primary-700 font-semibold">{{ $contactos->where('tipo_contacto', 'whatsapp')->first()->valor_contacto }}</p>
                            </div>
                        </div>
                        @endif

                        @if($contactos->where('tipo_contacto', 'facebook')->first())
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <x-icons.solid.facebook class="w-6 h-6 text-blue-500" />
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Facebook</p>
                                <p class="text-lg text-primary-700 font-semibold">{{ $contactos->where('tipo_contacto', 'facebook')->first()->valor_contacto }}</p>
                            </div>
                        </div>
                        @endif

                        @if($contactos->where('tipo_contacto', 'instagram')->first())
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center">
                                <x-icons.solid.instagram class="w-6 h-6 text-pink-500" />
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Instagram</p>
                                <p class="text-lg text-primary-700 font-semibold">{{ $contactos->where('tipo_contacto', 'instagram')->first()->valor_contacto }}</p>
                            </div>
                        </div>
                        @endif

                        @if($contactos->where('tipo_contacto', 'web')->first())
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                                <x-icons.outline.globe class="w-6 h-6 text-primary-500" />
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Sitio web</p>
                                <a href="{{ $contactos->where('tipo_contacto', 'web')->first()->valor_contacto }}" target="_blank" class="text-lg text-primary-700 font-semibold hover:text-secondary-600 transition">
                                    {{ $contactos->where('tipo_contacto', 'web')->first()->valor_contacto }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Botón de regreso -->
        <div class="mt-16 text-center">
            <a href="{{ route('negocios.mis-negocios') }}" class="inline-flex items-center gap-3 px-8 py-3 rounded-full font-semibold border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 hover:border-primary-400 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Volver a mis negocios</span>
            </a>
        </div>
    </div>
</div>
@endsection