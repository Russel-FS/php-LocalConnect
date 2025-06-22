@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="min-h-screen bg-gradient-to-br from-primary-50 to-white flex items-center justify-center py-12 sm:py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 sm:mb-8 tracking-tight text-primary-700 leading-tight">
            Conecta con tu <span class="text-secondary-600">comunidad local</span>
        </h1>
        <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-light text-primary-500 mb-8 sm:mb-12 max-w-4xl mx-auto leading-relaxed">
            Descubre y apoya negocios cerca de ti. Todo lo que necesitas, en un solo lugar.
        </p>

        <!-- Buscador -->
        <div class="max-w-4xl mx-auto mb-8 sm:mb-12">
            <form action="{{ route('negocios.buscar') }}" method="GET" class="relative">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        placeholder="¿Qué estás buscando? (ej: peluquería, restaurante, taller...)"
                        class="w-full pl-16 pr-6 py-4 sm:py-5 text-lg sm:text-xl bg-white/80 backdrop-blur-sm border-2 border-primary-200 rounded-2xl shadow-lg focus:border-secondary-400 focus:ring-4 focus:ring-secondary-100 transition-all duration-300 placeholder-primary-400"
                        value="{{ request('q') }}">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-secondary-600 hover:bg-secondary-700 text-white px-6 py-2 sm:py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
            <a href="{{ route('negocios.registro') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold bg-primary-600 text-white shadow-lg hover:bg-primary-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Registrar mi negocio</span>
            </a>
            <a href="{{ route('negocios.buscar') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold border-2 border-primary-200 bg-white/80 backdrop-blur-sm text-primary-700 shadow-lg hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Explorar todos</span>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 sm:py-20 lg:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-12 sm:mb-16 text-primary-700">¿Por qué LocalConnect?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke-width="1.5" />
                        <path d="M8 12l2 2 4-4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-primary-700">Confiable</h3>
                <p class="text-primary-500 leading-relaxed">Negocios verificados y reseñas reales de la comunidad.</p>
            </div>
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-primary-700">Cerca de ti</h3>
                <p class="text-primary-500 leading-relaxed">Encuentra servicios y productos a pocos minutos de tu ubicación.</p>
            </div>
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-primary-700">Fácil y rápido</h3>
                <p class="text-primary-500 leading-relaxed">Interfaz intuitiva y resultados inmediatos.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonios Section -->
<section class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-primary-50 to-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-12 sm:mb-16 text-primary-700">Lo que dice la comunidad</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-16 h-16 rounded-full mx-auto mb-6 border-4 border-primary-100">
                <h4 class="font-semibold mb-4 text-primary-700 text-lg">Canaquiri Susy</h4>
                <p class="text-primary-500 leading-relaxed">"Encontré el mejor taller mecánico a dos cuadras de mi casa. ¡Súper fácil y rápido!"</p>
            </div>
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="w-16 h-16 rounded-full mx-auto mb-6 border-4 border-primary-100">
                <h4 class="font-semibold mb-4 text-primary-700 text-lg">Palacios Sahel</h4>
                <p class="text-primary-500 leading-relaxed">"Gracias a LocalConnect, mi cafetería recibe nuevos clientes cada semana."</p>
            </div>
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm">
                <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Avatar" class="w-16 h-16 rounded-full mx-auto mb-6 border-4 border-primary-100">
                <h4 class="font-semibold mb-4 text-primary-700 text-lg">Fuertes Betzabet</h4>
                <p class="text-primary-500 leading-relaxed">"La plataforma es muy intuitiva y me ayudó a descubrir servicios que no conocía."</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-16 sm:py-20 lg:py-24 bg-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 sm:mb-8 text-primary-700">¿Tienes un negocio local?</h2>
        <p class="text-xl sm:text-2xl text-primary-500 mb-8 sm:mb-12 leading-relaxed">Únete a LocalConnect y haz crecer tu presencia digital en tu comunidad.</p>
        <a href="{{ route('negocios.registro') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold bg-primary-600 text-white shadow-lg hover:bg-primary-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Registrar mi negocio</span>
        </a>
    </div>
</section>
@endsection