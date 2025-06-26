@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-14" style="background: var(--color-gray-alt); border-radius: 2rem;">
        <h1 class="text-3xl md:text-4xl font-light text-gray-900 mb-12 text-center tracking-tight">Solicitudes de Negocios
        </h1>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 px-6 py-3 rounded-xl mb-10 shadow-sm text-center text-base font-medium"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse ($negocios as $negocio)
                <div class="card-apple p-6 flex flex-col gap-5 items-start relative fade-in-card group">
                    <div
                        class="w-full aspect-[16/9] overflow-hidden rounded-xl bg-gray-100 flex items-center justify-center mb-2 transition-all duration-300 group-hover:scale-[1.02]">
                        @if ($negocio->imagen_portada)
                            <img src="{{ $negocio->imagen_portada }}" alt="Imagen de {{ $negocio->nombre_negocio }}"
                                class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105">
                        @else
                            <svg class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.84-4.84a2 2 0 012.82 0L16 16m-2-2l1.5-1.5a2 2 0 012.82 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        @endif
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <h2 class="text-lg font-semibold text-gray-900 leading-snug truncate">{{ $negocio->nombre_negocio }}
                        </h2>
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
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
                    <span class="absolute top-5 right-5 px-3 py-1 text-xs font-medium rounded-full border"
                        style="backdrop-filter: blur(2px); background: #fff; color: {{ $negocio->verificado ? 'var(--color-secondary-700)' : '#bfa94a' }}; border-color: {{ $negocio->verificado ? 'var(--color-secondary-400)' : '#f3e8a1' }};">
                        {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                    </span>
                    <div class="flex w-full justify-between items-center pt-3 mt-auto border-t border-gray-100">
                        <a href="{{ route('admin.negocios.show', $negocio) }}"
                            class="text-gray-500 hover:text-gray-900 font-medium text-xs flex items-center gap-1 transition-colors duration-200">
                            Ver detalles
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="1">
                                <button type="submit" class="btn-outline text-xs px-4 py-1">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="0">
                                <button type="submit"
                                    class="btn-outline text-xs px-4 py-1 border-red-200 text-red-500 hover:border-red-400 hover:text-red-700">Rechazar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full card-apple p-12 text-center text-gray-400 text-lg">
                    No hay solicitudes de negocios pendientes.
                </div>
            @endforelse
        </div>
    </div>
@endsection
