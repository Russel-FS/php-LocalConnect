@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-light text-gray-800 mb-8">Editar información de mi negocio</h1>
    <form method="POST" action="{{ route('negocios.actualizar', $negocio->id_negocio) }}" enctype="multipart/form-data" class="space-y-8 bg-white p-8 rounded-2xl shadow">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del negocio</label>
            <input type="text" name="nombre_negocio" value="{{ old('nombre_negocio', $negocio->nombre_negocio) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none" required>
        </div>

        <!-- Descripción -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">{{ old('descripcion', $negocio->descripcion) }}</textarea>
        </div>

        <!-- Imagen de portada -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de portada</label>
            @if($negocio->imagen_portada)
            <img src="{{ asset('storage/' . $negocio->imagen_portada) }}" alt="Portada actual" class="w-32 h-20 object-cover rounded mb-2">
            @endif
            <input type="file" name="imagen_portada" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" />
        </div>

        <!-- Ubicación -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $negocio->ubicacion->direccion ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                <input type="text" name="distrito" value="{{ old('distrito', $negocio->ubicacion->distrito ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                <input type="text" name="ciudad" value="{{ old('ciudad', $negocio->ubicacion->ciudad ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                <input type="text" name="provincia" value="{{ old('provincia', $negocio->ubicacion->provincia ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Departamento</label>
                <input type="text" name="departamento" value="{{ old('departamento', $negocio->ubicacion->departamento ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">País</label>
                <input type="text" name="pais" value="{{ old('pais', $negocio->ubicacion->pais ?? 'Perú') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Latitud</label>
                <input type="text" name="latitud" value="{{ old('latitud', $negocio->ubicacion->latitud ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Longitud</label>
                <input type="text" name="longitud" value="{{ old('longitud', $negocio->ubicacion->longitud ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
            </div>
        </div>

        <!-- Categorías -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Categorías</label>
            <div class="flex flex-wrap gap-3">
                @foreach($categorias as $categoria)
                <label class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-200 bg-gray-50 text-gray-700 cursor-pointer">
                    <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}" {{ in_array($categoria->id_categoria, old('categorias', $negocio->categorias->pluck('id_categoria')->toArray())) ? 'checked' : '' }}>
                    <span>{{ $categoria->nombre_categoria }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Características -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Características</label>
            <div class="flex flex-wrap gap-3">
                @foreach($caracteristicas as $caracteristica)
                <label class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-200 bg-gray-50 text-gray-700 cursor-pointer">
                    <input type="checkbox" name="caracteristicas[]" value="{{ $caracteristica->id_caracteristica }}" {{ in_array($caracteristica->id_caracteristica, old('caracteristicas', $negocio->caracteristicas->pluck('id_caracteristica')->toArray())) ? 'checked' : '' }}>
                    <span>{{ $caracteristica->nombre }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full py-3 rounded-full bg-primary-700 text-white font-semibold text-lg shadow hover:bg-primary-800 transition">Guardar cambios</button>
        </div>
    </form>
</div>
@endsection