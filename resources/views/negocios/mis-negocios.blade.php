@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-primary-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-bold text-primary-700 tracking-tight">Mis Negocios</h1>
                <p class="mt-2 text-lg text-primary-400">Gestiona y visualiza todos tus negocios registrados.</p>
            </div>
            <a href="{{ route('negocios.registro') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-semibold border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 hover:border-primary-400 transition focus:outline-none focus:ring-2 focus:ring-primary-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="white" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                </svg>
                <span>Nuevo Negocio</span>
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-secondary-100 border border-secondary-200 text-secondary-800 rounded-xl">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        @if($negocios->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl border border-gray-200/80">
            <svg class="mx-auto h-16 w-16 text-primary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h3 class="mt-4 text-xl font-semibold text-primary-700">Aún no tienes negocios</h3>
            <p class="mt-2 text-base text-primary-400">¿Listo para empezar? Registra tu primer negocio para que el mundo lo conozca.</p>
            <div class="mt-8">
                <a href="{{ route('negocios.registro') }}" class="btn-solid px-8 py-3">
                    Registrar mi primer negocio
                </a>
            </div>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($negocios as $negocio)
            <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}" class="group block bg-white rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out">
                <div class="relative">
                    @if($negocio->imagen_portada)
                    <div class="h-48 bg-primary-100 rounded-t-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                            alt="{{ $negocio->nombre_negocio }}"
                            class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="h-48 bg-primary-100 rounded-t-2xl flex items-center justify-center">
                        <svg class="h-12 w-12 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $negocio->verificado ? 'bg-secondary-500/10 text-secondary-600 backdrop-blur-sm' : 'bg-yellow-500/10 text-yellow-600 backdrop-blur-sm' }}">
                            <span class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-secondary-500' : 'bg-yellow-500' }}"></span>
                            {{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-bold text-primary-800 tracking-tight">{{ $negocio->nombre_negocio }}</h3>
                    <p class="text-primary-400 text-sm mt-1 mb-3 h-10 line-clamp-2">{{ $negocio->descripcion }}</p>

                    @if($negocio->ubicacion)
                    <div class="flex items-center text-sm text-primary-500 mb-3">
                        <svg class="w-4 h-4 mr-1.5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="truncate">{{ $negocio->ubicacion->direccion }}</span>
                    </div>
                    @endif

                    @if($negocio->categorias->isNotEmpty())
                    <div class="h-8">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($negocio->categorias->take(2) as $categoria)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700">
                                {{ $categoria->nombre_categoria }}
                            </span>
                            @endforeach
                            @if($negocio->categorias->count() > 2)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700">
                                +{{ $negocio->categorias->count() - 2 }}
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="p-5 pt-0 mt-2 border-t border-primary-100 flex justify-between items-center">
                    <span class="text-sm font-semibold text-secondary-600">
                        Ver detalles
                    </span>
                    <svg class="w-5 h-5 text-secondary-500 transition-transform group-hover:translate-x-1 group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection