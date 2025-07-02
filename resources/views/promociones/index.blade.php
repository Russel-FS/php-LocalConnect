@extends('layouts.app')

@section('title', 'Mis Promociones')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <!-- Header  -->
        <div class="bg-white/80 backdrop-blur-sm border-b border-slate-200/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-8">
                    <div class="space-y-1">
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                            Mis Promociones
                        </h1>
                        <p class="text-slate-600 font-medium">Gestiona y optimiza las promociones de tus negocios</p>
                    </div>
                    <a href="{{ route('promociones.create') }}"
                        class="group inline-flex items-center gap-3 px-8 py-4 border-2 border-primary-500 text-primary-600 font-semibold rounded-2xl hover:bg-primary-50 hover:border-primary-600 hover:text-primary-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-sm hover:shadow-lg">
                        <x-icons.actions.plus class="w-5 h-5" />
                        <span>Nueva Promoción</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Mensajes de estado -->
            @if (session('success'))
                <div
                    class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200/60 text-green-700 px-6 py-4 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-3">
                        <x-icons.content.check-circle class="w-5 h-5 text-green-600" />
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-8 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200/60 text-red-700 px-6 py-4 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Dashboard de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Total Promociones -->
                <div
                    class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 border-2 border-primary-200/40 hover:border-primary-300/60 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-slate-600">Total Promociones</p>
                            <p class="text-3xl font-bold text-primary-700">{{ $promociones->count() }}</p>
                        </div>
                        <div
                            class="w-12 h-12 border-2 border-primary-300 rounded-2xl flex items-center justify-center group-hover:border-primary-400 group-hover:bg-primary-50 transition-all duration-300">
                            <x-icons.content.lightning class="w-6 h-6 text-primary-600" />
                        </div>
                    </div>
                </div>

                <!-- Vigentes -->
                <div
                    class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 border-2 border-green-200/40 hover:border-green-300/60 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-slate-600">Vigentes</p>
                            <p class="text-3xl font-bold text-green-700">
                                {{ $promociones->where('estado', 'vigente')->count() }}</p>
                        </div>
                        <div
                            class="w-12 h-12 border-2 border-green-300 rounded-2xl flex items-center justify-center group-hover:border-green-400 group-hover:bg-green-50 transition-all duration-300">
                            <x-icons.content.check-circle class="w-6 h-6 text-green-600" />
                        </div>
                    </div>
                </div>

                <!-- Pendientes -->
                <div
                    class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 border-2 border-yellow-200/40 hover:border-yellow-300/60 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-slate-600">Pendientes</p>
                            <p class="text-3xl font-bold text-yellow-700">
                                {{ $promociones->where('estado', 'pendiente')->count() }}</p>
                        </div>
                        <div
                            class="w-12 h-12 border-2 border-yellow-300 rounded-2xl flex items-center justify-center group-hover:border-yellow-400 group-hover:bg-yellow-50 transition-all duration-300">
                            <x-icons.content.clock class="w-6 h-6 text-yellow-600" />
                        </div>
                    </div>
                </div>

                <!-- Expiradas -->
                <div
                    class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 border-2 border-red-200/40 hover:border-red-300/60 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-slate-600">Expiradas</p>
                            <p class="text-3xl font-bold text-red-700">
                                {{ $promociones->where('estado', 'expirada')->count() }}</p>
                        </div>
                        <div
                            class="w-12 h-12 border-2 border-red-300 rounded-2xl flex items-center justify-center group-hover:border-red-400 group-hover:bg-red-50 transition-all duration-300">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de promociones -->
            @if ($promociones->count() > 0)
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl shadow-sm border border-white/60 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-200/60">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-slate-900">Todas las Promociones</h3>
                            <span class="text-sm text-slate-500">{{ $promociones->count() }} promociones</span>
                        </div>
                    </div>
                    <div class="divide-y divide-slate-200/60">
                        @foreach ($promociones as $promocion)
                            <div
                                class="group p-8 hover:bg-gradient-to-r hover:from-primary-50/30 hover:to-secondary-50/30 transition-all duration-300">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 space-y-4">
                                        <!-- Header  -->
                                        <div class="flex items-start gap-4">
                                            <div class="flex-1">
                                                <h4
                                                    class="text-xl font-bold text-slate-900 group-hover:text-primary-700 transition-colors duration-300">
                                                    {{ $promocion->titulo }}
                                                </h4>
                                                <p class="text-slate-600 mt-2 leading-relaxed">{{ $promocion->descripcion }}
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                @if ($promocion->estado === 'vigente') bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200/60
                                                @elseif($promocion->estado === 'pendiente') bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-700 border border-yellow-200/60
                                                @elseif($promocion->estado === 'expirada') bg-gradient-to-r from-red-100 to-pink-100 text-red-700 border border-red-200/60
                                                @else bg-gradient-to-r from-slate-100 to-gray-100 text-slate-700 border border-slate-200/60 @endif">
                                                    {{ ucfirst($promocion->estado) }}
                                                </span>
                                                @if (!$promocion->activa)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-slate-100 to-gray-100 text-slate-700 border border-slate-200/60">
                                                        Inactiva
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Información de la promoción -->
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div
                                                class="flex items-center gap-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-200/40">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-green-100 to-emerald-200 rounded-xl flex items-center justify-center">
                                                    <x-icons.content.lightning class="w-5 h-5 text-green-600" />
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-slate-600">Descuento</p>
                                                    <p class="text-lg font-bold text-green-700">
                                                        {{ $promocion->descuento }}%</p>
                                                </div>
                                            </div>

                                            <div
                                                class="flex items-center gap-3 p-4 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-2xl border border-primary-200/40">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-primary-100 to-secondary-200 rounded-xl flex items-center justify-center">
                                                    <x-icons.outline.business class="w-5 h-5 text-primary-600" />
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-slate-600">Negocio</p>
                                                    <p class="text-lg font-bold text-primary-700">
                                                        {{ $promocion->negocio->nombre_negocio }}</p>
                                                </div>
                                            </div>

                                            <div
                                                class="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200/40">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-100 to-indigo-200 rounded-xl flex items-center justify-center">
                                                    <x-icons.content.clock class="w-5 h-5 text-blue-600" />
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-slate-600">Vigencia</p>
                                                    <p class="text-sm font-bold text-blue-700">
                                                        {{ $promocion->fecha_inicio->format('d/m/Y') }} -
                                                        {{ $promocion->fecha_fin->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Acciones -->
                                    <div class="flex flex-col gap-3 ml-6">
                                        <a href="{{ route('promociones.show', $promocion->id_promocion) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 border-2 border-slate-300 text-slate-700 rounded-xl font-medium hover:border-slate-400 hover:bg-slate-50 transition-all duration-200">
                                            <x-icons.outline.eye class="w-4 h-4" />
                                            Ver
                                        </a>
                                        <a href="{{ route('promociones.edit', $promocion->id_promocion) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 border-2 border-primary-500 text-primary-600 rounded-xl font-medium hover:border-primary-600 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Editar
                                        </a>
                                        <form action="{{ route('promociones.toggle-status', $promocion->id_promocion) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="w-full inline-flex items-center gap-2 px-4 py-2 border-2 rounded-xl font-medium transition-all duration-200
                                            @if ($promocion->activa) border-yellow-500 text-yellow-600 hover:border-yellow-600 hover:bg-yellow-50 hover:text-yellow-700
                                            @else 
                                                border-green-500 text-green-600 hover:border-green-600 hover:bg-green-50 hover:text-green-700 @endif">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                {{ $promocion->activa ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('promociones.destroy', $promocion->id_promocion) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta promoción?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full inline-flex items-center gap-2 px-4 py-2 border-2 border-red-500 text-red-600 rounded-xl font-medium hover:border-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
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
                <!-- vacio-->
                <div class="text-center py-16">
                    <div class="relative mx-auto w-32 h-32 mb-8">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-full opacity-60 animate-pulse">
                        </div>
                        <div
                            class="relative w-full h-full bg-gradient-to-br from-primary-200 to-secondary-200 rounded-full flex items-center justify-center">
                            <x-icons.content.lightning class="w-16 h-16 text-primary-600" />
                        </div>
                    </div>
                    <div class="space-y-4 max-w-md mx-auto">
                        <h3 class="text-2xl font-bold text-slate-900">No tienes promociones</h3>
                        <p class="text-slate-600 leading-relaxed">Comienza creando tu primera promoción para atraer más
                            clientes y aumentar las ventas de tus negocios.</p>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('promociones.create') }}"
                            class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary-500 to-secondary-500 text-white font-semibold rounded-2xl shadow-lg shadow-primary-200/50 hover:shadow-xl hover:shadow-primary-300/50 transition-all duration-300 transform hover:-translate-y-1">
                            <x-icons.actions.plus class="w-6 h-6" />
                            <span>Crear Primera Promoción</span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
