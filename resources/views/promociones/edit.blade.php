@extends('layouts.app')

@section('title', 'Editar Promoción')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="bg-white/80 backdrop-blur-sm border-b border-slate-200/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-8">
                    <div class="space-y-1">
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                            Editar Promoción
                        </h1>
                        <p class="text-slate-600 font-medium">Modifica los detalles de tu promoción</p>
                    </div>
                    <a href="{{ route('promociones.index') }}"
                        class="group inline-flex items-center gap-3 px-6 py-3 border-2 border-slate-300 text-slate-600 font-semibold rounded-2xl hover:border-slate-400 hover:bg-slate-50 hover:text-slate-700 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Volver</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-sm border-2 border-white/60">
                <div class="px-8 py-6 border-b border-slate-200/60">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-primary-100 to-secondary-200 rounded-2xl flex items-center justify-center">
                            <x-icons.content.lightning class="w-6 h-6 text-primary-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">Información de la Promoción</h3>
                    </div>
                </div>

                <form action="{{ route('promociones.update', $promocion->id_promocion) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="mb-8">
                        <label for="id_negocio" class="block text-sm font-semibold text-slate-700 mb-3">
                            Negocio <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="id_negocio" id="id_negocio"
                                class="w-full px-4 py-3 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('id_negocio') border-red-500 @enderror">
                                <option value="">Selecciona un negocio</option>
                                @foreach ($negocios as $negocio)
                                    <option value="{{ $negocio->id_negocio }}"
                                        {{ old('id_negocio', $promocion->id_negocio) == $negocio->id_negocio ? 'selected' : '' }}>
                                        {{ $negocio->nombre_negocio }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('id_negocio')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="titulo" class="block text-sm font-semibold text-slate-700 mb-3">
                            Título de la Promoción <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $promocion->titulo) }}"
                            placeholder="Ej: Descuento del 20% en todos los productos"
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('titulo') border-red-500 @enderror">
                        @error('titulo')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-8">
                        <label for="descripcion" class="block text-sm font-semibold text-slate-700 mb-3">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                            placeholder="Describe los detalles de la promoción, condiciones, productos incluidos, etc."
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $promocion->descripcion) }}</textarea>
                        <p class="mt-2 text-sm text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Máximo 500 caracteres
                        </p>
                        @error('descripcion')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="descuento" class="block text-sm font-semibold text-slate-700 mb-3">
                            Porcentaje de Descuento <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="descuento" id="descuento"
                                value="{{ old('descuento', $promocion->descuento) }}" min="0" max="100"
                                step="0.01" placeholder="20"
                                class="w-full px-4 py-3 pr-12 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('descuento') border-red-500 @enderror">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <span class="text-slate-500 font-semibold">%</span>
                            </div>
                        </div>
                        @error('descuento')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label for="fecha_inicio" class="block text-sm font-semibold text-slate-700 mb-3">
                                Fecha de Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio"
                                value="{{ old('fecha_inicio', $promocion->fecha_inicio->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('fecha_inicio') border-red-500 @enderror">
                            @error('fecha_inicio')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="fecha_fin" class="block text-sm font-semibold text-slate-700 mb-3">
                                Fecha de Fin <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="fecha_fin" id="fecha_fin"
                                value="{{ old('fecha_fin', $promocion->fecha_fin->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('fecha_fin') border-red-500 @enderror">
                            @error('fecha_fin')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-r from-slate-50 to-gray-50 border-2 border-slate-200/60 rounded-3xl p-6 mb-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-slate-100 to-gray-200 rounded-2xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900 mb-1">Estado actual</h4>
                                    <p class="text-slate-600 font-medium">
                                        @if ($promocion->estado === 'vigente')
                                            Esta promoción está actualmente vigente y visible para los clientes
                                        @elseif($promocion->estado === 'pendiente')
                                            Esta promoción comenzará el {{ $promocion->fecha_inicio->format('d/m/Y') }}
                                        @elseif($promocion->estado === 'expirada')
                                            Esta promoción expiró el {{ $promocion->fecha_fin->format('d/m/Y') }}
                                        @else
                                            Esta promoción está inactiva
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-semibold
                            @if ($promocion->estado === 'vigente') bg-green-100 text-green-800 border-2 border-green-200
                            @elseif($promocion->estado === 'pendiente') bg-yellow-100 text-yellow-800 border-2 border-yellow-200
                            @elseif($promocion->estado === 'expirada') bg-red-100 text-red-800 border-2 border-red-200
                            @else bg-slate-100 text-slate-800 border-2 border-slate-200 @endif">
                                {{ ucfirst($promocion->estado) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 border-t border-slate-200/60">
                        <a href="{{ route('promociones.index') }}"
                            class="group inline-flex items-center gap-3 px-8 py-3 border-2 border-slate-300 text-slate-600 font-semibold rounded-2xl hover:border-slate-400 hover:bg-slate-50 hover:text-slate-700 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>Cancelar</span>
                        </a>
                        <button type="submit"
                            class="group inline-flex items-center gap-3 px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-semibold rounded-2xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Actualizar Promoción</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');

            fechaInicio.addEventListener('change', function() {
                fechaFin.min = this.value;
                if (fechaFin.value && fechaFin.value < this.value) {
                    fechaFin.value = this.value;
                }
            });

        });
    </script>
@endsection
