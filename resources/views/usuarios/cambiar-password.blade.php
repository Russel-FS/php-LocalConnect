@extends('layouts.app')

@section('content')
    <section class="min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-primary-50 to-white py-12">
        <div
            class="max-w-md w-full mx-auto bg-white rounded-3xl shadow-lg border border-primary-100 p-8 flex flex-col gap-6">
            <h1 class="text-2xl font-bold text-primary-700 mb-2 flex items-center gap-2">
                <x-icons.outline.lock class="w-6 h-6 text-primary-600" /> Cambiar contraseña
            </h1>
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-2 mb-2 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-2 mb-2 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('perfil.password.actualizar') }}" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700 mb-1">Contraseña
                        actual</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="rounded-lg border border-gray-200 px-4 py-2 w-full text-sm focus:ring-primary-500 focus:border-primary-500" />
                </div>
                <div>
                    <label for="new_password" class="block text-sm font-medium text-slate-700 mb-1">Nueva contraseña</label>
                    <input type="password" name="new_password" id="new_password" required
                        class="rounded-lg border border-gray-200 px-4 py-2 w-full text-sm focus:ring-primary-500 focus:border-primary-500" />
                </div>
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirmar
                        nueva contraseña</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="rounded-lg border border-gray-200 px-4 py-2 w-full text-sm focus:ring-primary-500 focus:border-primary-500" />
                </div>
                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="px-6 py-2 rounded-full bg-primary-600 text-white font-semibold text-sm hover:bg-primary-700 transition">Actualizar
                        contraseña</button>
                    <a href="{{ route('perfil') }}"
                        class="px-6 py-2 rounded-full bg-secondary-50 text-secondary-700 border border-secondary-100 hover:bg-secondary-100 transition text-sm font-semibold">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
@endsection
