@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Editar Categoría de Característica</h1>
                <a href="{{ route('admin.categorias-caracteristica.index') }}"
                    class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form
                    action="{{ route('admin.categorias-caracteristica.update', $categoriaCaracteristica->id_categoria_caracteristica) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="nombre_categoria" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la Categoría *
                        </label>
                        <input type="text" name="nombre_categoria" id="nombre_categoria"
                            value="{{ old('nombre_categoria', $categoriaCaracteristica->nombre_categoria) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('nombre_categoria') border-red-500 @enderror"
                            placeholder="Ej: Servicios Básicos, Accesibilidad, Tecnología" required>
                        @error('nombre_categoria')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('descripcion') border-red-500 @enderror"
                            placeholder="Descripción opcional de la categoría">{{ old('descripcion', $categoriaCaracteristica->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado *
                        </label>
                        <select name="estado" id="estado"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('estado') border-red-500 @enderror"
                            required>
                            <option value="">Seleccionar estado</option>
                            <option value="activo"
                                {{ old('estado', $categoriaCaracteristica->estado) === 'activo' ? 'selected' : '' }}>Activo
                            </option>
                            <option value="inactivo"
                                {{ old('estado', $categoriaCaracteristica->estado) === 'inactivo' ? 'selected' : '' }}>
                                Inactivo</option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.categorias-caracteristica.index') }}"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                            Actualizar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
