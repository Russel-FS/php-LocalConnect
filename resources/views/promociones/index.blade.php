@extends('layouts.app')

@section('title', 'Mis Promociones')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Mis Promociones</h1>
                        <p class="mt-1 text-sm text-gray-500">Gestiona las promociones de tus negocios</p>
                    </div>
                    <a href="{{ route('promociones.create') }}" class="btn-primary flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Nueva Promoción
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Estadísticas rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Promociones</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $promociones->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Vigentes</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $promociones->where('estado', 'vigente')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Pendientes</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $promociones->where('estado', 'pendiente')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Expiradas</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $promociones->where('estado', 'expirada')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de promociones -->
            @if ($promociones->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Todas las Promociones</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach ($promociones as $promocion)
                            <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $promocion->titulo }}</h4>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if ($promocion->estado === 'vigente') bg-green-100 text-green-800
                                            @elseif($promocion->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                            @elseif($promocion->estado === 'expirada') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($promocion->estado) }}
                                            </span>
                                            @if (!$promocion->activa)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Inactiva
                                                </span>
                                            @endif
                                        </div>

                                        <p class="text-gray-600 mb-3">{{ $promocion->descripcion }}</p>

                                        <div class="flex items-center gap-6 text-sm text-gray-500">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                                <span class="font-medium text-green-600">{{ $promocion->descuento }}% de
                                                    descuento</span>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <span>{{ $promocion->negocio->nombre_negocio }}</span>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $promocion->fecha_inicio->format('d/m/Y') }} -
                                                    {{ $promocion->fecha_fin->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 ml-4">
                                        <a href="{{ route('promociones.show', $promocion->id_promocion) }}"
                                            class="btn-secondary text-sm">
                                            Ver
                                        </a>
                                        <a href="{{ route('promociones.edit', $promocion->id_promocion) }}"
                                            class="btn-primary text-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('promociones.toggle-status', $promocion->id_promocion) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="btn-{{ $promocion->activa ? 'warning' : 'success' }} text-sm">
                                                {{ $promocion->activa ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('promociones.destroy', $promocion->id_promocion) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta promoción?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger text-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No tienes promociones</h3>
                    <p class="text-gray-500 mb-6">Comienza creando tu primera promoción para atraer más clientes a tus
                        negocios.</p>
                    <a href="{{ route('promociones.create') }}" class="btn-primary">
                        Crear Primera Promoción
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
