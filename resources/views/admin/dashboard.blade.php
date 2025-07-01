@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-primary-50 to-white min-h-dvh py-10">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-10 text-center tracking-tight">Panel de
                Administración</h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div
                    class="bg-white rounded-2xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] p-6 flex flex-col items-center border border-primary-50">
                    <x-icons.outline.folder class="w-8 h-8 text-primary-600 mb-2" />
                    <span class="text-3xl font-bold text-primary-700">{{ $totalNegocios }}</span>
                    <span class="text-primary-500 mt-2 font-medium">Negocios</span>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-[0_4px_24px_0_rgba(180,180,80,0.10)] p-6 flex flex-col items-center border border-yellow-50">
                    <x-icons.outline.check-circle class="w-8 h-8 text-yellow-500 mb-2" />
                    <span class="text-3xl font-bold text-yellow-600">{{ $negociosPendientes }}</span>
                    <span class="text-yellow-600 mt-2 font-medium">Pendientes</span>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] p-6 flex flex-col items-center border border-primary-50">
                    <x-icons.outline.user class="w-8 h-8 text-secondary-600 mb-2" />
                    <span class="text-3xl font-bold text-secondary-700">{{ $totalUsuarios }}</span>
                    <span class="text-secondary-600 mt-2 font-medium">Usuarios</span>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] p-6 flex flex-col items-center border border-primary-50">
                    <x-icons.outline.category class="w-8 h-8 text-primary-400 mb-2" />
                    <span class="text-3xl font-bold text-primary-400">{{ $totalCategorias }}</span>
                    <span class="text-primary-400 mt-2 font-medium">Categorías</span>
                </div>
            </div>
            <!-- Acciones rápidas -->
            <div class="flex flex-wrap gap-4 justify-center mb-12">
                <a href="/admin/negocios"
                    class="px-6 py-3 rounded-xl bg-primary-600 text-white font-semibold shadow hover:bg-primary-700 transition-all duration-200 flex items-center gap-2">
                    <x-icons.outline.folder class="w-5 h-5" /> Negocios
                </a>
                <a href="/admin/solicitudes"
                    class="px-6 py-3 rounded-xl bg-yellow-400 text-yellow-900 font-semibold shadow hover:bg-yellow-500 transition-all duration-200 flex items-center gap-2">
                    <x-icons.outline.check-circle class="w-5 h-5" /> Solicitudes
                </a>
                <a href="#"
                    class="px-6 py-3 rounded-xl bg-secondary-100 text-secondary-700 font-semibold shadow hover:bg-secondary-200 transition-all duration-200 flex items-center gap-2">
                    <x-icons.outline.category class="w-5 h-5" /> Categorías
                </a>
                <a href="#"
                    class="px-6 py-3 rounded-xl bg-primary-100 text-primary-700 font-semibold shadow hover:bg-primary-200 transition-all duration-200 flex items-center gap-2">
                    <x-icons.outline.user class="w-5 h-5" /> Usuarios
                </a>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-slate-900">Últimas Solicitudes de Negocios</h2>
                <a href="/admin/solicitudes" class="text-primary-600 hover:underline font-medium">Ver todas</a>
            </div>
            <div
                class="bg-white rounded-3xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] p-0 overflow-x-auto border border-primary-50">
                <table class="min-w-full text-sm divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-slate-400 uppercase text-xs tracking-wider bg-[#f8fafc]">
                            <th class="py-3 px-2">Nombre</th>
                            <th class="py-3 px-2">Usuario</th>
                            <th class="py-3 px-2">Ubicación</th>
                            <th class="py-3 px-2">Fecha</th>
                            <th class="py-3 px-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasSolicitudes as $negocio)
                            <tr class="border-b last:border-0 hover:bg-primary-50/40 transition-all group">
                                <td
                                    class="py-4 px-2 font-semibold text-slate-900 whitespace-nowrap group-hover:text-primary-700 transition-colors">
                                    {{ $negocio->nombre_negocio }}</td>
                                <td class="py-4 px-2 text-slate-700 whitespace-nowrap">{{ $negocio->usuario->name ?? '-' }}
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
                                <td colspan="5" class="py-8 text-center text-slate-400">No hay solicitudes pendientes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
