@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-primary-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('error'))
        <div class="mb-8 p-4 bg-red-100 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        <!-- Hero Section -->
        <div class="mb-10">
            @if($negocio->imagen_portada)
            <div class="h-80 bg-primary-100 rounded-3xl shadow-lg overflow-hidden mb-6">
                <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                    alt="{{ $negocio->nombre_negocio }}"
                    class="w-full h-full object-cover">
            </div>
            @endif
            <div class="text-center">
                <h1 class="text-5xl font-bold text-primary-800 tracking-tight">{{ $negocio->nombre_negocio }}</h1>
                <p class="mt-3 text-lg text-primary-500 max-w-3xl mx-auto">{{ $negocio->descripcion }}</p>
                <div class="mt-4 flex flex-wrap justify-center gap-2">
                    @foreach($negocio->categorias as $categoria)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-700">
                        {{ $categoria->nombre_categoria }}
                    </span>
                    @endforeach
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold {{ $negocio->verificado ? 'bg-secondary-500/10 text-secondary-600' : 'bg-yellow-500/10 text-yellow-600' }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ $negocio->verificado ? 'bg-secondary-500' : 'bg-yellow-500' }}"></span>
                        {{ $negocio->verificado ? 'Verificado' : 'Pendiente de verificación' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Columna Principal (Servicios) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Servicios predefinidos -->
                @if($negocio->serviciosPredefinidos->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <h2 class="text-xl font-bold text-primary-700 mb-4 flex items-center gap-3">
                        <x-icons.outline.check-circle class="w-6 h-6 text-primary-400" />
                        Servicios Ofrecidos
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($negocio->serviciosPredefinidos as $servicio)
                        <div class="bg-primary-50/70 rounded-xl p-4">
                            <div class="font-semibold text-primary-700">{{ $servicio->nombre_servicio }}</div>
                            @if($servicio->descripcion)
                            <div class="text-primary-500 text-sm mt-1">{{ $servicio->descripcion }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Servicios personalizados -->
                @if($negocio->serviciosPersonalizados->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <h2 class="text-xl font-bold text-primary-700 mb-4 flex items-center gap-3">
                        <x-icons.outline.cog class="w-6 h-6 text-primary-400" />
                        Servicios Personalizados
                    </h2>
                    <div class="space-y-3">
                        @foreach($negocio->serviciosPersonalizados as $servicio)
                        <div class="bg-primary-50/70 rounded-xl p-4 flex justify-between items-center">
                            <div>
                                <div class="font-semibold text-primary-700">{{ $servicio->nombre_servicio }}</div>
                                @if($servicio->descripcion)
                                <div class="text-primary-500 text-sm mt-1">{{ $servicio->descripcion }}</div>
                                @endif
                            </div>
                            @if($servicio->precio)
                            <span class="text-lg font-semibold text-secondary-600 shrink-0 ml-4">S/ {{ number_format($servicio->precio, 2) }}</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Columna informacion -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Ubicación -->
                @if($negocio->ubicacion)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <h2 class="text-xl font-bold text-primary-700 mb-4 flex items-center gap-3">
                        <x-icons.outline.location-marker class="w-6 h-6 text-primary-400" />
                        Ubicación
                    </h2>
                    <div class="text-primary-700 font-medium">{{ $negocio->ubicacion->direccion }}</div>
                    @if($negocio->ubicacion->distrito)
                    <div class="text-primary-500 text-sm mt-1">{{ $negocio->ubicacion->distrito }}, {{ $negocio->ubicacion->ciudad }}</div>
                    @endif
                </div>
                @endif

                <!-- Horarios de atención minimalista -->
                @if($negocio->horarios->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <table class="w-full text-sm">
                        <tbody>
                            @foreach($negocio->horarios as $horario)
                            <tr>
                                <td class="py-2 pr-2 font-medium text-primary-600 capitalize align-top">{{ $horario->dia_semana }}</td>
                                <td class="py-2 pl-2 text-right align-top">
                                    @if($horario->cerrado)
                                    <span class="text-gray-400 font-medium">Cerrado</span>
                                    @else
                                    <span class="font-mono text-primary-500">{{ \Carbon\Carbon::parse($horario->hora_apertura)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('H:i') }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Contactos minimalista -->
                @php $contactos = $negocio->contactos ?? collect(); @endphp
                @if($contactos->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <div class="flex flex-wrap justify-center gap-8">
                        @if($contactos->where('tipo_contacto', 'telefono')->first())
                        <div class="flex flex-col items-center min-w-[90px]">
                            <x-icons.outline.phone class="w-8 h-8 text-primary-500 mb-1" />
                            <span class="text-primary-400 text-xs">{{ $contactos->where('tipo_contacto', 'telefono')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'whatsapp')->first())
                        <div class="flex flex-col items-center min-w-[90px]">
                            <x-icons.solid.whatsapp class="w-8 h-8 text-secondary-500 mb-1" />
                            <span class="text-primary-400 text-xs">{{ $contactos->where('tipo_contacto', 'whatsapp')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'facebook')->first())
                        <div class="flex flex-col items-center min-w-[90px]">
                            <x-icons.solid.facebook class="w-8 h-8 text-blue-600 mb-1" />
                            <span class="text-primary-400 text-xs truncate">{{ $contactos->where('tipo_contacto', 'facebook')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'instagram')->first())
                        <div class="flex flex-col items-center min-w-[90px]">
                            <x-icons.solid.instagram class="w-8 h-8 text-pink-600 mb-1" />
                            <span class="text-primary-400 text-xs truncate">{{ $contactos->where('tipo_contacto', 'instagram')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'web')->first())
                        <div class="flex flex-col items-center min-w-[90px]">
                            <x-icons.outline.globe class="w-8 h-8 text-primary-500 mb-1" />
                            <a href="{{ $contactos->where('tipo_contacto', 'web')->first()->valor_contacto }}" target="_blank" class="text-primary-400 hover:text-primary-600 text-xs underline truncate">
                                Web
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Botón de regreso -->
        <div class="mt-16 text-center">
            <a href="{{ route('negocios.mis-negocios') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-semibold border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 hover:border-primary-400 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Volver a mis negocios</span>
            </a>
        </div>
    </div>
</div>
@endsection