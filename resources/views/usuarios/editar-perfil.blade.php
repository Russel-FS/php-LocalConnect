@extends('layouts.app')

@section('content')
    <section class="min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-primary-50 to-white py-12">
        <div
            class="max-w-md w-full mx-auto bg-white rounded-3xl shadow-lg border border-primary-100 p-8 flex flex-col gap-6">
            <h1 class="text-2xl font-bold text-primary-700 mb-2 flex items-center gap-2">
                <x-icons.outline.user class="w-6 h-6 text-primary-600" /> Editar perfil
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
            <form method="POST" action="{{ route('perfil.actualizar') }}" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="rounded-lg border border-gray-200 px-4 py-2 w-full text-sm focus:ring-primary-500 focus:border-primary-500" />
                </div>
                <div>
                    <label for="telefono" class="block text-sm font-medium text-slate-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $user->telefono) }}"
                        class="rounded-lg border border-gray-200 px-4 py-2 w-full text-sm focus:ring-primary-500 focus:border-primary-500" />
                </div>
                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="px-6 py-2 rounded-full bg-primary-600 text-white font-semibold text-sm hover:bg-primary-700 transition">Guardar
                        cambios</button>
                    <a href="{{ route('perfil') }}"
                        class="px-6 py-2 rounded-full bg-secondary-50 text-secondary-700 border border-secondary-100 hover:bg-secondary-100 transition text-sm font-semibold">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
@endsection
