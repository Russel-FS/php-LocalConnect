@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <form method="POST" action="{{ route('negocios.actualizar', $negocio->id_negocio) }}"
                enctype="multipart/form-data" class="space-y-16">
                @csrf
                @method('PUT')

                <!-- Hero-Imagen de portada -->
                <div
                    class="relative overflow-hidden bg-gradient-to-br from-primary-50 to-white rounded-xl sm:rounded-2xl lg:rounded-3xl mb-8 sm:mb-12 lg:mb-16 xl:mb-20">
                    <div class="absolute inset-0 bg-gradient-to-r from-secondary-500/5 to-primary-500/5"></div>
                    <div class="relative p-4 sm:p-6 md:p-8 lg:p-12 xl:p-16 2xl:p-24">
                        <div class="max-w-4xl mx-auto grid lg:grid-cols-2 gap-8 items-center">
                            <div class="space-y-6">
                                <h1
                                    class="text-4xl sm:text-5xl font-bold text-primary-700 leading-tight tracking-tight mb-4">
                                    Editar Negocio</h1>
                                <div class="space-y-4">
                                    <label class="block text-lg font-semibold text-primary-700">Nombre del negocio</label>
                                    <input type="text" name="nombre_negocio"
                                        value="{{ old('nombre_negocio', $negocio->nombre_negocio) }}"
                                        class="w-full px-5 py-3 rounded-xl bg-primary-50 border-0 focus:ring-2 focus:ring-primary-200 focus:outline-none text-lg"
                                        required>
                                    <label class="block text-lg font-semibold text-primary-700 mt-6">Descripción</label>
                                    <textarea name="descripcion" rows="4"
                                        class="w-full px-5 py-3 rounded-xl bg-primary-50 border-0 focus:ring-2 focus:ring-primary-200 focus:outline-none text-lg">{{ old('descripcion', $negocio->descripcion) }}</textarea>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                @if ($negocio->imagen_portada)
                                    <div
                                        class="aspect-square rounded-xl sm:rounded-2xl md:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl md:shadow-2xl group-hover:shadow-2xl transition-all duration-500 group-hover:-translate-y-1">
                                        <img id="vista-previa" src="{{ asset('storage/' . $negocio->imagen_portada) }}"
                                            alt="Portada actual"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @endif
                                <input type="file" id="imagen-portada" name="imagen_portada" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 mt-4" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mapa y Ubicación -->
                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-12 border border-primary-100/50 shadow-sm mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h2 class="text-3xl font-bold text-primary-700 tracking-tight">Ubicación</h2>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-12 items-start">
                        <div class="space-y-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                                    <input id="direccion" type="text" name="direccion"
                                        value="{{ old('direccion', $negocio->ubicacion->direccion ?? '') }}"
                                        class="w-full px-4 py-2 rounded-xl bg-primary-50 border-0 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                                    <input id="distrito" type="text" name="distrito"
                                        value="{{ old('distrito', $negocio->ubicacion->distrito ?? '') }}"
                                        class="w-full px-4 py-2 rounded-xl bg-primary-50 border-0 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                                    <input id="ciudad" type="text" name="ciudad"
                                        value="{{ old('ciudad', $negocio->ubicacion->ciudad ?? '') }}"
                                        class="w-full px-4 py-2 rounded-xl bg-primary-50 border-0 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                                    <input id="provincia" type="text" name="provincia"
                                        value="{{ old('provincia', $negocio->ubicacion->provincia ?? '') }}"
                                        class="w-full px-4 py-2 rounded-xl bg-primary-50 border-0 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                                </div>
                            </div>
                            <div class="hidden">
                                <input id="latitud" type="text" name="latitud"
                                    value="{{ old('latitud', $negocio->ubicacion->latitud ?? '') }}">
                                <input id="longitud" type="text" name="longitud"
                                    value="{{ old('longitud', $negocio->ubicacion->longitud ?? '') }}">
                                <input id="pais" type="text" name="pais"
                                    value="{{ old('pais', $negocio->ubicacion->pais ?? 'Perú') }}">
                                <input id="departamento" type="text" name="departamento"
                                    value="{{ old('departamento', $negocio->ubicacion->departamento ?? '') }}">
                            </div>
                            <p class="text-sm text-primary-400 mt-2">Haz clic en el mapa para marcar la ubicación exacta de
                                tu negocio</p>
                        </div>
                        <div>
                            <div>
                                <label class="block mb-2 text-primary-600 font-medium">Selecciona la ubicación en el
                                    mapa</label>
                                <div class="relative w-full h-full">
                                    <x-common.sugerencia />
                                    <x-common.mapa />
                                </div>
                                <p class="text-sm text-primary-400 mt-2">Haz clic en el mapa para marcar la ubicación exacta
                                    de tu negocio</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categorías -->
                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-12 border border-primary-100/50 shadow-sm mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-3xl font-bold text-primary-700 tracking-tight">Categorías</h2>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($categorias as $categoria)
                            <span
                                class="px-4 py-2 bg-white/90 border border-primary-200 text-primary-700 rounded-full text-base font-semibold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}"
                                        class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500"
                                        {{ in_array($categoria->id_categoria, old('categorias', $negocio->categorias->pluck('id_categoria')->toArray())) ? 'checked' : '' }}>
                                    {{ $categoria->nombre_categoria }}
                                </label>
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Características -->
                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-12 border border-primary-100/50 shadow-sm mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <h2 class="text-3xl font-bold text-primary-700 tracking-tight">Características</h2>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($caracteristicas as $caracteristica)
                            <span
                                class="px-4 py-2 bg-white/90 border border-primary-200 text-primary-700 rounded-full text-base font-semibold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="caracteristicas[]"
                                        value="{{ $caracteristica->id_caracteristica }}"
                                        class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500"
                                        {{ in_array($caracteristica->id_caracteristica, old('caracteristicas', $negocio->caracteristicas->pluck('id_caracteristica')->toArray())) ? 'checked' : '' }}>
                                    {{ $caracteristica->nombre }}
                                </label>
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Servicios Predefinidos -->
                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-12 border border-primary-100/50 shadow-sm mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <h2 class="text-3xl font-bold text-primary-700 tracking-tight">Servicios predefinidos</h2>
                    </div>
                    @if (isset($categoriasServicio) && $categoriasServicio->isNotEmpty())
                        <div class="space-y-8">
                            @foreach ($categoriasServicio as $catServ)
                                @if ($catServ->serviciosPredefinidos->isNotEmpty())
                                    <div class="mb-2">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span
                                                class="text-lg font-bold text-primary-700">{{ $catServ->nombre_categoria_servicio }}</span>
                                            @if ($catServ->descripcion)
                                                <span class="text-xs text-primary-400">{{ $catServ->descripcion }}</span>
                                            @endif
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            @foreach ($catServ->serviciosPredefinidos as $servicio)
                                                <label
                                                    class="group bg-white/80 backdrop-blur-sm rounded-3xl p-6 border border-primary-100/50 hover:border-primary-200 hover:shadow-lg transition-all duration-150 hover:-translate-y-0.5 flex items-center gap-4 cursor-pointer">
                                                    <span
                                                        class="w-10 h-10 bg-primary-100 rounded-2xl flex items-center justify-center group-hover:bg-primary-200 transition-all duration-300 group-hover:scale-110">
                                                        <svg class="w-6 h-6 text-primary-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-width="2"
                                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                        </svg>
                                                    </span>
                                                    <input type="checkbox" name="servicios_predefinidos[]"
                                                        value="{{ $servicio->id_servicio_predefinido }}"
                                                        class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500"
                                                        {{ in_array($servicio->id_servicio_predefinido, $negocio->serviciosPredefinidos->pluck('id_servicio_predefinido')->toArray()) ? 'checked' : '' }}>
                                                    <span class="flex-1">
                                                        <span
                                                            class="font-bold text-primary-700 text-lg">{{ $servicio->nombre_servicio }}</span>
                                                        @if ($servicio->descripcion)
                                                            <span
                                                                class="block text-primary-500 text-sm leading-relaxed">{{ $servicio->descripcion }}</span>
                                                        @endif
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-primary-400 text-center py-8">No hay categorías de servicios disponibles.</div>
                    @endif
                </div>

                <!-- Servicios Personalizados -->
                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-12 border border-primary-100/50 shadow-sm mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                        </svg>
                        <h2 class="text-3xl font-bold text-primary-700 tracking-tight">Servicios personalizados</h2>
                    </div>
                    <div class="max-w-6xl w-full mx-auto">
                        <div id="servicios-personalizados-lista"
                            class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-16">
                            @foreach ($negocio->serviciosPersonalizados as $i => $servicio)
                                <div
                                    class="servicio-personalizado-item group relative bg-white/80 backdrop-blur-sm rounded-3xl p-10 border border-primary-100/30 hover:shadow-lg hover:border-primary-200 transition-all duration-150 hover:-translate-y-0.5 flex flex-col gap-6 min-h-[320px]">
                                    <input type="hidden" name="servicios_personalizados[{{ $i }}][id]"
                                        value="{{ $servicio->id_servicio }}">
                                    <div class="flex items-center gap-4 mb-2">
                                        <span
                                            class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center group-hover:bg-primary-200 transition-all duration-300 group-hover:scale-110">
                                            <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-width="2"
                                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                            </svg>
                                        </span>
                                        <input type="text"
                                            name="servicios_personalizados[{{ $i }}][nombre]"
                                            value="{{ old('servicios_personalizados.' . $i . '.nombre', $servicio->nombre_servicio) }}"
                                            class="flex-1 px-4 py-3 rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary-100 focus:outline-none bg-white font-bold text-lg"
                                            required placeholder="Nombre del servicio">
                                    </div>
                                    <input type="text"
                                        name="servicios_personalizados[{{ $i }}][descripcion]"
                                        value="{{ old('servicios_personalizados.' . $i . '.descripcion', $servicio->descripcion) }}"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary-100 focus:outline-none bg-white"
                                        placeholder="Descripción">
                                    <input type="number" name="servicios_personalizados[{{ $i }}][precio]"
                                        value="{{ old('servicios_personalizados.' . $i . '.precio', $servicio->precio) }}"
                                        class="w-36 px-4 py-3 rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary-100 focus:outline-none bg-white font-semibold text-lg"
                                        min="0" step="0.01" placeholder="Precio (S/)">
                                    <div class="flex items-center gap-6 mt-2">
                                        <label class="inline-flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox"
                                                name="servicios_personalizados[{{ $i }}][disponible]"
                                                value="1" {{ $servicio->disponible ? 'checked' : '' }}>
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-secondary-50 text-secondary-600 border border-secondary-100">
                                                <span
                                                    class="w-2 h-2 rounded-full {{ $servicio->disponible ? 'bg-secondary-500' : 'bg-red-500' }}"></span>
                                                {{ $servicio->disponible ? 'Disponible' : 'No disponible' }}
                                            </span>
                                        </label>
                                        <button type="button" class="text-red-500 ml-2 font-semibold"
                                            onclick="eliminarServicioPersonalizado(this)">Eliminar</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-end mt-10">
                            <button type="button" onclick="agregarServicioPersonalizado()"
                                class="px-10 py-4 bg-primary-600 rounded-full shadow-lg hover:bg-primary-700 transition font-semibold text-white text-lg flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Agregar servicio personalizado
                            </button>
                        </div>
                    </div>
                </div>

                <!-- horarios de atencion -->
                <div
                    class="bg-gradient-to-br from-white to-primary-50/20 rounded-3xl p-12 border border-primary-100/50 shadow-sm mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-3xl font-bold text-primary-700 tracking-tight">Horarios de Atención</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @php
                            $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
                        @endphp
                        @foreach ($dias as $dia)
                            @php
                                $horario =
                                    $horarios->firstWhere('dia_semana', $dia) ??
                                    new \App\Models\Negocio\HorarioAtencion(['dia_semana' => $dia, 'cerrado' => true]);
                                $horarioId = $horario->id_horario ?? 'new_' . $dia;
                            @endphp
                            <div x-data="{ cerrado: {{ old('horarios.' . $horarioId . '.cerrado', $horario->cerrado) ? 'true' : 'false' }} }"
                                class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-primary-100/50 hover:border-primary-200 hover:shadow-lg transition-all duration-150 flex flex-col gap-3">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="w-8 h-8 bg-primary-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <div class="font-semibold text-primary-800 capitalize text-lg">{{ $dia }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Apertura</label>
                                        <input type="time" name="horarios[{{ $horarioId }}][hora_apertura]"
                                            value="{{ old('horarios.' . $horarioId . '.hora_apertura', optional($horario)->hora_apertura) }}"
                                            :disabled="cerrado"
                                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none disabled:bg-gray-200 disabled:cursor-not-allowed transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Cierre</label>
                                        <input type="time" name="horarios[{{ $horarioId }}][hora_cierre]"
                                            value="{{ old('horarios.' . $horarioId . '.hora_cierre', optional($horario)->hora_cierre) }}"
                                            :disabled="cerrado"
                                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none disabled:bg-gray-200 disabled:cursor-not-allowed transition">
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-sm font-medium text-gray-700"
                                        x-text="cerrado ? 'Cerrado' : 'Abierto'"></span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="horarios[{{ $horarioId }}][cerrado]"
                                            value="1" class="sr-only peer" x-model="cerrado">
                                        <input type="hidden" name="horarios[{{ $horarioId }}][dia_semana]"
                                            value="{{ $dia }}">
                                        <div
                                            class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between items-center mt-12">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary-600 text-white font-semibold shadow-lg hover:bg-primary-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function mostrarVistaPrevia(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const vistaPrevia = document.getElementById("vista-previa");
                    vistaPrevia.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        function configurarInputImagen() {
            const input = document.getElementById("imagen-portada");
            if (input) {
                input.addEventListener("change", function() {
                    mostrarVistaPrevia(this);
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            configurarInputImagen();
        });

        function eliminarServicioPersonalizado(btn) {
            btn.closest('.servicio-personalizado-item').remove();
        }

        function agregarServicioPersonalizado() {
            const lista = document.getElementById('servicios-personalizados-lista');
            const index = lista.children.length;
            const html = `
                <div class="servicio-personalizado-item group relative bg-white/80 backdrop-blur-sm rounded-3xl p-10 border border-primary-100/30 hover:shadow-lg hover:border-primary-200 transition-all duration-150 hover:-translate-y-0.5 flex flex-col gap-6 min-h-[320px]">
                    <div class="flex items-center gap-4 mb-2">
                        <span class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center group-hover:bg-primary-200 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" /></svg>
                        </span>
                        <input type="text" name="servicios_personalizados[${index}][nombre]" class="flex-1 px-4 py-3 rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary-100 focus:outline-none bg-white font-bold text-lg" required placeholder="Nombre del servicio">
                    </div>
                    <input type="text" name="servicios_personalizados[${index}][descripcion]" class="w-full px-4 py-3 rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary-100 focus:outline-none bg-white" placeholder="Descripción">
                    <input type="number" name="servicios_personalizados[${index}][precio]" class="w-36 px-4 py-3 rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary-100 focus:outline-none bg-white font-semibold text-lg" min="0" step="0.01" placeholder="Precio (S/)">
                    <div class="flex items-center gap-6 mt-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="servicios_personalizados[${index}][disponible]" value="1" checked>
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-secondary-50 text-secondary-600 border border-secondary-100">
                                <span class="w-2 h-2 rounded-full bg-secondary-500"></span>
                                Disponible
                            </span>
                        </label>
                        <button type="button" class="text-red-500 ml-2 font-semibold" onclick="eliminarServicioPersonalizado(this)">Eliminar</button>
                    </div>
                </div>
            `;
            lista.insertAdjacentHTML('beforeend', html);
        }
    </script>

@endsection
