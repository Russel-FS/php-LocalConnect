@extends('layouts.app')

@section('title', $promocion->titulo)

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $promocion->titulo }}</h1>
                        <p class="mt-1 text-sm text-gray-500">Detalles de la promoción</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('promociones.edit', $promocion->id_promocion) }}"
                            class="btn-primary flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar
                        </a>
                        <a href="{{ route('promociones.index') }}" class="btn-secondary flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Información principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Información de la Promoción</h3>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if ($promocion->estado === 'vigente') bg-green-100 text-green-800
                                @elseif($promocion->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                @elseif($promocion->estado === 'expirada') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($promocion->estado) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <!-- Título y descuento -->
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $promocion->titulo }}</h2>
                                <div class="flex items-center gap-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        {{ $promocion->descuento }}% de descuento
                                    </span>
                                    @if (!$promocion->activa)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            Inactiva
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="mb-6">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Descripción</h4>
                                <p class="text-gray-600 leading-relaxed">{{ $promocion->descripcion }}</p>
                            </div>

                            <!-- Fechas -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Fecha de Inicio</h4>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-900">{{ $promocion->fecha_inicio->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Fecha de Fin</h4>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-900">{{ $promocion->fecha_fin->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Duración -->
                            <div class="mb-6">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Duración</h4>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span
                                        class="text-gray-900">{{ $promocion->fecha_inicio->diffInDays($promocion->fecha_fin) + 1 }}
                                        días</span>
                                </div>
                            </div>

                            <!-- Estado detallado -->
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Estado Actual</h4>
                                <p class="text-sm text-gray-600">
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

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Información del negocio -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Negocio</h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $promocion->negocio->nombre_negocio }}</h4>
                                    <p class="text-sm text-gray-500">{{ $promocion->negocio->descripcion }}</p>
                                </div>
                            </div>
                            <a href="{{ route('negocios.ver-propio', $promocion->negocio->id_negocio) }}"
                                class="btn-secondary w-full text-center">
                                Ver Negocio
                            </a>
                        </div>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Acciones</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <form action="{{ route('promociones.toggle-status', $promocion->id_promocion) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full btn-{{ $promocion->activa ? 'warning' : 'success' }} text-center">
                                    {{ $promocion->activa ? 'Desactivar Promoción' : 'Activar Promoción' }}
                                </button>
                            </form>

                            <form action="{{ route('promociones.destroy', $promocion->id_promocion) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta promoción? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full btn-danger text-center">
                                    Eliminar Promoción
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
