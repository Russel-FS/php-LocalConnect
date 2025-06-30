@extends('layouts.app')

@section('content')
    <section class="min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-primary-50 to-white py-12">
        <div class="max-w-lg w-full mx-auto bg-white rounded-3xl shadow-md border border-primary-100 p-8">
            <h1 class="text-3xl font-bold text-primary-700 mb-6 text-center">Mi perfil</h1>
            <div class="space-y-4 mb-8">
                <div>
                    <span class="block text-xs text-slate-400 uppercase mb-1">Nombre</span>
                    <span class="block text-lg font-semibold text-primary-700">{{ Auth::user()->name }}</span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400 uppercase mb-1">Correo electrónico</span>
                    <span class="block text-lg font-medium text-primary-600">{{ Auth::user()->email }}</span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400 uppercase mb-1">Miembro desde</span>
                    <span class="block text-lg text-primary-500">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="pt-4 border-t border-primary-50">
                <p class="text-sm text-slate-500 mb-4">Próximamente podrás editar tus datos, cambiar contraseña y más
                    opciones.</p>
                <a href="/"
                    class="inline-block px-6 py-2 rounded-full bg-primary-600 text-white font-semibold text-sm shadow hover:bg-primary-700 transition-all duration-200">Volver
                    al inicio</a>
            </div>
        </div>
    </section>
@endsection
