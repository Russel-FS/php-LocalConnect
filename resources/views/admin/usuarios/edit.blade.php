@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Editar Usuario</h1>
                <a href="{{ route('admin.usuarios.index') }}"
                    class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver
                </a>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" value="{{ $usuario->email }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600 cursor-not-allowed"
                            readonly disabled>
                        <p class="mt-1 text-sm text-gray-500">El email no se puede modificar</p>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña
                            (opcional)</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar
                            Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div class="mb-6">
                        <label for="id_rol" class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                        <select name="id_rol" id="id_rol"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('id_rol') border-red-500 @enderror"
                            required>
                            <option value="">Seleccionar rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id_rol }}"
                                    {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                                    {{ $rol->name }}</option>
                            @endforeach
                        </select>
                        @error('id_rol')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                        <select name="estado" id="estado"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('estado') border-red-500 @enderror"
                            required>
                            <option value="">Seleccionar estado</option>
                            <option value="activo" {{ old('estado', $usuario->estado) === 'activo' ? 'selected' : '' }}>
                                Activo</option>
                            <option value="suspendido"
                                {{ old('estado', $usuario->estado) === 'suspendido' ? 'selected' : '' }}>Suspendido
                            </option>
                            <option value="eliminado"
                                {{ old('estado', $usuario->estado) === 'eliminado' ? 'selected' : '' }}>Eliminado</option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.usuarios.index') }}"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">Cancelar</a>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">Actualizar
                            Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
