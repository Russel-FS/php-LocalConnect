@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="section-premium bg-white">
    <div class="max-w-3xl mx-auto text-center px-6">
        <h1 class="text-6xl md:text-7xl font-extrabold mb-6 tracking-tight text-gray-900">Conecta con tu comunidad local</h1>
        <p class="text-2xl md:text-3xl font-light text-gray-600 mb-10">Descubre y apoya negocios cerca de ti. Todo lo que necesitas, en un solo lugar.</p>
        <a href="#" class="btn-premium text-lg">Explorar negocios</a>
    </div>
    <div class="absolute left-0 right-0 -bottom-24 flex justify-center pointer-events-none select-none">
        <svg width="900" height="120" viewBox="0 0 900 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-10">
            <rect x="100" y="10" width="700" height="100" rx="50" fill="url(#paint0_linear)" />
            <defs>
                <linearGradient id="paint0_linear" x1="100" y1="10" x2="800" y2="110" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#e3e9ee" />
                    <stop offset="1" stop-color="#4f6d7a" />
                </linearGradient>
            </defs>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="section-premium section-alt">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">¿Por qué LocalConnect?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="card-feature">
                <svg class="feature-icon" width="48" height="48" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="1.5" />
                    <path d="M8 12l2 2 4-4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Confiable</h3>
                <p class="text-gray-500">Negocios verificados y reseñas reales de la comunidad.</p>
            </div>
            <div class="card-feature">
                <svg class="feature-icon" width="48" height="48" fill="none" viewBox="0 0 24 24">
                    <rect x="4" y="7" width="16" height="10" rx="5" stroke-width="1.5" />
                    <path d="M12 7v10" stroke-width="1.5" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Cerca de ti</h3>
                <p class="text-gray-500">Encuentra servicios y productos a pocos minutos de tu ubicación.</p>
            </div>
            <div class="card-feature">
                <svg class="feature-icon" width="48" height="48" fill="none" viewBox="0 0 24 24">
                    <rect x="6" y="6" width="12" height="12" rx="6" stroke-width="1.5" />
                    <path d="M12 10v4" stroke-width="1.5" />
                    <circle cx="12" cy="16" r="1" fill="currentColor" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Fácil y rápido</h3>
                <p class="text-gray-500">Interfaz intuitiva y resultados inmediatos.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonios Section -->
<section class="section-premium bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Lo que dice la comunidad</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="card-testimonial">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="avatar">
                <h4 class="font-semibold mb-2">Canaquiri Susy</h4>
                <p class="text-premium-muted mb-2 text-sm">"Encontré el mejor taller mecánico a dos cuadras de mi casa. ¡Súper fácil y rápido!"</p>
            </div>
            <div class="card-testimonial">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="avatar">
                <h4 class="font-semibold mb-2">Palacios Sahel</h4>
                <p class="text-premium-muted mb-2 text-sm">"Gracias a LocalConnect, mi cafetería recibe nuevos clientes cada semana."</p>
            </div>
            <div class="card-testimonial">
                <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Avatar" class="avatar">
                <h4 class="font-semibold mb-2">Fuertes Betzabet</h4>
                <p class="text-premium-muted mb-2 text-sm">"La plataforma es muy intuitiva y me ayudó a descubrir servicios que no conocía."</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="section-premium section-alt">
    <div class="max-w-2xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-6">¿Tienes un negocio local?</h2>
        <p class="text-xl text-gray-600 mb-10">Únete a LocalConnect y haz crecer tu presencia digital en tu comunidad.</p>
        <a href="#" class="btn-premium text-lg">Registrar mi negocio</a>
    </div>
</section>
@endsection