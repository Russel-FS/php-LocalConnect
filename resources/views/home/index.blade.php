@extends('layouts.app')

@section('content')
    <style>
        #sugerencias {
            max-height: 400px;
            overflow-y: auto;
            gap: 2px;
            flex-direction: column;
            modern-scrollbar
        }

        @keyframes sugerencias-animation {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #sugerencias a {
            animation: sugerencias-animation 0.3s ease-in-out;
        }
    </style>
    <!-- Hero-->
    <section x-data="{
        sugerencias: [],
        timeout: null,
        buscarSugerencias(e) {
            clearTimeout(this.timeout);
            const valor = e.target.value;
            if (!valor.trim()) {
                this.sugerencias = [];
                return;
            }
            this.timeout = setTimeout(() => {
                fetch(`{{ route('negocios.sugerencias') }}?q=${valor}`)
                    .then(response => response.json())
                    .then(data => {
                        this.sugerencias = data;
                    });
            }, 500);
        },
        promedio(valoraciones) {
            if (!valoraciones || valoraciones.length === 0) return '';
            let suma = valoraciones.reduce((acc, v) => acc + (v.calificacion || 0), 0);
            return (suma / valoraciones.length).toFixed(1);
        },
        direccion(ubicacion) {
            if (!ubicacion) return '';
            return `${ubicacion.direccion ?? ''}${ubicacion.distrito ? ', ' + ubicacion.distrito : ''}`;
        }
    }"
        class="min-h-[340px] bg-gradient-to-br from-primary-50 to-white flex items-center justify-center py-12 sm:py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 tracking-tight text-primary-700 leading-tight">
                Conecta con tu <span class="text-secondary-600">comunidad local</span>
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl font-light text-primary-500 mb-8 max-w-2xl mx-auto leading-relaxed">
                Descubre y apoya negocios cerca de ti. Todo lo que necesitas, en un solo lugar.
            </p>
            <!-- Buscador -->
            <div class="max-w-2xl mx-auto mb-4">
                <form action="{{ route('negocios.buscar') }}" method="GET" class="relative">
                    <div class="relative flex items-center">
                        <input type="text" name="q" x-on:input="buscarSugerencias($event)"
                            placeholder="¿Qué estás buscando? (ej: peluquería, restaurante, taller...)"
                            class="w-full pl-6 pr-32 py-4 text-lg bg-white/90 backdrop-blur-md border border-slate-200 rounded-2xl shadow-sm focus:border-slate-300 focus:ring-2 focus:ring-slate-100 transition-all duration-300 placeholder-slate-400"
                            value="{{ request('q') }}">
                        <div class="absolute right-2">
                            <button type="submit"
                                class="flex items-center gap-2 bg-primary-800 hover:bg-primary-700 text-white px-6 py-2 rounded-full font-medium transition-all duration-300 hover:shadow-md">
                                <x-icons.navigation.search class="h-5 w-5 text-white" />
                                Buscar
                            </button>
                        </div>
                        <!-- sugerencias -->
                        <div class="absolute left-0 top-full mt-2 w-full bg-white rounded-2xl shadow-lg border border-slate-200 z-50"
                            x-show="sugerencias.length > 0" @click.away="sugerencias = []">
                            <template x-for="sugerencia in sugerencias" :key="sugerencia.id_negocio">
                                <a :href="`/negocios/${sugerencia.id_negocio}`"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-primary-50 transition-colors rounded-2xl cursor-pointer group">
                                    <template x-if="sugerencia.imagen_portada">
                                        <img :src="sugerencia.imagen_portada" :alt="sugerencia.nombre_negocio"
                                            class="w-12 h-12 object-cover rounded-xl bg-gray-100 flex-shrink-0">
                                    </template>
                                    <template x-if="!sugerencia.imagen_portada">
                                        <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-primary-50">
                                            <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <rect x="3" y="10" width="18" height="8" rx="2"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7 10V6a5 5 0 0110 0v4" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M9 18v-2a2 2 0 114 0v2" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </template>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-primary-800 text-sm truncate"
                                                x-text="sugerencia.nombre_negocio"></span>
                                            <template x-if="sugerencia.valoraciones && sugerencia.valoraciones.length > 0">
                                                <span class="flex items-center gap-1 text-xs text-yellow-500 ml-2">
                                                    <x-icons.outline.star class="w-4 h-4"></x-icons.outline.star>
                                                    <span x-text="promedio(sugerencia.valoraciones)"></span>
                                                </span>
                                            </template>
                                        </div>
                                        <div class="flex gap-2 justify-baseline text-xs text-gray-500 mt-1 relative">
                                            <x-icons.outline.location-marker
                                                class="w-4 h-4 text-gray-400 absolute left-0 top-1/2 transform -translate-y-1/2">
                                            </x-icons.outline.location-marker>
                                            <span class="text-xs text-gray-500 ml-5"
                                                x-text="direccion(sugerencia.ubicacion)"></span>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('negocios.registro') }}"
                    class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold bg-primary-600 text-white shadow-lg hover:bg-primary-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <x-icons.actions.plus class="w-5 h-5" />
                    <span>Registrar mi negocio</span>
                </a>
                <a href="{{ route('negocios.buscar') }}"
                    class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-semibold border-2 border-primary-200 bg-white/80 backdrop-blur-sm text-primary-700 shadow-lg hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 hover:-translate-y-1">
                    <x-icons.navigation.search class="w-5 h-5" />
                    <span>Explorar todos</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Carrusel -->
    <section class="py-6 bg-white">
        <div class="max-w-3xl mx-auto px-4">
            <div x-data="{
                active: 0,
                slides: [
                    { title: 'Negocios verificados', desc: 'Solo mostramos negocios reales y verificados por nuestro equipo.' },
                    { title: 'Encuentra lo que buscas', desc: 'Filtra por categorías, servicios y ubicación para resultados precisos.' },
                    { title: 'Apoya a tu comunidad', desc: 'Conecta con negocios locales y ayuda a crecer tu ciudad.' }
                ]
            }" class="relative">
                <div class="overflow-hidden rounded-2xl shadow-sm bg-white border border-primary-100">
                    <template x-for="(slide, i) in slides" :key="i">
                        <div x-show="active === i" x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="p-8 text-center min-h-[140px] flex flex-col items-center justify-center">
                            <h3 class="text-xl font-semibold text-primary-700 mb-2" x-text="slide.title"></h3>
                            <p class="text-primary-500 text-base" x-text="slide.desc"></p>
                        </div>
                    </template>
                </div>
                <div class="flex justify-center gap-2 mt-4">
                    <template x-for="(slide, i) in slides" :key="i">
                        <button @click="active = i"
                            :class="{ 'bg-secondary-500': active === i, 'bg-secondary-200': active !== i }"
                            class="w-3 h-3 rounded-full transition-colors"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de beneficios -->
    <section id="por-que" class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-12 sm:mb-16 text-primary-700">¿Por qué
                LocalConnect?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
                <div
                    class="text-center p-8 bg-white rounded-3xl border border-primary-100 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <x-icons.content.check-circle class="w-8 h-8 text-primary-600" />
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-primary-700">Confiable</h3>
                    <p class="text-primary-500 leading-relaxed">Negocios verificados y reseñas reales de la comunidad.</p>
                </div>
                <div
                    class="text-center p-8 bg-white rounded-3xl border border-primary-100 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <x-icons.outline.location-marker class="w-8 h-8 text-primary-600" />
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-primary-700">Cerca de ti</h3>
                    <p class="text-primary-500 leading-relaxed">Encuentra servicios y productos a pocos minutos de tu
                        ubicación.</p>
                </div>
                <div
                    class="text-center p-8 bg-white rounded-3xl border border-primary-100 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <x-icons.content.lightning class="w-8 h-8 text-primary-600" />
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-primary-700">Fácil y rápido</h3>
                    <p class="text-primary-500 leading-relaxed">Interfaz intuitiva y resultados inmediatos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios  -->
    <section class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-primary-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-12 sm:mb-16 text-primary-700">Lo que dice
                la comunidad</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
                <div class="card-testimonial">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="avatar">
                    <h4 class="font-semibold mb-4 text-primary-700 text-lg">Canaquiri Susy</h4>
                    <p class="text-primary-500 leading-relaxed">"Encontré el mejor taller mecánico a dos cuadras de mi
                        casa.
                        ¡Súper fácil y rápido!"</p>
                </div>
                <div class="card-testimonial">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="avatar">
                    <h4 class="font-semibold mb-4 text-primary-700 text-lg">Palacios Sahel</h4>
                    <p class="text-primary-500 leading-relaxed">"Gracias a LocalConnect, mi cafetería recibe nuevos
                        clientes
                        cada semana."</p>
                </div>
                <div class="card-testimonial">
                    <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Avatar" class="avatar">
                    <h4 class="font-semibold mb-4 text-primary-700 text-lg">Fuertes Betzabet</h4>
                    <p class="text-primary-500 leading-relaxed">"La plataforma es muy intuitiva y me ayudó a descubrir
                        servicios que no conocía."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de contacto -->
    <section id="contacto" class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-2xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-8 text-primary-700">¿Tienes dudas o quieres
                contactarnos?</h2>
            <div class="space-y-6">
                <div class="flex items-center justify-center gap-3">
                    <x-icons.form.email class="w-6 h-6 text-primary-600" />
                    <span class="text-lg text-primary-700">soporte@localconnect.com</span>
                </div>
                <div class="flex items-center justify-center gap-3">
                    <x-icons.outline.phone class="w-6 h-6 text-primary-600" />
                    <span class="text-lg text-primary-700">+1 (555) 123-4567</span>
                </div>
                <div class="flex items-center justify-center gap-3 pt-2">
                    <a href="#"
                        class="w-8 h-8 bg-secondary-100 rounded-lg flex items-center justify-center hover:bg-secondary-200 transition-colors duration-200">
                        <svg class="w-4 h-4 text-secondary-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-8 h-8 bg-secondary-100 rounded-lg flex items-center justify-center hover:bg-secondary-200 transition-colors duration-200">
                        <svg class="w-4 h-4 text-secondary-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-8 h-8 bg-secondary-100 rounded-lg flex items-center justify-center hover:bg-secondary-200 transition-colors duration-200">
                        <svg class="w-4 h-4 text-secondary-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
