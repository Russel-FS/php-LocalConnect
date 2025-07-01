@extends('layouts.app')

@section('content')
    <div class="bg-[#f8fafc] min-h-dvh py-10">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-10 text-center tracking-tight">Todos los Negocios
            </h1>

            <div class="flex justify-end mb-6">
                <form method="GET" class="flex gap-2">
                    <select name="estado" onchange="this.form.submit()"
                        class="rounded-xl border-gray-200 text-sm px-4 py-2 focus:ring-2 focus:ring-primary-200 bg-white shadow-sm">
                        <option value="">Todos</option>
                        <option value="aprobado" @if (request('estado') === 'aprobado') selected @endif>Aprobados</option>
                        <option value="pendiente" @if (request('estado') === 'pendiente') selected @endif>Pendientes</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-all duration-200 shadow-sm">Filtrar</button>
                </form>
            </div>

            <div
                class="bg-white rounded-3xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] p-0 overflow-x-auto border border-primary-50">
                <table class="min-w-full text-sm divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-slate-400 uppercase text-xs tracking-wider bg-[#f8fafc]">
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
                            <tr class="border-b last:border-0 hover:bg-primary-50/40 transition-all group">
                                <td
                                    class="py-4 px-2 font-semibold text-slate-900 whitespace-nowrap group-hover:text-primary-700 transition-colors">
                                    {{ $negocio->nombre_negocio }}</td>
                                <td class="py-4 px-2 text-slate-700 whitespace-nowrap">{{ $negocio->usuario->name ?? '-' }}
                                </td>
                                <td class="py-4 px-2">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold border
                                        {{ $negocio->verificado ? 'bg-green-50 text-green-700 border-green-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200' }}">
                                        <span
                                            class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                        {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </td>
                                <td class="py-4 px-2 text-slate-500 whitespace-nowrap">
                                    @if ($negocio->ubicacion)
                                        {{ $negocio->ubicacion->direccion ?? '' }}
                                        @if ($negocio->ubicacion->ciudad)
                                            , {{ $negocio->ubicacion->ciudad }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-4 px-2 text-slate-400 whitespace-nowrap">
                                    {{ $negocio->created_at ? $negocio->created_at->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="py-4 px-2 whitespace-nowrap">
                                    <a href="{{ route('admin.negocios.show', $negocio) }}"
                                        class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                                        </svg>
                                        Ver detalles
                                    </a>
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
