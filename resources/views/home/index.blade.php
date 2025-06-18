@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative flex items-center justify-center min-h-[60vh] w-full overflow-hidden bg-white">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <!-- SVG abstracto decorativo -->
        <svg width="700" height="300" viewBox="0 0 700 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-30">
            <ellipse cx="350" cy="150" rx="320" ry="120" fill="url(#paint0_linear)" />
            <defs>
                <linearGradient id="paint0_linear" x1="0" y1="0" x2="700" y2="300" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#f3e8ff" />
                    <stop offset="1" stop-color="#a78bfa" />
                </linearGradient>
            </defs>
        </svg>
    </div>
    <div class="relative z-10 max-w-2xl mx-auto text-center px-6 py-20">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight text-gray-900">Conecta con tu comunidad local</h1>
        <p class="text-xl md:text-2xl font-light text-gray-600 mb-10">Descubre y apoya negocios cerca de ti. Todo lo que necesitas, en un solo lugar.</p>
        <a href="#" class="btn-apple-solid text-lg">Explorar negocios</a>
    </div>
</section>
<!-- Categorías -->
<section class="py-20">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-semibold text-center mb-14">Categorías destacadas</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            <div class="card-apple flex flex-col items-center p-10">
                <!-- Restaurante SVG -->
                <svg width="48" height="48" fill="none" viewBox="0 0 24 24" class="mb-4">
                    <path stroke="#7c3aed" stroke-width="1.5" d="M7 2v10m0 0c0 2.5-2 2.5-2 5.5V22m2-10c0 2.5 2 2.5 2 5.5V22M17 2v10m0 0c0 2.5-2 2.5-2 5.5V22m2-10c0 2.5 2 2.5 2 5.5V22" />
                </svg>
                <h3 class="text-lg font-medium mb-2">Restaurantes</h3>
                <p class="text-gray-500 text-center">Los mejores lugares para comer cerca de ti.</p>
            </div>
            <div class="card-apple flex flex-col items-center p-10">
                <!-- Servicios SVG -->
                <svg width="48" height="48" fill="none" viewBox="0 0 24 24" class="mb-4">
                    <circle cx="12" cy="12" r="9" stroke="#7c3aed" stroke-width="1.5" />
                    <path stroke="#7c3aed" stroke-width="1.5" d="M12 7v5l3 3" />
                </svg>
                <h3 class="text-lg font-medium mb-2">Servicios</h3>
                <p class="text-gray-500 text-center">Encuentra profesionales y soluciones locales.</p>
            </div>
            <div class="card-apple flex flex-col items-center p-10">
                <!-- Tiendas SVG -->
                <svg width="48" height="48" fill="none" viewBox="0 0 24 24" class="mb-4">
                    <rect x="3" y="7" width="18" height="13" rx="2" stroke="#7c3aed" stroke-width="1.5" />
                    <path stroke="#7c3aed" stroke-width="1.5" d="M3 10h18" />
                </svg>
                <h3 class="text-lg font-medium mb-2">Tiendas</h3>
                <p class="text-gray-500 text-center">Compra en comercios de tu zona.</p>
            </div>
        </div>
    </div>
</section>
<!-- Call to Action -->
<section class="py-20">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white/90 rounded-3xl shadow-xl p-12">
            <h2 class="text-3xl md:text-4xl font-semibold mb-4">¿Tienes un negocio?</h2>
            <p class="text-lg text-gray-600 mb-8">Únete a LocalConnect y haz crecer tu presencia digital sin complicaciones.</p>
            <a href="#" class="btn-apple-solid text-lg">Registrar mi negocio</a>
        </div>
    </div>
</section>
@endsection