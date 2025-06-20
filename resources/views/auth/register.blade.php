@extends('layouts.app')

@section('content')
<section class="section-premium bg-white min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-10 relative overflow-hidden">
        <h2 class="text-3xl font-extrabold mb-8 text-center tracking-tight">Crear cuenta</h2>

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block mb-2 text-gray-700">Nombre completo *</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" stroke="#4f6d7a" stroke-width="1.5" />
                            <path d="M4 19c0-2.5 3.5-4 8-4s8 1.5 8 4" stroke="#4f6d7a" stroke-width="1.5" />
                        </svg>
                    </span>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full pl-11 pr-4 py-3 rounded-lg border @error('name') border-red-500 @else border-gray-200 @enderror focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                </div>
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-gray-700">Correo electrónico *</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="14" rx="4" stroke="#4f6d7a" stroke-width="1.5" />
                            <path d="M3 7l9 6 9-6" stroke="#4f6d7a" stroke-width="1.5" />
                        </svg>
                    </span>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full pl-11 pr-4 py-3 rounded-lg border @error('email') border-red-500 @else border-gray-200 @enderror focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                </div>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tipo" class="block mb-2 text-gray-700">Tipo de cuenta *</label>
                <select
                    id="tipo"
                    name="tipo"
                    required
                    class="w-full px-4 py-3 rounded-lg border @error('tipo') border-red-500 @else border-gray-200 @enderror focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition">
                    <option value="">Selecciona un tipo</option>
                    <option value="residente" {{ old('tipo') == 'residente' ? 'selected' : '' }}>Residente</option>
                    <option value="negocio" {{ old('tipo') == 'negocio' ? 'selected' : '' }}>Negocio</option>
                </select>
                @error('tipo')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-gray-700">Contraseña *</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <rect x="5" y="11" width="14" height="7" rx="3.5" stroke="#4f6d7a" stroke-width="1.5" />
                            <circle cx="12" cy="14.5" r="1.5" fill="#4f6d7a" />
                        </svg>
                    </span>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="w-full pl-11 pr-4 py-3 rounded-lg border @error('password') border-red-500 @else border-gray-200 @enderror focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                </div>
                @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block mb-2 text-gray-700">Confirmar contraseña *</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <rect x="5" y="11" width="14" height="7" rx="3.5" stroke="#4f6d7a" stroke-width="1.5" />
                            <circle cx="12" cy="14.5" r="1.5" fill="#4f6d7a" />
                        </svg>
                    </span>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                </div>
            </div>

            <button type="submit" class="btn-premium w-full">Crear cuenta</button>
        </form>

        <div class="mt-8 text-center text-gray-500 text-sm">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary-600 hover:underline">Inicia sesión</a>
        </div>
    </div>
</section>
@endsection