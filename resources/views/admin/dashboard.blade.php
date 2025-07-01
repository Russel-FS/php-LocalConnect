@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-primary-50 to-white min-h-dvh py-10">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-12 text-center tracking-tight">Panel de
                Administración</h1>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center mb-2">
                        <x-icons.outline.folder class="w-6 h-6 text-primary-600" />
                    </div>
                    <span class="text-2xl font-bold text-primary-700">{{ $totalNegocios }}</span>
                    <span class="text-primary-400 mt-1 text-xs font-medium">Negocios</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center mb-2">
                        <x-icons.outline.check-circle class="w-6 h-6 text-yellow-500" />
                    </div>
                    <span class="text-2xl font-bold text-yellow-600">{{ $negociosPendientes }}</span>
                    <span class="text-yellow-500 mt-1 text-xs font-medium">Pendientes</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center mb-2">
                        <x-icons.outline.user class="w-6 h-6 text-secondary-600" />
                    </div>
                    <span class="text-2xl font-bold text-secondary-700">{{ $totalUsuarios }}</span>
                    <span class="text-secondary-500 mt-1 text-xs font-medium">Usuarios</span>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center mb-2">
                        <x-icons.outline.category class="w-6 h-6 text-primary-400" />
                    </div>
                    <span class="text-2xl font-bold text-primary-400">{{ $totalCategorias }}</span>
                    <span class="text-primary-400 mt-1 text-xs font-medium">Categorías</span>
                </div>
            </div>
            <!-- Acciones rápidas -->
            <div class="flex flex-wrap gap-2 justify-center mb-10">
                <a href="/admin/negocios"
                    class="group flex flex-col items-center px-4 py-2 rounded-lg hover:bg-primary-50 transition">
                    <x-icons.outline.folder class="w-6 h-6 text-primary-600 group-hover:text-primary-700" />
                    <span class="text-xs text-primary-700 mt-1">Negocios</span>
                </a>
                <a href="/admin/solicitudes"
                    class="group flex flex-col items-center px-4 py-2 rounded-lg hover:bg-yellow-50 transition">
                    <x-icons.outline.check-circle class="w-6 h-6 text-yellow-500 group-hover:text-yellow-600" />
                    <span class="text-xs text-yellow-600 mt-1">Solicitudes</span>
                </a>
                <a href="#"
                    class="group flex flex-col items-center px-4 py-2 rounded-lg hover:bg-secondary-50 transition">
                    <x-icons.outline.category class="w-6 h-6 text-secondary-500 group-hover:text-secondary-600" />
                    <span class="text-xs text-secondary-600 mt-1">Categorías</span>
                </a>
                <a href="#"
                    class="group flex flex-col items-center px-4 py-2 rounded-lg hover:bg-primary-100 transition">
                    <x-icons.outline.user class="w-6 h-6 text-primary-400 group-hover:text-primary-600" />
                    <span class="text-xs text-primary-400 mt-1">Usuarios</span>
                </a>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-slate-900">Últimas Solicitudes de Negocios</h2>
                <a href="/admin/solicitudes" class="text-primary-600 hover:underline font-medium text-sm">Ver todas</a>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-0 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-400 uppercase text-xs tracking-wider bg-white">
                            <th class="py-3 px-2 font-normal">Nombre</th>
                            <th class="py-3 px-2 font-normal">Usuario</th>
                            <th class="py-3 px-2 font-normal">Ubicación</th>
                            <th class="py-3 px-2 font-normal">Fecha</th>
                            <th class="py-3 px-2 font-normal">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasSolicitudes as $negocio)
                            <tr class="border-b last:border-0 hover:bg-primary-50/40 transition-all group">
                                <td
                                    class="py-3 px-2 font-semibold text-slate-900 whitespace-nowrap group-hover:text-primary-700 transition-colors">
                                    {{ $negocio->nombre_negocio }}</td>
                                <td class="py-3 px-2 text-slate-700 whitespace-nowrap">{{ $negocio->usuario->name ?? '-' }}
                                </td>
                                <td class="py-3 px-2 text-slate-500 whitespace-nowrap">
                                    @if ($negocio->ubicacion)
                                        {{ $negocio->ubicacion->direccion ?? '' }}
                                        @if ($negocio->ubicacion->ciudad)
                                            , {{ $negocio->ubicacion->ciudad }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-slate-400 whitespace-nowrap">
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
