@extends('layouts.app')

@section('content')
<section class="section-premium bg-white min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-10 relative overflow-hidden">
        <h2 class="text-3xl font-extrabold mb-8 text-center tracking-tight">Iniciar sesión</h2>
        @if(session('status'))
        <div class="mb-4 text-center text-red-500">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-gray-700">Correo electrónico</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <!-- SVG email -->
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="14" rx="4" stroke="#4f6d7a" stroke-width="1.5" />
                            <path d="M3 7l9 6 9-6" stroke="#4f6d7a" stroke-width="1.5" />
                        </svg>
                    </span>
                    <input id="email" name="email" type="email" required autofocus class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                </div>
            </div>
            <div>
                <label for="password" class="block mb-2 text-gray-700">Contraseña</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <!-- SVG password -->
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <rect x="5" y="11" width="14" height="7" rx="3.5" stroke="#4f6d7a" stroke-width="1.5" />
                            <circle cx="12" cy="14.5" r="1.5" fill="#4f6d7a" />
                        </svg>
                    </span>
                    <input id="password" name="password" type="password" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                </div>
            </div>
            <button type="submit" class="btn-premium w-full">Entrar</button>
        </form>
        <div class="mt-8 text-center text-gray-500 text-sm">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-primary-600 hover:underline">Regístrate</a>
        </div>
    </div>
</section>
@endsection