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

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
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
        },
        urlSugerencia(s) {
            switch (s.tipo) {
                case 'negocio':
                    return `/negocios/${s.id_negocio}`;
                case 'categoria':
                    return `/negocios/buscar?categorias[]=${s.id_categoria}`;
                case 'caracteristica':
                    return `/negocios/buscar?caracteristicas[]=${s.id_caracteristica}`;
                case 'servicio':
                    return `/negocios/buscar?servicios[]=${s.id_servicio_predefinido}`;
                default:
                    return '#';
            }
        },
        negocios() { return this.sugerencias.filter(s => s.tipo === 'negocio'); },
        categorias() { return this.sugerencias.filter(s => s.tipo === 'categoria'); },
        caracteristicas() { return this.sugerencias.filter(s => s.tipo === 'caracteristica'); },
        servicios() { return this.sugerencias.filter(s => s.tipo === 'servicio'); },
    }"
        class="relative min-h-screen flex items-center justify-center py-20 sm:py-24 lg:py-32 overflow-hidden">
        <!-- Background con gradiente moderno -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100"></div>
        <!-- Elementos decorativos -->
        <div
            class="absolute top-20 left-10 w-72 h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-40 right-10 w-72 h-72 bg-secondary-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000">
        </div>

        <div class="relative max-w-5xl mx-auto px-4 text-center z-10">
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light mb-8 tracking-tight text-gray-900 leading-tight">
                Conecta con tu <span
                    class="font-medium bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">comunidad
                    local</span>
            </h1>
            <p class="text-xl sm:text-2xl lg:text-3xl font-light text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                Descubre y apoya negocios cerca de ti. Todo lo que necesitas, en un solo lugar.
            </p>
            <!-- Buscador -->
            <div class="max-w-3xl mx-auto mb-8">
                <form action="{{ route('negocios.buscar') }}" method="GET" class="relative">
                    <div class="relative flex items-center">
                        <input type="text" name="q" x-on:input="buscarSugerencias($event)"
                            placeholder="¿Qué estás buscando? (ej: peluquería, restaurante, taller...)"
                            class="w-full pl-8 pr-36 py-6 text-xl bg-white/95 backdrop-blur-xl border-0 rounded-3xl shadow-[0_20px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)] focus:ring-4 focus:ring-primary-100 transition-all duration-300 placeholder-gray-400"
                            value="{{ request('q') }}">
                        <div class="absolute right-3">
                            <button type="submit"
                                class="flex items-center gap-3 bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-2xl font-medium transition-all duration-300 hover:shadow-lg hover:scale-105">
                                <x-icons.navigation.search class="h-5 w-5 text-white" />
                                Buscar
                            </button>
                        </div>
                        <!-- sugerencias -->
                        <div class="absolute left-0 top-full mt-2 w-full bg-white rounded-3xl shadow-lg border border-slate-200 z-50 max-h-60 modern-scrollbar overflow-y-auto p-1"
                            x-show="sugerencias.length > 0" @click.away="sugerencias = []">
                            <template x-for="sugerencia in sugerencias"
                                :key="sugerencia.id_negocio || sugerencia.id_categoria || sugerencia.id_caracteristica ||
                                    sugerencia.id_servicio_predefinido">
                                <a :href="urlSugerencia(sugerencia)"
                                    @click.prevent="window.location.href = $event.currentTarget.href"
                                    class="flex items-center gap-3 px-3 py-3 rounded-2xl transition-all cursor-pointer group hover:bg-slate-50 hover:shadow-md">
                                    <!-- Miniaturaa-->
                                    <span>
                                        <template x-if="sugerencia.tipo === 'negocio' && sugerencia.imagen_portada">
                                            <img :src="sugerencia.imagen_portada" :alt="sugerencia.nombre_negocio"
                                                class="w-11 h-11 object-cover rounded-xl bg-gray-100 flex-shrink-0">
                                        </template>
                                        <template x-if="!(sugerencia.tipo === 'negocio' && sugerencia.imagen_portada)">
                                            <span
                                                class="w-11 h-11 flex items-center justify-center rounded-xl bg-slate-100">
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="10" stroke-width="2" />
                                                    <path d="M8 12h8M12 8v8" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                            </span>
                                        </template>
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="font-medium text-[15px] truncate text-slate-800 group-hover:text-primary-700 transition-colors"
                                                x-text="sugerencia.nombre_negocio || sugerencia.nombre_categoria || sugerencia.nombre || sugerencia.nombre_servicio"></span>
                                            <template
                                                x-if="sugerencia.tipo === 'negocio' && sugerencia.valoraciones && sugerencia.valoraciones.length > 0">
                                                <span class="flex items-center gap-1 text-xs text-yellow-500 ml-1">
                                                    <x-icons.outline.star class="w-4 h-4"></x-icons.outline.star>
                                                    <span x-text="promedio(sugerencia.valoraciones)"></span>
                                                </span>
                                            </template>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <template x-if="sugerencia.tipo === 'negocio' && sugerencia.ubicacion">
                                                <span class="text-xs text-gray-500 ml-0.5"
                                                    x-text="direccion(sugerencia.ubicacion)"></span>
                                            </template>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('negocios.registro') }}"
                    class="group inline-flex items-center gap-4 px-10 py-5 rounded-3xl font-medium bg-gray-900 text-white shadow-[0_20px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)] hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] transition-all duration-500 hover:-translate-y-2">
                    <x-icons.actions.plus class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" />
                    <span class="text-lg">Registrar mi negocio</span>
                </a>
                <a href="{{ route('negocios.buscar') }}"
                    class="group inline-flex items-center gap-4 px-10 py-5 rounded-3xl font-medium border-2 border-gray-200 bg-white/90 backdrop-blur-xl text-gray-700 shadow-[0_20px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)] hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.15)] hover:border-gray-300 transition-all duration-500 hover:-translate-y-2">
                    <x-icons.navigation.search class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" />
                    <span class="text-lg">Explorar todos</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Carrusel -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            <div x-data="{
                active: 0,
                slides: [
                    { title: 'Negocios verificados', desc: 'Solo mostramos negocios reales y verificados por nuestro equipo.' },
                    { title: 'Encuentra lo que buscas', desc: 'Filtra por categorías, servicios y ubicación para resultados precisos.' },
                    { title: 'Apoya a tu comunidad', desc: 'Conecta con negocios locales y ayuda a crecer tu ciudad.' }
                ]
            }" class="relative">
                <div
                    class="overflow-hidden rounded-3xl shadow-[0_20px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)] bg-white border border-gray-100">
                    <template x-for="(slide, i) in slides" :key="i">
                        <div x-show="active === i" x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="p-12 text-center min-h-[180px] flex flex-col items-center justify-center">
                            <h3 class="text-2xl font-medium text-gray-900 mb-4" x-text="slide.title"></h3>
                            <p class="text-lg text-gray-600 leading-relaxed max-w-2xl" x-text="slide.desc"></p>
                        </div>
                    </template>
                </div>
                <div class="flex justify-center gap-3 mt-8">
                    <template x-for="(slide, i) in slides" :key="i">
                        <button @click="active = i"
                            :class="{ 'bg-gray-900 scale-110': active === i, 'bg-gray-300 hover:bg-gray-400': active !== i }"
                            class="w-4 h-4 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Categorías -->
    @if ($categorias->count() > 0)
        <section class="py-20 sm:py-24 lg:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 sm:mb-20">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-light text-gray-900 mb-6 tracking-tight">
                        Explora por <span class="font-medium text-primary-600">Categorías</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Descubre negocios organizados por categorías para encontrar exactamente lo que necesitas
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">
                    @foreach ($categorias as $categoria)
                        <a href="{{ route('negocios.buscar', ['categorias[]' => $categoria->id_categoria]) }}"
                            class="group relative block">
                            <div
                                class="relative overflow-hidden rounded-3xl bg-white shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out group-hover:-translate-y-2">
                                <!-- Imagen con overlay sutil -->
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ $categoria->img_url }}" alt="{{ $categoria->nombre_categoria }}"
                                        class="w-full h-full object-cover transition-all duration-700 ease-out group-hover:scale-110">
                                    <!-- Overlay sutil -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>
                                </div>

                                <!-- Contenido -->
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-medium text-gray-900 group-hover:text-primary-600 transition-colors duration-300 leading-tight">
                                        {{ $categoria->nombre_categoria }}
                                    </h3>
                                    <div
                                        class="mt-3 flex items-center text-gray-500 group-hover:text-primary-500 transition-colors duration-300">
                                        <span class="text-sm">Explorar negocios</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="text-center mt-16">
                    <a href="{{ route('negocios.buscar') }}"
                        class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl font-medium hover:bg-gray-800 transition-all duration-300 hover:shadow-lg">
                        <x-icons.navigation.search class="w-5 h-5" />
                        Ver todas las categorías
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Sección de beneficios -->
    <section id="por-que" class="py-20 sm:py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 sm:mb-20">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-light text-gray-900 mb-6 tracking-tight">
                    ¿Por qué <span class="font-medium text-primary-600">LocalConnect</span>?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Descubre las ventajas que hacen de LocalConnect la mejor opción para conectar con tu comunidad
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
                <div
                    class="group text-center p-10 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                        <x-icons.content.check-circle class="w-10 h-10 text-green-600" />
                    </div>
                    <h3 class="text-2xl font-medium mb-6 text-gray-900">Confiable</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">Negocios verificados y reseñas reales de la comunidad.
                    </p>
                </div>
                <div
                    class="group text-center p-10 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                        <x-icons.outline.location-marker class="w-10 h-10 text-blue-600" />
                    </div>
                    <h3 class="text-2xl font-medium mb-6 text-gray-900">Cerca de ti</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">Encuentra servicios y productos a pocos minutos de tu
                        ubicación.</p>
                </div>
                <div
                    class="group text-center p-10 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-200 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                        <x-icons.content.lightning class="w-10 h-10 text-purple-600" />
                    </div>
                    <h3 class="text-2xl font-medium mb-6 text-gray-900">Fácil y rápido</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">Interfaz intuitiva y resultados inmediatos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios  -->
    <section class="py-20 sm:py-24 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 sm:mb-20">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-light text-gray-900 mb-6 tracking-tight">
                    Lo que dice la <span class="font-medium text-primary-600">comunidad</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Descubre las experiencias reales de usuarios que han transformado su forma de conectar con negocios
                    locales
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
                <div
                    class="group p-8 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                            class="w-16 h-16 rounded-2xl object-cover mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-lg">Canaquiri Susy</h4>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg">"Encontré el mejor taller mecánico a dos cuadras de mi
                        casa. ¡Súper fácil y rápido!"</p>
                </div>
                <div
                    class="group p-8 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar"
                            class="w-16 h-16 rounded-2xl object-cover mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-lg">Fuertes Betzabet</h4>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg">"Gracias a LocalConnect, mi cafetería recibe nuevos
                        clientes cada semana."</p>
                </div>
                <div
                    class="group p-8 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Avatar"
                            class="w-16 h-16 rounded-2xl object-cover mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-lg">Guillermo Mallca</h4>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg">"La plataforma es muy intuitiva y me ayudó a descubrir
                        servicios que no conocía."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de contacto -->
    <section id="contacto" class="py-20 sm:py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-light text-gray-900 mb-6 tracking-tight">
                    ¿Tienes dudas o quieres <span class="font-medium text-primary-600">contactarnos</span>?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Estamos aquí para ayudarte. No dudes en contactarnos para cualquier consulta
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div
                    class="group p-8 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <x-icons.form.email class="w-8 h-8 text-blue-600" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-3">Email</h3>
                    <p class="text-lg text-gray-600">soporte@localconnect.com</p>
                </div>

                <div
                    class="group p-8 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 ease-out hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <x-icons.outline.phone class="w-8 h-8 text-green-600" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-3">Teléfono</h3>
                    <p class="text-lg text-gray-600">+1 (555) 123-4567</p>
                </div>
            </div>

            <div class="flex justify-center gap-4">
                <a href="#"
                    class="group w-12 h-12 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </a>
                <a href="#"
                    class="group w-12 h-12 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-500 transition-colors duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                    </svg>
                </a>
                <a href="#"
                    class="group w-12 h-12 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-pink-600 transition-colors duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
