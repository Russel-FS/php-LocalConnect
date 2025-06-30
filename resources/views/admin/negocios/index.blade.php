@extends('layouts.app')

@section('content')
    <div class="bg-[#f8fafc] min-h-dvh py-10">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-10 text-center tracking-tight">Todos los Negocios
            </h1>

            <div class="flex justify-end mb-6">
                <form method="GET" class="flex gap-2">
                    <select name="estado" onchange="this.form.submit()"
                        class="rounded-xl border-gray-300 text-sm px-4 py-2 focus:ring-2 focus:ring-primary-200">
                        <option value="">Todos</option>
                        <option value="aprobado" @if (request('estado') === 'aprobado') selected @endif>Aprobados</option>
                        <option value="pendiente" @if (request('estado') === 'pendiente') selected @endif>Pendientes</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-all duration-200">Filtrar</button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b">
                            <th class="py-3 px-2">Nombre</th>
                            <th class="py-3 px-2">Usuario</th>
                            <th class="py-3 px-2">Estado</th>
                            <th class="py-3 px-2">Ubicación</th>
                            <th class="py-3 px-2">Fecha registro</th>
                            <th class="py-3 px-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($negocios as $negocio)
                            <tr class="border-b hover:bg-slate-50 transition-all">
                                <td class="py-3 px-2 font-semibold text-slate-900">{{ $negocio->nombre_negocio }}</td>
                                <td class="py-3 px-2">{{ $negocio->usuario->name ?? '-' }}</td>
                                <td class="py-3 px-2">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $negocio->verificado ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </td>
                                <td class="py-3 px-2 text-slate-500">
                                    @if ($negocio->ubicacion)
                                        {{ $negocio->ubicacion->direccion ?? '' }}
                                        @if ($negocio->ubicacion->ciudad)
                                            , {{ $negocio->ubicacion->ciudad }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-slate-500">
                                    {{ $negocio->created_at ? $negocio->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="py-3 px-2">
                                    <a href="{{ route('admin.negocios.show', $negocio) }}"
                                        class="text-primary-600 hover:underline font-medium">Ver detalles</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400">No hay negocios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $negocios->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
