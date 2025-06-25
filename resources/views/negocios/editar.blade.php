@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('negocios.actualizar', $negocio->id_negocio) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-bold text-primary-700 tracking-tight">Editar Negocio</h1>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary-600 text-white font-semibold shadow-lg hover:bg-primary-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar Cambios
                </button>
            </div>

            <div class="space-y-12">
                <!-- Información Básica -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Información Básica</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del negocio</label>
                            <input type="text" name="nombre_negocio" value="{{ old('nombre_negocio', $negocio->nombre_negocio) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea name="descripcion" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">{{ old('descripcion', $negocio->descripcion) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de portada</label>
                            @if($negocio->imagen_portada)
                            <img id="vista-previa" src="{{ asset('storage/' . $negocio->imagen_portada) }}" alt="Portada actual" class="w-48 h-32 object-cover rounded-lg mb-4 shadow-md">
                            @endif
                            <input type="file" id="imagen-portada" name="imagen_portada" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" />
                        </div>
                    </div>
                </div>

                <!-- Ubicación con Mapa -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Ubicación</h2>
                    <div class="space-y-6">
                        <label class="block mb-2 text-primary-600 font-medium">Selecciona la ubicación en el mapa</label>
                        <div class="relative w-full h-full mb-2">
                            <x-common.sugerencia />
                            <x-common.mapa />
                        </div>
                        <p class="text-sm text-primary-400 mt-2">Haz clic en el mapa para marcar la ubicación exacta de tu negocio</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                                <input id="direccion" type="text" name="direccion" value="{{ old('direccion', $negocio->ubicacion->direccion ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                                <input id="distrito" type="text" name="distrito" value="{{ old('distrito', $negocio->ubicacion->distrito ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                                <input id="ciudad" type="text" name="ciudad" value="{{ old('ciudad', $negocio->ubicacion->ciudad ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                                <input id="provincia" type="text" name="provincia" value="{{ old('provincia', $negocio->ubicacion->provincia ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none">
                            </div>
                            <div class="hidden">
                                <input id="latitud" type="text" name="latitud" value="{{ old('latitud', $negocio->ubicacion->latitud ?? '') }}">
                                <input id="longitud" type="text" name="longitud" value="{{ old('longitud', $negocio->ubicacion->longitud ?? '') }}">
                                <input id="pais" type="text" name="pais" value="{{ old('pais', $negocio->ubicacion->pais ?? 'Perú') }}">
                                <input id="departamento" type="text" name="departamento" value="{{ old('departamento', $negocio->ubicacion->departamento ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categorías -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Categorías</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($categorias as $categoria)
                        <label class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 bg-white text-gray-700 cursor-pointer has-[:checked]:bg-primary-100 has-[:checked]:border-primary-300 transition-all">
                            <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}" class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500" {{ in_array($categoria->id_categoria, old('categorias', $negocio->categorias->pluck('id_categoria')->toArray())) ? 'checked' : '' }}>
                            <span class="font-medium">{{ $categoria->nombre_categoria }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Características -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Características</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($caracteristicas as $caracteristica)
                        <label class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 bg-white text-gray-700 cursor-pointer has-[:checked]:bg-primary-100 has-[:checked]:border-primary-300 transition-all">
                            <input type="checkbox" name="caracteristicas[]" value="{{ $caracteristica->id_caracteristica }}" class="form-checkbox rounded-full text-primary-600 focus:ring-primary-500" {{ in_array($caracteristica->id_caracteristica, old('caracteristicas', $negocio->caracteristicas->pluck('id_caracteristica')->toArray())) ? 'checked' : '' }}>
                            <span class="font-medium">{{ $caracteristica->nombre }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Horarios de Atención -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Horarios de Atención</h2>
                    <div class="space-y-3">
                        @php
                        $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
                        @endphp
                        @foreach ($dias as $dia)
                        @php
                        $horario = $horarios->firstWhere('dia_semana', $dia) ?? new \App\Models\Negocio\HorarioAtencion(['dia_semana' => $dia, 'cerrado' => true]);
                        $horarioId = $horario->id_horario ?? 'new_' . $dia;
                        @endphp
                        <div x-data="{ cerrado: {{ old('horarios.'.$horarioId.'.cerrado', $horario->cerrado) ? 'true' : 'false' }} }" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center bg-gray-50/80 p-4 rounded-xl border border-gray-200/60">
                            <div class="font-semibold text-primary-800 capitalize">{{ $dia }}</div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Apertura</label>
                                    <input type="time" name="horarios[{{ $horarioId }}][hora_apertura]" value="{{ old('horarios.'.$horarioId.'.hora_apertura', optional($horario)->hora_apertura) }}" :disabled="cerrado" class="w-full px-3 py-2 rounded-lg border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none disabled:bg-gray-200 disabled:cursor-not-allowed transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Cierre</label>
                                    <input type="time" name="horarios[{{ $horarioId }}][hora_cierre]" value="{{ old('horarios.'.$horarioId.'.hora_cierre', optional($horario)->hora_cierre) }}" :disabled="cerrado" class="w-full px-3 py-2 rounded-lg border-gray-200 focus:ring-2 focus:ring-primary-200 focus:outline-none disabled:bg-gray-200 disabled:cursor-not-allowed transition">
                                </div>
                            </div>
                            <div class="flex items-center justify-self-start md:justify-self-end">
                                <span class="text-sm font-medium mr-3 text-gray-700" x-text="cerrado ? 'Cerrado' : 'Abierto'"></span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="horarios[{{ $horarioId }}][cerrado]" value="1" class="sr-only peer" x-model="cerrado">
                                    <input type="hidden" name="horarios[{{ $horarioId }}][dia_semana]" value="{{ $dia }}">
                                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Servicios Predefinidos -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-primary-100/50 shadow-sm mb-12">
                    <h2 class="text-2xl font-bold text-primary-700 mb-6">Servicios predefinidos</h2>
                    @if(isset($categoriasServicio) && $categoriasServicio->isNotEmpty())
                        <div class="space-y-8">
                            @foreach($categoriasServicio as $catServ)
                                @if($catServ->serviciosPredefinidos->isNotEmpty())
                                    <div class="mb-2">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="text-lg font-bold text-primary-700">{{ $catServ->nombre_categoria_servicio }}</span>
                                            @if($catServ->descripcion)
                                                <span class="text-xs text-primary-400">{{ $catServ->descripcion }}</span>
                                            @endif
                                        </div>
                                        <div class="flex flex-wrap gap-3">
                                            @foreach($catServ->serviciosPredefinidos as $servicio)
                                                <label class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 bg-white text-gray-700 cursor-pointer shadow-sm hover:border-primary-400 transition-all">
                                                    <input type="checkbox" name="servicios_predefinidos[]" value="{{ $servicio->id_servicio_predefinido }}"
                                                        {{ in_array($servicio->id_servicio_predefinido, $negocio->serviciosPredefinidos->pluck('id_servicio_predefinido')->toArray()) ? 'checked' : '' }}>
                                                    <span class="font-medium">{{ $servicio->nombre_servicio }}</span>
                                                    @if($servicio->descripcion)
                                                        <span class="text-xs text-gray-400 ml-2">{{ $servicio->descripcion }}</span>
                                                    @endif
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
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-secondary-100/50 shadow-sm mb-12">
                    <h2 class="text-2xl font-bold text-secondary-700 mb-6">Servicios personalizados</h2>
                    <div id="servicios-personalizados-lista">
                        @foreach($negocio->serviciosPersonalizados as $i => $servicio)
                            <div class="servicio-personalizado-item flex flex-col md:flex-row gap-4 mb-4 items-end border-b pb-4">
                                <input type="hidden" name="servicios_personalizados[{{ $i }}][id]" value="{{ $servicio->id_servicio }}">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                    <input type="text" name="servicios_personalizados[{{ $i }}][nombre]" value="{{ old('servicios_personalizados.'.$i.'.nombre', $servicio->nombre_servicio) }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-secondary-200 focus:outline-none" required>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                    <input type="text" name="servicios_personalizados[{{ $i }}][descripcion]" value="{{ old('servicios_personalizados.'.$i.'.descripcion', $servicio->descripcion) }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-secondary-200 focus:outline-none">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio (S/)</label>
                                    <input type="number" name="servicios_personalizados[{{ $i }}][precio]" value="{{ old('servicios_personalizados.'.$i.'.precio', $servicio->precio) }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-secondary-200 focus:outline-none" min="0" step="0.01">
                                </div>
                                <div class="flex items-center">
                                    <label class="block text-sm font-medium text-gray-700 mb-1 mr-2">Disponible</label>
                                    <input type="checkbox" name="servicios_personalizados[{{ $i }}][disponible]" value="1" {{ $servicio->disponible ? 'checked' : '' }}>
                                </div>
                                <button type="button" class="text-red-500 ml-2" onclick="eliminarServicioPersonalizado(this)">Eliminar</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="agregarServicioPersonalizado()" class="mt-4 px-4 py-2 bg-secondary-100 rounded">Agregar servicio personalizado</button>
                </div>
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
            <div class=\"servicio-personalizado-item flex flex-col md:flex-row gap-4 mb-4 items-end border-b pb-4\">
                <div class=\"flex-1\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Nombre</label>
                    <input type=\"text\" name=\"servicios_personalizados[${index}][nombre]\" class=\"w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-secondary-200 focus:outline-none\" required>
                </div>
                <div class=\"flex-1\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Descripción</label>
                    <input type=\"text\" name=\"servicios_personalizados[${index}][descripcion]\" class=\"w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-secondary-200 focus:outline-none\">
                </div>
                <div class=\"flex-1\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Precio (S/)</label>
                    <input type=\"number\" name=\"servicios_personalizados[${index}][precio]\" class=\"w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-secondary-200 focus:outline-none\" min=\"0\" step=\"0.01\">
                </div>
                <div class=\"flex items-center\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1 mr-2\">Disponible</label>
                    <input type=\"checkbox\" name=\"servicios_personalizados[${index}][disponible]\" value=\"1\" checked>
                </div>
                <button type=\"button\" class=\"text-red-500 ml-2\" onclick=\"eliminarServicioPersonalizado(this)\">Eliminar</button>
            </div>
        `;
        lista.insertAdjacentHTML('beforeend', html);
    }
</script>

@endsection