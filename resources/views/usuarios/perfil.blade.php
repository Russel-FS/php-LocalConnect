@extends('layouts.app')

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center bg-gradient-to-br from-primary-50 to-white py-12">
        <div class="max-w-2xl w-full mx-auto flex flex-col gap-8">
            <!-- Header -->
            <div
                class="bg-white rounded-3xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] border border-primary-100 p-8 flex flex-col sm:flex-row items-center gap-6 mb-4">
                <div
                    class="w-28 h-28 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-5xl select-none shadow">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 flex flex-col items-center sm:items-start gap-1">
                    <h1 class="text-2xl font-bold text-primary-700 mb-1">{{ $user->name }}</h1>
                    <span class="text-sm text-slate-500 flex items-center gap-1"><x-icons.form.email
                            class="w-4 h-4" />{{ $user->email }}</span>
                    @if ($user->telefono)
                        <span class="text-sm text-primary-500 flex items-center gap-1"><x-icons.outline.phone
                                class="w-4 h-4" />{{ $user->telefono }}</span>
                    @endif
                    <span
                        class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-secondary-100 text-secondary-600 mt-2">
                        {{ $user->isAdmin() ? 'Admin' : ($user->isNegocio() ? 'Negocio' : 'Usuario') }}
                    </span>
                    <div class="flex gap-3 mt-2">
                        <span class="text-xs text-slate-400">Miembro desde {{ $user->created_at->format('d/m/Y') }}</span>
                        <span
                            class="text-xs {{ $user->estado === 'activo' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($user->estado) }}</span>
                    </div>
                </div>
            </div>

            <!-- Tabs de contenido -->
            <div x-data="{ tab: 'negocios' }"
                class="bg-white rounded-3xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] border border-primary-100 p-0">
                <!-- Tabs -->
                <div class="flex border-b border-primary-100">
                    <button @click="tab = 'negocios'"
                        :class="tab === 'negocios' ? 'border-primary-500 text-primary-700' : 'border-transparent text-slate-400'"
                        class="flex-1 py-3 text-center font-semibold border-b-2 transition-colors">Mis negocios</button>
                    <button @click="tab = 'favoritos'"
                        :class="tab === 'favoritos' ? 'border-primary-500 text-primary-700' :
                            'border-transparent text-slate-400'"
                        class="flex-1 py-3 text-center font-semibold border-b-2 transition-colors">Favoritos</button>
                    <button @click="tab = 'megusta'"
                        :class="tab === 'megusta' ? 'border-primary-500 text-primary-700' : 'border-transparent text-slate-400'"
                        class="flex-1 py-3 text-center font-semibold border-b-2 transition-colors">Me gusta</button>
                </div>
                <!-- Contenido de cada tab -->
                <div class="p-8">
                    <!-- Mis negocios -->
                    <div x-show="tab === 'negocios'">
                        <h2 class="text-lg font-semibold text-primary-700 mb-6 flex items-center gap-2">
                            <x-icons.outline.folder class="w-5 h-5 text-primary-600" /> Mis negocios
                        </h2>
                        @if ($negocios->count())
                            <div class="grid gap-4 sm:grid-cols-2">
                                @foreach ($negocios as $negocio)
                                    <div
                                        class="p-4 rounded-2xl border border-primary-50 bg-primary-50/60 flex flex-col gap-1 shadow-[0_2px_8px_0_rgba(180,180,200,0.08)]">
                                        <span
                                            class="font-semibold text-primary-700 text-base flex items-center gap-1"><x-icons.outline.business
                                                class="w-4 h-4 text-secondary-500" />{{ $negocio->nombre_negocio }}</span>
                                        <span
                                            class="text-xs text-slate-500 flex items-center gap-1"><x-icons.outline.location-marker
                                                class="w-4 h-4" />{{ $negocio->ubicacion->ciudad ?? 'Sin ciudad' }}</span>
                                        <span
                                            class="inline-block px-2 py-0.5 rounded-full text-xs font-medium mt-1 {{ $negocio->verificado ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-yellow-100 text-yellow-700 border border-yellow-200' }}">
                                            {{ $negocio->verificado ? 'Verificado' : 'Pendiente' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-slate-500">No tienes negocios registrados.</p>
                        @endif
                    </div>
                    <!-- Favoritos -->
                    <div x-show="tab === 'favoritos'">
                        <h2 class="text-lg font-semibold text-primary-700 mb-6 flex items-center gap-2">
                            <x-icons.outline.star class="w-5 h-5 text-yellow-500" /> Favoritos
                        </h2>
                        {{-- Aquí muestra los favoritos del usuario --}}
                        <p class="text-sm text-slate-500">No tienes favoritos guardados.</p>
                    </div>
                    <!-- Me gusta -->
                    <div x-show="tab === 'megusta'">
                        <h2 class="text-lg font-semibold text-primary-700 mb-6 flex items-center gap-2"><x-icons.solid.star
                                class="w-5 h-5 text-red-500" /> Me gusta</h2>
                        {{-- Aquí muestra los negocios a los que el usuario ha dado me gusta --}}
                        <p class="text-sm text-slate-500">No tienes negocios marcados con me gusta.</p>
                    </div>
                </div>
            </div>

            <!-- Cerrar sesión -->
            <div class="flex justify-center mt-4">
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
