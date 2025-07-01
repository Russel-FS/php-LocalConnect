@extends('layouts.app')

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center bg-gradient-to-br from-primary-50 to-white py-12">
        <div class="max-w-5xl w-full mx-auto flex flex-col gap-8">
            <!-- Header -->
            <div
                class="bg-white rounded-3xl shadow-[0_4px_24px_0_rgba(80,80,120,0.10)] border border-primary-100 p-8 flex flex-col sm:flex-row items-center gap-8 mb-2">
                <div
                    class="w-32 h-32 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-6xl select-none shadow">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 flex flex-col items-center sm:items-start gap-2">
                    <h1 class="text-3xl font-bold text-primary-700">{{ $user->name }}</h1>
                    <span class="text-base text-slate-500 flex items-center gap-1"><x-icons.form.email
                            class="w-5 h-5" />{{ $user->email }}</span>
                    @if ($user->telefono)
                        <span class="text-base text-primary-500 flex items-center gap-1"><x-icons.outline.phone
                                class="w-5 h-5" />{{ $user->telefono }}</span>
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
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('perfil.editar') }}"
                            class="text-xs px-4 py-2 rounded-full bg-primary-50 text-primary-700 border border-primary-100 hover:bg-primary-100 transition">Editar
                            perfil</a>
                        <a href="{{ route('perfil.password') }}"
                            class="text-xs px-4 py-2 rounded-full bg-secondary-50 text-secondary-700 border border-secondary-100 hover:bg-secondary-100 transition">Cambiar
                            contraseña</a>
                    </div>
                </div>
            </div>

            <!-- Grid de secciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Información personal -->
                <div
                    class="bg-white rounded-2xl shadow border border-primary-100 p-6 flex flex-col gap-4 min-h-[220px] justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-primary-700 mb-2 flex items-center gap-2">
                            <x-icons.outline.user class="w-5 h-5 text-primary-600" /> Información personal
                        </h2>
                        <div class="flex flex-col gap-1 text-sm text-slate-600">
                            <div><b>Nombre:</b> {{ $user->name }}</div>
                            <div><b>Email:</b> {{ $user->email }}</div>
                            <div><b>Teléfono:</b> {{ $user->telefono ?? 'No registrado' }}</div>
                            <div><b>Rol:</b>
                                {{ $user->isAdmin() ? 'Admin' : ($user->isNegocio() ? 'Negocio' : 'Usuario') }}</div>
                            <div><b>Estado:</b> <span
                                    class="{{ $user->estado === 'activo' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($user->estado) }}</span>
                            </div>
                            <div><b>Miembro desde:</b> {{ $user->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
                <!-- Mis negocios -->
                <div
                    class="bg-white rounded-2xl shadow border border-primary-100 p-6 flex flex-col gap-4 min-h-[220px] justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-primary-700 flex items-center gap-2">
                            <x-icons.outline.folder class="w-5 h-5 text-primary-600" /> Mis negocios
                        </h2>
                        <span
                            class="inline-block bg-primary-100 text-primary-700 text-xs font-bold px-3 py-1 rounded-full">{{ $negocios->count() }}</span>
                    </div>
                    @if ($negocios->count())
                        <div class="grid gap-4 sm:grid-cols-1">
                            @foreach ($negocios as $negocio)
                                <div
                                    class="p-3 rounded-xl border border-primary-50 bg-primary-50/60 flex flex-col gap-1 shadow-sm">
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
                <div
                    class="bg-white rounded-2xl shadow border border-primary-100 p-6 flex flex-col gap-4 min-h-[220px] justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-primary-700 flex items-center gap-2">
                            <x-icons.outline.star class="w-5 h-5 text-yellow-500" /> Favoritos
                        </h2>
                        <span
                            class="inline-block bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">{{ $favoritos->count() }}</span>
                    </div>
                    @if ($favoritos->count())
                        <div class="flex flex-col gap-2">
                            @foreach ($favoritos as $fav)
                                @if ($fav->negocio)
                                    <a href="{{ route('negocios.mostrar', $fav->negocio->id_negocio) }}"
                                        class="group flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-yellow-50 transition cursor-pointer border border-transparent hover:border-yellow-200">
                                        <x-icons.outline.business
                                            class="w-5 h-5 text-yellow-400 group-hover:text-yellow-500" />
                                        <div class="flex-1">
                                            <div class="font-medium text-sm text-yellow-900 group-hover:text-yellow-700">
                                                {{ $fav->negocio->nombre_negocio }}</div>
                                            <div class="text-xs text-slate-400 flex items-center gap-1">
                                                <x-icons.outline.location-marker
                                                    class="w-4 h-4" />{{ $fav->negocio->ubicacion->ciudad ?? 'Sin ciudad' }}
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500">No tienes favoritos guardados.</p>
                    @endif
                </div>
                <!-- Me gusta -->
                <div
                    class="bg-white rounded-2xl shadow border border-primary-100 p-6 flex flex-col gap-4 min-h-[220px] justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-primary-700 flex items-center gap-2">
                            <x-icons.solid.star class="w-5 h-5 text-red-500" /> Me gusta
                        </h2>
                        <span
                            class="inline-block bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">{{ $meGusta->count() }}</span>
                    </div>
                    @if ($meGusta->count())
                        <div class="flex flex-col gap-2">
                            @foreach ($meGusta as $mg)
                                @if ($mg->negocio)
                                    <a href="{{ route('negocios.mostrar', $mg->negocio->id_negocio) }}"
                                        class="group flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-red-50 transition cursor-pointer border border-transparent hover:border-red-200">
                                        <x-icons.outline.business class="w-5 h-5 text-red-400 group-hover:text-red-500" />
                                        <div class="flex-1">
                                            <div class="font-medium text-sm text-red-900 group-hover:text-red-700">
                                                {{ $mg->negocio->nombre_negocio }}</div>
                                            <div class="text-xs text-slate-400 flex items-center gap-1">
                                                <x-icons.outline.location-marker
                                                    class="w-4 h-4" />{{ $mg->negocio->ubicacion->ciudad ?? 'Sin ciudad' }}
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500">No tienes negocios marcados con me gusta.</p>
                    @endif
                </div>
            </div>

            <!-- Cerrar sesión -->
            <div class="flex justify-center mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-primary-500 text-white font-semibold text-base shadow-lg hover:bg-secondary-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-secondary-300 focus:ring-offset-2">
                        <x-icons.actions.logout class="w-6 h-6" />
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
