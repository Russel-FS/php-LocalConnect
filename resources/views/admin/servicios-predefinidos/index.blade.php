@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Dashboard
                </a>
                <h1 class="text-2xl font-bold text-primary-800">Servicios Predefinidos</h1>
            </div>
            <a href="{{ route('admin.servicios-predefinidos.create') }}"
                class="px-5 py-2 rounded-full bg-primary-600 text-white font-semibold shadow hover:bg-primary-700 transition-all">Nuevo
                servicio</a>
        </div>
        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 rounded-lg px-4 py-2">{{ session('success') }}</div>
        @endif
        <div class="bg-white rounded-xl shadow p-6">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-400 uppercase text-xs tracking-wider">
                        <th class="py-3 px-2 font-normal">Nombre</th>
                        <th class="py-3 px-2 font-normal">Categoría</th>
                        <th class="py-3 px-2 font-normal">Descripción</th>
                        <th class="py-3 px-2 font-normal">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicios as $servicio)
                        <tr class="border-b last:border-0 hover:bg-primary-50/40 transition-all group">
                            <td class="py-3 px-2 font-semibold text-slate-900 group-hover:text-primary-700">
                                {{ $servicio->nombre_servicio }}</td>
                            <td class="py-3 px-2 text-slate-700">
                                @if ($servicio->categoriaServicio)
                                    <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                        {{ $servicio->categoriaServicio->nombre_categoria_servicio }}
                                    </span>
                                @else
                                    <span class="text-gray-400">Sin categoría</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-slate-700">{{ $servicio->descripcion }}</td>
                            <td class="py-3 px-2 flex gap-2">
                                <a href="{{ route('admin.servicios-predefinidos.edit', $servicio->id_servicio_predefinido) }}"
                                    class="px-3 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-semibold">Editar</a>
                                <form
                                    action="{{ route('admin.servicios-predefinidos.destroy', $servicio->id_servicio_predefinido) }}"
                                    method="POST" onsubmit="return confirm('¿Eliminar este servicio?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200 text-xs font-semibold">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400">No hay servicios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">{{ $servicios->links('vendor.pagination.custom-tailwind') }}</div>
        </div>
    </div>
@endsection
