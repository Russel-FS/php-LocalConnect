@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-primary-700">Mis Negocios</h1>
            <p class="mt-2 text-primary-400">Gestiona todos tus negocios registrados</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('negocios.registro') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-white bg-secondary-500 hover:bg-secondary-600 transition shadow">
                <svg class="w-5 h-5 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Registrar nuevo negocio</span>
            </a>
        </div>

        @if($negocios->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes negocios registrados</h3>
            <p class="mt-1 text-sm text-gray-500">Comienza registrando tu primer negocio.</p>
            <div class="mt-6">
                <a href="{{ route('negocios.registro') }}" class="btn-premium">
                    Registrar mi primer negocio
                </a>
            </div>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($negocios as $negocio)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($negocio->imagen_portada)
                <div class="h-48 bg-gray-200">
                    <img src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                        alt="{{ $negocio->nombre_negocio }}"
                        class="w-full h-full object-cover">
                </div>
                @else
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $negocio->nombre_negocio }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $negocio->verificado ? 'bg-secondary-100 text-secondary-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $negocio->descripcion }}</p>

                    @if($negocio->ubicacion)
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $negocio->ubicacion->direccion }}
                    </div>
                    @endif

                    @if($negocio->categorias->isNotEmpty())
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($negocio->categorias->take(3) as $categoria)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                {{ $categoria->nombre_categoria }}
                            </span>
                            @endforeach
                            @if($negocio->categorias->count() > 3)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                +{{ $negocio->categorias->count() - 3 }} más
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <a href="{{ route('negocios.mostrar', $negocio->id_negocio) }}"
                            class="btn-outline text-sm font-medium px-4 py-2">
                            Ver detalles
                        </a>
                        <button class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection