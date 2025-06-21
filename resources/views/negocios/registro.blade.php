@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-alt">
    <div class="max-w-screen-xl mx-auto lg:grid lg:grid-cols-[320px_1fr] lg:gap-12 px-6 py-10">
        <!-- Sidebar -->
        <x-common.wizard-sidebar />

        <!-- Contenido principal -->
        <main>
            <div class="bg-white p-8 lg:p-10 rounded-2xl card-apple">
                <form id="wizard-form" method="POST" action="{{ route('negocios.guardar') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Bloque para mostrar errores generales y de validación -->
                    @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <strong class="font-bold">¡Ups! Hubo algunos problemas con tu entrada.</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Paso 1 Datos del negocio -->
                    <x-negocios.paso-datos-basicos />
                    <!-- Paso 2 Ubicación -->
                    <x-negocios.paso-ubicacion />
                    <!-- Paso 3 Categorías -->
                    <x-negocios.paso-categorias :categorias="$categorias" />
                    <!-- Paso 4 Servicios -->
                    <x-negocios.paso-servicios :categoriasServicio="$categoriasServicio" />
                    <!-- Paso 5 Horario y contacto -->
                    <x-negocios.paso-horario-contacto />
                    <!-- Paso 6 Resumen -->
                    <x-negocios.paso-resumen />
                </form>
            </div>
        </main>
    </div>
</div>

@vite([
'resources/js/negocios/wizard.js',
'resources/js/negocios/registro-paso1.js',
'resources/js/negocios/registro-paso2.js',
'resources/js/negocios/registro-paso3.js',
'resources/js/negocios/registro-paso4.js',
'resources/js/negocios/registro-paso5.js',
'resources/js/negocios/registro-paso6.js',
])

@endsection