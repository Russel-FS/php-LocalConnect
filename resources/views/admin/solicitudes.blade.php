@extends('layouts.app')

@section('content')
    <style>
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
    </style>
    <div class="bg-gradient-to-br from-primary-50 to-white min-h-dvh py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 py-6">
            <div class="mb-8 flex items-center gap-2">
                <a href="/admin"
                    class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 text-sm font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Dashboard
                </a>
            </div>
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-10 text-center tracking-tight">Solicitudes de
                Negocios
            </h1>

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 px-6 py-3 rounded-xl mb-10 shadow-sm text-center text-base font-medium"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($negocios as $negocio)
                    <div
                        class="fade-in-card bg-white flex flex-col items-start p-0 rounded-lg overflow-hidden transition-all duration-300 border border-gray-100">
                        <div class="w-full h-36 bg-gray-50 flex items-center justify-center overflow-hidden relative">
                            @if ($negocio->imagen_portada)
                                <img src="{{ $negocio->imagen_portada }}" alt="Imagen de {{ $negocio->nombre_negocio }}"
                                    class="object-cover h-full w-full">
                            @else
                                <svg class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.84-4.84a2 2 0 012.82 0L16 16m-2-2l1.5-1.5a2 2 0 012.82 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            @endif
                            <span
                                class="absolute top-4 right-4 inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold border border-gray-200 bg-white text-gray-700">
                                <span
                                    class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                            </span>
                        </div>
                        <div class="w-full flex flex-col gap-1 px-6 pt-3 pb-4 flex-grow">
                            <h2 class="text-lg font-semibold text-gray-900 leading-snug truncate">
                                {{ $negocio->nombre_negocio }}
                            </h2>
                            <div class="flex items-center gap-2 text-gray-400 text-xs">
                                <x-icons.outline.user class="w-4 h-4" />
                                <span>{{ $negocio->usuario->name }}</span>
                            </div>
                            @if ($negocio->ubicacion)
                                <div class="flex items-center gap-2 text-gray-400 text-xs mt-0.5">
                                    <x-icons.outline.location-marker class="w-4 h-4" />
                                    <span class="truncate">
                                        @if ($negocio->ubicacion->direccion)
                                            {{ $negocio->ubicacion->direccion }}
                                        @endif
                                        @if ($negocio->ubicacion->direccion && $negocio->ubicacion->ciudad)
                                            ,
                                        @endif
                                        @if ($negocio->ubicacion->ciudad)
                                            {{ $negocio->ubicacion->ciudad }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div
                            class="w-full flex justify-between items-center px-6 pb-4 pt-2 mt-auto border-t border-gray-100">
                            <a href="{{ route('admin.negocios.show', $negocio) }}"
                                class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-medium transition-colors text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                                Ver Detalles
                            </a>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="1">
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-green-50 text-green-700 font-semibold hover:bg-green-100 transition-all text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Aprobar
                                    </button>
                                </form>
                                <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="0">
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-50 text-red-700 font-semibold hover:bg-red-100 transition-all text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Rechazar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl p-12 text-center text-gray-400 text-lg">
                        No hay solicitudes de negocios pendientes.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
