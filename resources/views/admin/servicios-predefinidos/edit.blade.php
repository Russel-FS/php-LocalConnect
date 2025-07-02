@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto py-10">
        <h1 class="text-2xl font-bold text-primary-800 mb-6">Editar Servicio Predefinido</h1>
        <form action="{{ route('admin.servicios-predefinidos.update', $servicio->id_servicio_predefinido) }}" method="POST"
            class="bg-white rounded-xl shadow p-6 space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Categoría de Servicio *</label>
                <select name="id_categoria_servicio" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categoriasServicio as $categoria)
                        <option value="{{ $categoria->id_categoria_servicio }}"
                            {{ old('id_categoria_servicio', $servicio->id_categoria_servicio) == $categoria->id_categoria_servicio ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria_servicio }}
                        </option>
                    @endforeach
                </select>
                @error('id_categoria_servicio')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nombre del servicio</label>
                <input type="text" name="nombre_servicio" class="w-full border rounded-lg px-4 py-2" required
                    maxlength="100" value="{{ old('nombre_servicio', $servicio->nombre_servicio) }}">
                @error('nombre_servicio')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded-lg px-4 py-2" maxlength="255">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.servicios-predefinidos.index') }}"
                    class="px-4 py-2 rounded bg-gray-100 text-gray-700 hover:bg-gray-200">Cancelar</a>
                <button type="submit"
                    class="px-6 py-2 rounded bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
