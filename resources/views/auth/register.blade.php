@extends('layouts.app')

@section('content')
<section class="section-premium bg-white min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-10">
        <h2 class="text-3xl font-bold mb-8 text-center">Crear cuenta</h2>
        @if(session('status'))
        <div class="mb-4 text-center text-red-500">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-gray-700">Nombre</label>
                <input id="name" name="name" type="text" required autofocus class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
            </div>
            <div>
                <label for="email" class="block mb-2 text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
            </div>
            <div>
                <label for="password" class="block mb-2 text-gray-700">Contraseña</label>
                <input id="password" name="password" type="password" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
            </div>
            <button type="submit" class="btn-premium w-full">Crear cuenta</button>
        </form>
        <div class="mt-8 text-center text-gray-500 text-sm">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary-600 hover:underline">Inicia sesión</a>
        </div>
    </div>
</section>
@endsection