@extends('layouts.app')

@section('content')
<section class="section-padded bg-gray-alt flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl card-apple p-10">
        <h2 class="text-3xl font-extrabold mb-8 text-center tracking-tight text-primary-700">Crear cuenta</h2>

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
                <label for="name" class="block mb-2 text-primary-600 font-medium">Nombre completo *</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-primary-400">
                        <x-icons.form.user />
                    </span>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="Ingresa tu nombre completo"
                        class="w-full pl-11 pr-4 py-3 rounded-lg border @error('name') border-red-500 @else border-primary-200 @enderror focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" />
                </div>
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-primary-600 font-medium">Correo electrónico *</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-primary-400">
                        <x-icons.form.email />
                    </span>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="tu.correo@ejemplo.com"
                        class="w-full pl-11 pr-4 py-3 rounded-lg border @error('email') border-red-500 @else border-primary-200 @enderror focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" />
                </div>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-primary-600 font-medium">Contraseña *</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-primary-400">
                        <x-icons.form.lock />
                    </span>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        placeholder="Ingresa tu contraseña"
                        class="w-full pl-11 pr-4 py-3 rounded-lg border @error('password') border-red-500 @else border-primary-200 @enderror focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" />
                </div>
                @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block mb-2 text-primary-600 font-medium">Confirmar contraseña *</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-primary-400">
                        <x-icons.form.lock />
                    </span>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        placeholder="Confirma tu contraseña"
                        class="w-full pl-11 pr-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" />
                </div>
            </div>

            <button type="submit" class="btn-solid w-full text-base font-semibold py-3">Crear cuenta</button>
        </form>

        <div class="mt-8 text-center text-primary-500 text-sm">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-secondary-600 hover:underline font-semibold">Inicia sesión</a>
        </div>
    </div>
</section>
@endsection