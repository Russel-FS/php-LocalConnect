@extends('layouts.app')

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center bg-gradient-to-br from-primary-50 to-white py-12">
        <div class="max-w-2xl w-full mx-auto flex flex-col gap-8">
            <!-- Ficha de usuario -->
            <div class="bg-white rounded-3xl shadow-xl border border-primary-100 p-8 flex flex-col items-center">
                <div
                    class="w-24 h-24 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-4xl mb-4 select-none shadow">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h1 class="text-2xl font-bold text-primary-700 mb-1">{{ $user->name }}</h1>
                <span class="text-sm text-slate-500 mb-1 flex items-center gap-1"><x-icons.form.email
                        class="w-4 h-4" />{{ $user->email }}</span>
                <span
                    class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-secondary-100 text-secondary-600 mb-2">
                    {{ $user->isAdmin() ? 'Admin' : ($user->isNegocio() ? 'Negocio' : 'Usuario') }}
                </span>
                @if ($user->telefono)
                    <span class="text-sm text-primary-500 mb-1 flex items-center gap-1"><x-icons.outline.phone
                            class="w-4 h-4" />{{ $user->telefono }}</span>
                @endif
                <div class="flex gap-3 mt-2">
                    <span class="text-xs text-slate-400">Miembro desde {{ $user->created_at->format('d/m/Y') }}</span>
                    <span
                        class="text-xs {{ $user->estado === 'activo' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($user->estado) }}</span>
                </div>
            </div>
            <!-- Negocios del usuario -->
            <div class="bg-white rounded-3xl shadow-xl border border-primary-100 p-8">
                <h2 class="text-lg font-semibold text-primary-700 mb-6 flex items-center gap-2"><x-icons.outline.folder
                        class="w-5 h-5 text-primary-600" /> Mis negocios</h2>
                @if ($negocios->count())
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($negocios as $negocio)
                            <div
                                class="p-4 rounded-2xl border border-primary-50 bg-primary-50/40 flex flex-col gap-1 shadow-sm">
                                <span
                                    class="font-semibold text-primary-700 text-base flex items-center gap-1"><x-icons.outline.business
                                        class="w-4 h-4 text-secondary-500" />{{ $negocio->nombre_negocio }}</span>
                                <span
                                    class="text-xs text-slate-500 flex items-center gap-1"><x-icons.outline.location-marker
                                        class="w-4 h-4" />{{ $negocio->ubicacion->ciudad ?? 'Sin ciudad' }}</span>
                                <span
                                    class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-secondary-100 text-secondary-600 mt-1">{{ ucfirst($negocio->estado ?? 'pendiente') }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500">No tienes negocios registrados.</p>
                @endif
            </div>
            <!-- Cerrar sesión -->
            <div class="flex justify-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-secondary-500 text-white font-semibold text-base shadow-lg hover:bg-secondary-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-secondary-300 focus:ring-offset-2">
                        <x-icons.actions.logout class="w-6 h-6" />
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
