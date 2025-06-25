@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <form method="POST" action="{{ route('negocios.actualizar', $negocio->id_negocio) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-bold text-primary-700 tracking-tight">Editar Negocio</h1>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary-600 text-white font-semibold shadow-lg hover:bg-primary-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar Cambios
                </button>
            </div>

            <div class="space-y-12">
                <!-- Sección de Información Básica -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Información Básica</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del negocio</label>
                            <input type="text" name="nombre_negocio" value="{{ old('nombre_negocio', $negocio->nombre_negocio) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea name="descripcion" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">{{ old('descripcion', $negocio->descripcion) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de portada</label>
                            @if($negocio->imagen_portada)
                            <img src="{{ asset('storage/' . $negocio->imagen_portada) }}" alt="Portada actual" class="w-48 h-32 object-cover rounded-lg mb-4 shadow-md">
                            @endif
                            <input type="file" name="imagen_portada" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" />
                        </div>
                    </div>
                </div>

                <!-- Sección de Ubicación con Mapa -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Ubicación</h2>
                    <div class="space-y-6">
                        @include('components.common.mapa')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                                <input id="direccion" type="text" name="direccion" value="{{ old('direccion', $negocio->ubicacion->direccion ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                                <input id="distrito" type="text" name="distrito" value="{{ old('distrito', $negocio->ubicacion->distrito ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                                <input id="ciudad" type="text" name="ciudad" value="{{ old('ciudad', $negocio->ubicacion->ciudad ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                                <input id="provincia" type="text" name="provincia" value="{{ old('provincia', $negocio->ubicacion->provincia ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div class="hidden">
                                <input id="latitud" type="text" name="latitud" value="{{ old('latitud', $negocio->ubicacion->latitud ?? '') }}">
                                <input id="longitud" type="text" name="longitud" value="{{ old('longitud', $negocio->ubicacion->longitud ?? '') }}">
                                <input id="pais" type="text" name="pais" value="{{ old('pais', $negocio->ubicacion->pais ?? 'Perú') }}">
                                <input id="departamento" type="text" name="departamento" value="{{ old('departamento', $negocio->ubicacion->departamento ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de Categorías -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Categorías</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($categorias as $categoria)
                        <label class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 bg-white text-gray-700 cursor-pointer has-[:checked]:bg-primary-100 has-[:checked]:border-primary-300 transition-all">
                            <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}" class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500" {{ in_array($categoria->id_categoria, old('categorias', $negocio->categorias->pluck('id_categoria')->toArray())) ? 'checked' : '' }}>
                            <span class="font-medium">{{ $categoria->nombre_categoria }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Sección de Características -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Características</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($caracteristicas as $caracteristica)
                        <label class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 bg-white text-gray-700 cursor-pointer has-[:checked]:bg-primary-100 has-[:checked]:border-primary-300 transition-all">
                            <input type="checkbox" name="caracteristicas[]" value="{{ $caracteristica->id_caracteristica }}" class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500" {{ in_array($caracteristica->id_caracteristica, old('caracteristicas', $negocio->caracteristicas->pluck('id_caracteristica')->toArray())) ? 'checked' : '' }}>
                            <span class="font-medium">{{ $caracteristica->nombre }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection