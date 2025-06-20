@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 ">
    <div class=" flex">
        <!-- Sidebar -->
        <x-wizard-sidebar />

        <!-- Contenido principal -->
        <main class="flex-1">
            <div class="max-w-4xl mx-auto p-8 lg:p-10">
                <form id="wizard-form" autocomplete="off">
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

@vite(['resources/js/negocios/registro-negocio.js'])

@endsection