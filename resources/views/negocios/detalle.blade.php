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
                        <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
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
                        <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.438.995s.145.755.438.995l1.003.827c.48.398.668 1.04.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.217-.456c-.355-.133-.75-.072-1.075.124a6.57 6.57 0 01-.22.127c-.332.183-.582.495-.645.87l-.213 1.281c-.09.543-.56.94-1.11.94h-2.593c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.437-.995s-.145-.755-.437-.995l-1.004-.827a1.125 1.125 0 01-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.075-.124.072-.044.146-.087.22-.127.332-.183.582-.495.645-.87l.213-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
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
                        <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Ubicación
                    </h2>
                    <div class="text-primary-700 font-medium">{{ $negocio->ubicacion->direccion }}</div>
                    @if($negocio->ubicacion->distrito)
                    <div class="text-primary-500 text-sm mt-1">{{ $negocio->ubicacion->distrito }}, {{ $negocio->ubicacion->ciudad }}</div>
                    @endif
                </div>
                @endif

                <!-- Horarios de atención -->
                @if($negocio->horarios->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <h2 class="text-xl font-bold text-primary-700 mb-4 flex items-center gap-3">
                        <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Horarios
                    </h2>
                    <table class="w-full text-sm">
                        <tbody>
                            @foreach($negocio->horarios as $horario)
                            <tr class="border-b border-primary-100 last:border-b-0">
                                <td class="py-2.5 px-1 font-medium text-primary-600 capitalize">{{ $horario->dia_semana }}</td>
                                <td class="py-2.5 px-1 text-right">
                                    @if($horario->cerrado)
                                    <span class="font-medium text-red-500">Cerrado</span>
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

                <!-- Información de contacto -->
                @php $contactos = $negocio->contactos ?? collect(); @endphp
                @if($contactos->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                    <h2 class="text-xl font-bold text-primary-700 mb-4 flex items-center gap-3">
                        <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 6.75z" />
                        </svg>
                        Contacto
                    </h2>
                    <div class="space-y-3">
                        @if($contactos->where('tipo_contacto', 'telefono')->first())
                        <div class="flex items-center gap-3">
                            @include('components.icons.phone', ['class' => 'w-5 h-5 text-primary-500 flex-shrink-0'])
                            <span class="text-primary-700 text-sm">{{ $contactos->where('tipo_contacto', 'telefono')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'whatsapp')->first())
                        <div class="flex items-center gap-3">
                            @include('components.icons.whatsapp', ['class' => 'w-5 h-5 text-secondary-500 flex-shrink-0'])
                            <span class="text-primary-700 text-sm">{{ $contactos->where('tipo_contacto', 'whatsapp')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'facebook')->first())
                        <div class="flex items-center gap-3">
                            @include('components.icons.facebook', ['class' => 'w-5 h-5 text-blue-600 flex-shrink-0'])
                            <span class="text-primary-700 text-sm truncate">{{ $contactos->where('tipo_contacto', 'facebook')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'instagram')->first())
                        <div class="flex items-center gap-3">
                            @include('components.icons.instagram', ['class' => 'w-5 h-5 text-pink-600 flex-shrink-0'])
                            <span class="text-primary-700 text-sm truncate">{{ $contactos->where('tipo_contacto', 'instagram')->first()->valor_contacto }}</span>
                        </div>
                        @endif
                        @if($contactos->where('tipo_contacto', 'web')->first())
                        <div class="flex items-center gap-3">
                            @include('components.icons.globe', ['class' => 'w-5 h-5 text-primary-500 flex-shrink-0'])
                            <a href="{{ $contactos->where('tipo_contacto', 'web')->first()->valor_contacto }}" target="_blank" class="text-primary-600 hover:text-primary-800 text-sm underline truncate">
                                Sitio Web
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