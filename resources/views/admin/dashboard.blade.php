@extends('layouts.app')

@section('content')
    <div class="bg-[#f8fafc] min-h-dvh py-10">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-10 text-center tracking-tight">Panel de
                Administración</h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
                    <span class="text-3xl font-bold text-primary-700">{{ $totalNegocios }}</span>
                    <span class="text-slate-500 mt-2">Negocios</span>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
                    <span class="text-3xl font-bold text-yellow-600">{{ $negociosPendientes }}</span>
                    <span class="text-slate-500 mt-2">Pendientes</span>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
                    <span class="text-3xl font-bold text-slate-900">{{ $totalUsuarios }}</span>
                    <span class="text-slate-500 mt-2">Usuarios</span>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
                    <span class="text-3xl font-bold text-slate-900">{{ $totalCategorias }}</span>
                    <span class="text-slate-500 mt-2">Categorías</span>
                </div>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-slate-900">Últimas Solicitudes de Negocios</h2>
                <a href="/admin/solicitudes" class="text-primary-600 hover:underline font-medium">Ver todas</a>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b">
                            <th class="py-3 px-2">Nombre</th>
                            <th class="py-3 px-2">Usuario</th>
                            <th class="py-3 px-2">Ubicación</th>
                            <th class="py-3 px-2">Fecha</th>
                            <th class="py-3 px-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasSolicitudes as $negocio)
                            <tr class="border-b hover:bg-slate-50 transition-all">
                                <td class="py-3 px-2 font-semibold text-slate-900">{{ $negocio->nombre_negocio }}</td>
                                <td class="py-3 px-2">{{ $negocio->usuario->name ?? '-' }}</td>
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
                                <td colspan="5" class="py-8 text-center text-slate-400">No hay solicitudes pendientes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex gap-4 mt-10 justify-center">
                <a href="/admin/negocios"
                    class="px-6 py-3 rounded-xl bg-slate-900 text-white font-medium hover:bg-slate-800 transition-all duration-200">Ver
                    todos los Negocios</a>
                <a href="/admin/solicitudes"
                    class="px-6 py-3 rounded-xl bg-primary-600 text-white font-medium hover:bg-primary-700 transition-all duration-200">Ver
                    Solicitudes</a>
            </div>
        </div>
    </div>
@endsection
