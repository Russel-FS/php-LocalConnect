@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-primary-50 to-white min-h-dvh py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <div class="mb-8 flex items-center gap-2">
                <a href="/admin"
                    class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 text-sm font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Dashboard
                </a>
            </div>
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-12 text-center tracking-tight">Todos los Negocios
            </h1>
            <div class="flex justify-end mb-8">
                <form method="GET" class="flex gap-2">
                    <select name="estado" onchange="this.form.submit()"
                        class="rounded-lg border border-gray-200 text-sm px-4 py-2 focus:ring-2 focus:ring-primary-100 bg-white">
                        <option value="">Todos</option>
                        <option value="aprobado" @if (request('estado') === 'aprobado') selected @endif>Aprobados</option>
                        <option value="pendiente" @if (request('estado') === 'pendiente') selected @endif>Pendientes</option>
                    </select>

                </form>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-0 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-400 uppercase text-xs tracking-wider bg-white">
                            <th class="py-3 px-2 font-normal">Nombre</th>
                            <th class="py-3 px-2 font-normal">Usuario</th>
                            <th class="py-3 px-2 font-normal">Estado</th>
                            <th class="py-3 px-2 font-normal">Ubicación</th>
                            <th class="py-3 px-2 font-normal">Fecha registro</th>
                            <th class="py-3 px-2 font-normal">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($negocios as $negocio)
                            <tr class="border-b border-gray-100 last:border-0 hover:bg-primary-50/20 transition-all group">
                                <td
                                    class="py-3 px-2 font-semibold text-gray-900 whitespace-nowrap group-hover:text-primary-700 transition-colors">
                                    {{ $negocio->nombre_negocio }}</td>
                                <td class="py-3 px-2 text-gray-700 whitespace-nowrap">{{ $negocio->usuario->name ?? '-' }}
                                </td>
                                <td class="py-3 px-2">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold border border-gray-200 bg-white text-gray-700">
                                        <span
                                            class="w-2 h-2 rounded-full {{ $negocio->verificado ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                        {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </td>
                                <td class="py-3 px-2 text-gray-500 whitespace-nowrap">
                                    @if ($negocio->ubicacion)
                                        {{ $negocio->ubicacion->direccion ?? '' }}
                                        @if ($negocio->ubicacion->ciudad)
                                            , {{ $negocio->ubicacion->ciudad }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-gray-400 whitespace-nowrap">
                                    {{ $negocio->created_at ? $negocio->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="py-3 px-2 whitespace-nowrap">
                                    <a href="{{ route('admin.negocios.show', $negocio) }}"
                                        class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-medium transition-colors text-xs">
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
                                <td colspan="6" class="py-8 text-center text-gray-400">No hay negocios registrados.</td>
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
