@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Imagen de portada -->
            @if($negocio->imagen_portada)
            <div class="h-64 bg-gray-200">
                <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                    alt="{{ $negocio->nombre_negocio }}"
                    class="w-full h-full object-cover">
            </div>
            @endif

            <div class="p-8">
                <!-- Header del negocio -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $negocio->nombre_negocio }}</h1>
                        <p class="text-gray-600 mt-2">{{ $negocio->descripcion }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $negocio->verificado ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $negocio->verificado ? 'Verificado' : 'Pendiente de verificación' }}
                    </span>
                </div>

                <!-- Información de ubicación -->
                @if($negocio->ubicacion)
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Ubicación</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-900">{{ $negocio->ubicacion->direccion }}</p>
                                @if($negocio->ubicacion->distrito)
                                <p class="text-sm text-gray-600">{{ $negocio->ubicacion->distrito }}, {{ $negocio->ubicacion->ciudad }}</p>
                                @endif
                                <p class="text-sm text-gray-600">{{ $negocio->ubicacion->pais }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Categorías -->
                @if($negocio->categorias->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Categorías</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($negocio->categorias as $categoria)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                            {{ $categoria->nombre_categoria }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Servicios predefinidos -->
                @if($negocio->serviciosPredefinidos->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Servicios ofrecidos</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($negocio->serviciosPredefinidos as $servicio)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-medium text-gray-900">{{ $servicio->nombre_servicio }}</h3>
                            @if($servicio->descripcion)
                            <p class="text-sm text-gray-600 mt-1">{{ $servicio->descripcion }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Servicios personalizados -->
                @if($negocio->serviciosPersonalizados->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Servicios personalizados</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($negocio->serviciosPersonalizados as $servicio)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $servicio->nombre_servicio }}</h3>
                                    @if($servicio->descripcion)
                                    <p class="text-sm text-gray-600 mt-1">{{ $servicio->descripcion }}</p>
                                    @endif
                                </div>
                                @if($servicio->precio)
                                <span class="text-lg font-semibold text-primary-600">S/ {{ number_format($servicio->precio, 2) }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Horarios de atención -->
                @if($negocio->horarios->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Horarios de atención</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($negocio->horarios as $horario)
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-900 capitalize">{{ $horario->dia_semana }}</span>
                                @if($horario->cerrado)
                                <span class="text-red-600 text-sm">Cerrado</span>
                                @else
                                <span class="text-gray-600 text-sm">{{ $horario->hora_apertura }} - {{ $horario->hora_cierre }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Información de contacto -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Información de contacto</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                        $contactos = $negocio->contactos ?? collect();
                        @endphp

                        @if($contactos->where('tipo', 'telefono')->first())
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $contactos->where('tipo', 'telefono')->first()->valor_contacto }}</span>
                        </div>
                        @endif

                        @if($contactos->where('tipo', 'whatsapp')->first())
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                            </svg>
                            <span class="text-gray-900">{{ $contactos->where('tipo', 'whatsapp')->first()->valor_contacto }}</span>
                        </div>
                        @endif

                        @if($contactos->where('tipo', 'facebook')->first())
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="text-gray-900">{{ $contactos->where('tipo', 'facebook')->first()->valor_contacto }}</span>
                        </div>
                        @endif

                        @if($contactos->where('tipo', 'instagram')->first())
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.928.875 1.418 2.026 1.418 3.323s-.49 2.448-1.418 3.244c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.781c-.49 0-.928-.175-1.297-.49-.368-.315-.49-.753-.49-1.243 0-.49.122-.928.49-1.243.369-.315.807-.49 1.297-.49s.928.175 1.297.49c.368.315.49.753.49 1.243 0 .49-.122.928-.49 1.243-.369.315-.807.49-1.297.49z" />
                            </svg>
                            <span class="text-gray-900">{{ $contactos->where('tipo', 'instagram')->first()->valor_contacto }}</span>
                        </div>
                        @endif

                        @if($contactos->where('tipo', 'web')->first())
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                            </svg>
                            <a href="{{ $contactos->where('tipo', 'web')->first()->valor_contacto }}"
                                target="_blank"
                                class="text-primary-600 hover:text-primary-800">
                                {{ $contactos->where('tipo', 'web')->first()->valor_contacto }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de regreso -->
        <div class="mt-8 text-center">
            <a href="{{ route('negocios.mis-negocios') }}" class="btn-premium-outline">
                ← Volver a mis negocios
            </a>
        </div>
    </div>
</div>
@endsection