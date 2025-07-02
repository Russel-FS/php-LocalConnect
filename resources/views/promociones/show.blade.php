@extends('layouts.app')

@section('title', $promocion->titulo)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="bg-white/80 backdrop-blur-sm border-b border-slate-200/60">
            <div class="max-w-6xl mx-auto px-4 sm:px-8 lg:px-12">
                <div class="flex justify-between items-center py-10">
                    <div class="space-y-1">
                        <h1
                            class="text-4xl font-extrabold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent tracking-tight">
                            {{ $promocion->titulo }}
                        </h1>
                        <p class="text-slate-600 font-medium text-lg">Detalles de la promoción</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('promociones.edit', $promocion->id_promocion) }}"
                            class="group inline-flex items-center gap-3 px-7 py-3 border-2 border-primary-300 text-primary-700 font-semibold rounded-2xl hover:border-primary-400 hover:bg-primary-50 hover:text-primary-900 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Editar</span>
                        </a>
                        <a href="{{ route('promociones.index') }}"
                            class="group inline-flex items-center gap-3 px-7 py-3 border-2 border-slate-300 text-slate-600 font-semibold rounded-2xl hover:border-slate-400 hover:bg-slate-50 hover:text-slate-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Volver</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 sm:px-8 lg:px-12 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    <div
                        class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-md border-2 border-white/70 overflow-hidden p-1">
                        <div class="px-12 py-8 border-b border-slate-200/60">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-primary-100 to-secondary-200 rounded-2xl flex items-center justify-center shadow-md">
                                        <x-icons.content.lightning class="w-7 h-7 text-primary-600" />
                                    </div>
                                    <h3 class="text-2xl font-bold text-slate-900">Información de la Promoción</h3>
                                </div>
                                <span
                                    class="inline-flex items-center px-5 py-2 rounded-2xl text-base font-semibold
                                    @if ($promocion->estado === 'vigente') bg-green-100 text-green-800 border-2 border-green-200
                                    @elseif($promocion->estado === 'pendiente') bg-yellow-100 text-yellow-800 border-2 border-yellow-200
                                    @elseif($promocion->estado === 'expirada') bg-red-100 text-red-800 border-2 border-red-200
                                    @else bg-slate-100 text-slate-800 border-2 border-slate-200 @endif">
                                    {{ ucfirst($promocion->estado) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-12">
                            <!-- Título y descuento -->
                            <div class="mb-10">
                                <h2 class="text-3xl font-extrabold text-slate-900 mb-3">{{ $promocion->titulo }}</h2>
                                <div class="flex items-center gap-4">
                                    <span
                                        class="inline-flex items-center px-5 py-2 rounded-2xl text-base font-semibold bg-green-100 text-green-800 border-2 border-green-200 shadow-sm">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        {{ $promocion->descuento }}% de descuento
                                    </span>
                                    @if (!$promocion->activa)
                                        <span
                                            class="inline-flex items-center px-5 py-2 rounded-2xl text-base font-semibold bg-slate-100 text-slate-800 border-2 border-slate-200 shadow-sm">
                                            Inactiva
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Descripción -->
                            <div class="mb-10">
                                <h4 class="text-lg font-semibold text-slate-700 mb-3">Descripción</h4>
                                <p class="text-slate-600 leading-relaxed text-lg">{{ $promocion->descripcion }}</p>
                            </div>
                            <!-- Fechas -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-700 mb-3">Fecha de Inicio</h4>
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span
                                            class="text-slate-900 text-lg">{{ $promocion->fecha_inicio->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-700 mb-3">Fecha de Fin</h4>
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span
                                            class="text-slate-900 text-lg">{{ $promocion->fecha_fin->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Duración -->
                            <div class="mb-10">
                                <h4 class="text-lg font-semibold text-slate-700 mb-3">Duración</h4>
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span
                                        class="text-slate-900 text-lg">{{ $promocion->fecha_inicio->diffInDays($promocion->fecha_fin) + 1 }}
                                        días</span>
                                </div>
                            </div>
                            <!-- Estado detallado -->
                            <div
                                class="bg-gradient-to-r from-slate-50 to-gray-50 border-2 border-slate-200/60 rounded-3xl p-8 shadow-md">
                                <h4 class="text-lg font-semibold text-slate-700 mb-3">Estado Actual</h4>
                                <p class="text-slate-600 font-medium text-lg">
                                    @if ($promocion->estado === 'vigente')
                                        ✅ Esta promoción está actualmente vigente y visible para los clientes.
                                        Se mostrará en la búsqueda de negocios y en el perfil del negocio.
                                    @elseif($promocion->estado === 'pendiente')
                                        ⏳ Esta promoción comenzará el {{ $promocion->fecha_inicio->format('d/m/Y') }}.
                                        Los clientes no podrán verla hasta que esté vigente.
                                    @elseif($promocion->estado === 'expirada')
                                        ❌ Esta promoción expiró el {{ $promocion->fecha_fin->format('d/m/Y') }}.
                                        Ya no es visible para los clientes.
                                    @else
                                        🔒 Esta promoción está inactiva. Los clientes no pueden verla.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-1">
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-md border-2 border-white/60 mb-8">
                        <div class="px-8 py-6 border-b border-slate-200/60">
                            <h3 class="text-lg font-semibold text-slate-900">Negocio</h3>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center shadow">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-lg">
                                        {{ $promocion->negocio->nombre_negocio }}</h4>
                                    <p class="text-sm text-slate-500">{{ $promocion->negocio->descripcion }}</p>
                                </div>
                            </div>
                            <a href="{{ route('negocios.ver-propio', $promocion->negocio->id_negocio) }}"
                                class="group inline-flex items-center gap-3 px-6 py-3 border-2 border-primary-300 text-primary-700 font-semibold rounded-2xl hover:border-primary-400 hover:bg-primary-50 hover:text-primary-900 transition-all duration-300 w-full text-center justify-center shadow">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                <span>Ver Negocio</span>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-md border-2 border-white/60">
                        <div class="px-8 py-6 border-b border-slate-200/60">
                            <h3 class="text-lg font-semibold text-slate-900">Acciones</h3>
                        </div>
                        <div class="p-8 space-y-4">
                            <form action="{{ route('promociones.toggle-status', $promocion->id_promocion) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full group inline-flex items-center gap-3 px-6 py-3 border-2 border-yellow-300 text-yellow-700 font-semibold rounded-2xl hover:border-yellow-400 hover:bg-yellow-50 hover:text-yellow-900 transition-all duration-300 text-center justify-center shadow">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>{{ $promocion->activa ? 'Desactivar Promoción' : 'Activar Promoción' }}</span>
                                </button>
                            </form>
                            <form action="{{ route('promociones.destroy', $promocion->id_promocion) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta promoción? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full group inline-flex items-center gap-3 px-6 py-3 border-2 border-red-300 text-red-700 font-semibold rounded-2xl hover:border-red-400 hover:bg-red-50 hover:text-red-900 transition-all duration-300 text-center justify-center shadow">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Eliminar Promoción</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
