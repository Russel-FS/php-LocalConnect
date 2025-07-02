@extends('layouts.app')

@section('title', 'Editar Promoción')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Editar Promoción</h1>
                        <p class="mt-1 text-sm text-gray-500">Modifica los detalles de tu promoción</p>
                    </div>
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

        <!-- Contenido principal -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Información de la Promoción</h3>
                </div>

                <form action="{{ route('promociones.update', $promocion->id_promocion) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Selección de negocio -->
                    <div class="mb-6">
                        <label for="id_negocio" class="block text-sm font-medium text-gray-700 mb-2">
                            Negocio <span class="text-red-500">*</span>
                        </label>
                        <select name="id_negocio" id="id_negocio"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('id_negocio') border-red-500 @enderror">
                            <option value="">Selecciona un negocio</option>
                            @foreach ($negocios as $negocio)
                                <option value="{{ $negocio->id_negocio }}"
                                    {{ old('id_negocio', $promocion->id_negocio) == $negocio->id_negocio ? 'selected' : '' }}>
                                    {{ $negocio->nombre_negocio }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_negocio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Título -->
                    <div class="mb-6">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
                            Título de la Promoción <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $promocion->titulo) }}"
                            placeholder="Ej: Descuento del 20% en todos los productos"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('titulo') border-red-500 @enderror">
                        @error('titulo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-6">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                            placeholder="Describe los detalles de la promoción, condiciones, productos incluidos, etc."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $promocion->descripcion) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Máximo 500 caracteres</p>
                        @error('descripcion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descuento -->
                    <div class="mb-6">
                        <label for="descuento" class="block text-sm font-medium text-gray-700 mb-2">
                            Porcentaje de Descuento <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="descuento" id="descuento"
                                value="{{ old('descuento', $promocion->descuento) }}" min="0" max="100"
                                step="0.01" placeholder="20"
                                class="w-full px-3 py-2 pr-8 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('descuento') border-red-500 @enderror">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 text-sm">%</span>
                            </div>
                        </div>
                        @error('descuento')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fechas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio"
                                value="{{ old('fecha_inicio', $promocion->fecha_inicio->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('fecha_inicio') border-red-500 @enderror">
                            @error('fecha_inicio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de Fin <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="fecha_fin" id="fecha_fin"
                                value="{{ old('fecha_fin', $promocion->fecha_fin->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('fecha_fin') border-red-500 @enderror">
                            @error('fecha_fin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Estado actual -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">Estado actual</h4>
                                <p class="text-sm text-gray-500">
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

                    <!-- Botones -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('promociones.index') }}" class="btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-primary flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Actualizar Promoción
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

            // Establecer fecha mínima para fecha_fin basada en fecha_inicio
            fechaInicio.addEventListener('change', function() {
                fechaFin.min = this.value;
                if (fechaFin.value && fechaFin.value < this.value) {
                    fechaFin.value = this.value;
                }
            });
        });
    </script>
@endsection
