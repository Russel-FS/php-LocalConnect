@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Nueva Categoría</h1>
                <a href="{{ route('admin.categorias.index') }}"
                    class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label for="nombre_categoria" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la Categoría *
                        </label>
                        <input type="text" name="nombre_categoria" id="nombre_categoria"
                            value="{{ old('nombre_categoria') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nombre_categoria') border-red-500 @enderror"
                            placeholder="Ej: Restaurantes, Servicios de Salud, Talleres Mecánicos" required>
                        @error('nombre_categoria')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('descripcion') border-red-500 @enderror"
                            placeholder="Descripción opcional de la categoría">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="img_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Imagen de la Categoría
                        </label>
                        <input type="file" name="img_url" id="img_url" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('img_url') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Formatos permitidos: JPEG, PNG, JPG, GIF, WEBP. Máximo 2MB.
                        </p>
                        @error('img_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado *
                        </label>
                        <select name="estado" id="estado"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('estado') border-red-500 @enderror"
                            required>
                            <option value="">Seleccionar estado</option>
                            <option value="activo" {{ old('estado') === 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="suspendido" {{ old('estado') === 'suspendido' ? 'selected' : '' }}>Suspendido
                            </option>
                            <option value="eliminado" {{ old('estado') === 'eliminado' ? 'selected' : '' }}>Eliminado
                            </option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.categorias.index') }}"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Crear Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
