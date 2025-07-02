@extends('layouts.app')

@section('title', 'Crear Nueva Promoción')

@section('content')
    <div class="min-h-screen  bg-gradient-to-br from-primary-50 via-primary-50">
        <!-- Header elegante -->
        <div class="bg-white/80 backdrop-blur-sm border-b border-slate-200/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-8">
                    <div class="space-y-1">
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                            Crear Nueva Promoción
                        </h1>
                        <p class="text-slate-600 font-medium">Atrae más clientes con promociones atractivas</p>
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

        <!-- Contenido principal -->
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

                <form action="{{ route('promociones.store') }}" method="POST" class="p-8">
                    @csrf

                    <!-- Selección de negocio -->
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
                                        {{ old('id_negocio') == $negocio->id_negocio ? 'selected' : '' }}>
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

                    <!-- Título -->
                    <div class="mb-8">
                        <label for="titulo" class="block text-sm font-semibold text-slate-700 mb-3">
                            Título de la Promoción <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
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
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
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

                    <!-- Descuento -->
                    <div class="mb-8">
                        <label for="descuento" class="block text-sm font-semibold text-slate-700 mb-3">
                            Porcentaje de Descuento <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="descuento" id="descuento" value="{{ old('descuento') }}"
                                min="0" max="100" step="0.01" placeholder="20"
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

                    <!-- Fechas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label for="fecha_inicio" class="block text-sm font-semibold text-slate-700 mb-3">
                                Fecha de Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio"
                                value="{{ old('fecha_inicio') }}" min="{{ date('Y-m-d') }}"
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
                            <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}"
                                min="{{ date('Y-m-d') }}"
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

                    <!-- Información adicional -->
                    <div
                        class="bg-gradient-to-r from-primary-50 to-secondary-50 border-2 border-primary-200/60 rounded-3xl p-6 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-primary-100 to-secondary-200 rounded-2xl flex items-center justify-center">
                                    <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-slate-900 mb-3">Consejos para una promoción exitosa
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">Usa títulos atractivos y claros</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">Describe bien las condiciones</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">Ofrece descuentos realistas</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">Establece fechas apropiadas</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">Considera promociones por
                                            temporadas</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">Incluye términos y condiciones
                                            claros</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
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
                            <span>Crear Promoción</span>
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

            // Fecha mínima para fecha de fin
            fechaInicio.addEventListener('change', function() {
                fechaFin.min = this.value;
                if (fechaFin.value && fechaFin.value < this.value) {
                    fechaFin.value = this.value;
                }
            });


        });
    </script>
@endsection
