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
                <div class="relative flex items-center">
                    <input
                        type="text"
                        name="q"
                        placeholder="¿Qué estás buscando? (ej: peluquería, restaurante, taller...)"
                        class="w-full pl-6 pr-32 py-4 sm:py-5 text-lg sm:text-xl bg-white/90 backdrop-blur-md border border-slate-200 rounded-2xl shadow-sm focus:border-slate-300 focus:ring-2 focus:ring-slate-100 transition-all duration-300 placeholder-slate-400"
                        value="{{ request('q') }}">
                    <div class="absolute right-2">
                        <button type="submit" class="flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-6 py-2 sm:py-3 rounded-full font-medium transition-all duration-300 hover:shadow-md">
                            <x-icons.navigation.search class="h-5 w-5 text-white" />
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
            <a href="{{ route('negocios.registro') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold bg-primary-600 text-white shadow-lg hover:bg-primary-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <x-icons.actions.plus class="w-5 h-5" />
                <span>Registrar mi negocio</span>
            </a>
            <a href="{{ route('negocios.buscar') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold border-2 border-primary-200 bg-white/80 backdrop-blur-sm text-primary-700 shadow-lg hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 hover:-translate-y-1">
                <x-icons.navigation.search class="w-5 h-5" />
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
                    <x-icons.content.check-circle class="w-8 h-8 text-primary-600" />
                </div>
                <h3 class="text-xl font-semibold mb-4 text-primary-700">Confiable</h3>
                <p class="text-primary-500 leading-relaxed">Negocios verificados y reseñas reales de la comunidad.</p>
            </div>
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <x-icons.outline.location-marker class="w-8 h-8 text-primary-600" />
                </div>
                <h3 class="text-xl font-semibold mb-4 text-primary-700">Cerca de ti</h3>
                <p class="text-primary-500 leading-relaxed">Encuentra servicios y productos a pocos minutos de tu ubicación.</p>
            </div>
            <div class="text-center p-8 bg-white/80 backdrop-blur-sm rounded-3xl border border-primary-100/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <x-icons.content.lightning class="w-8 h-8 text-primary-600" />
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
            <x-icons.actions.plus class="w-5 h-5" />
            <span>Registrar mi negocio</span>
        </a>
    </div>
</section>
@endsection