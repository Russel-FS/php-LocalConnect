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
                    <!-- Paso 1: Datos del negocio -->
                    <div id="paso-1">
                        <h3 class="text-3xl font-bold mb-2 text-gray-900">Datos del negocio</h3>
                        <p class="text-gray-600 mb-8">Comencemos con la información básica de tu negocio</p>

                        <div class="space-y-8">
                            <!-- Nombre del negocio -->
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Nombre del negocio</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                                            <rect x="4" y="8" width="16" height="10" rx="4" stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <input type="text" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Panadería San Juan" />
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Descripción</label>
                                <textarea required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" rows="3" placeholder="Describe tu negocio, qué productos o servicios ofreces, tu historia, etc."></textarea>
                            </div>

                            <!-- Imagen de portada -->
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Imagen de portada</label>
                                <div class="space-y-4">
                                    <!-- Input file-->
                                    <div class="relative">
                                        <input type="file" id="imagen-portada" accept="image/*" required class="hidden" />
                                        <label for="imagen-portada" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500">
                                                    <span class="font-semibold">Haz clic para subir</span>
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    <div id="vista-previa-container" class="hidden">
                                        <div class="relative inline-block">
                                            <img id="vista-previa" class="w-48 h-32 object-cover rounded-lg border border-gray-200" alt="Vista previa" />
                                            <button type="button" onclick="eliminarImagen()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-10">
                            <button class="btn-premium" type="button" onclick="validarPaso(1,2)">Siguiente</button>
                        </div>
                    </div>

                    <!-- Paso 2: Ubicación -->
                    <div id="paso-2" class="hidden">
                        <h3 class="text-3xl font-bold mb-2 text-gray-900">Ubicación</h3>
                        <p class="text-gray-600 mb-8">¿Dónde se encuentra tu negocio?</p>

                        <div class="space-y-6">
                            <!-- Mapa -->
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Selecciona la ubicación en el mapa</label>
                                <div class="relative w-full h-full">
                                    <x-sugerencia></x-sugerencia>
                                    <x-mapa />
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Haz clic en el mapa para marcar la ubicación exacta de tu negocio</p>
                            </div>

                            <!-- Campos de dirección -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Dirección</label>
                                    <input type="text" id="direccion" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Calle, número, referencia" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Distrito</label>
                                    <input type="text" id="distrito" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Miraflores" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Ciudad</label>
                                    <input type="text" id="ciudad" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Lima" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Provincia</label>
                                    <input type="text" id="provincia" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Lima" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Departamento</label>
                                    <input type="text" id="departamento" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Lima" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">País</label>
                                    <input type="text" id="pais" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" value="Perú" />
                                </div>
                                <!-- Oculto latitud y longitud -->
                                <input type="hidden" id="latitud" name="latitud" />
                                <input type="hidden" id="longitud" name="longitud" />
                            </div>
                        </div>

                        <div class="flex justify-between mt-10">
                            <button class="btn-premium-outline" type="button" onclick="cambiarPaso(2,1)">Anterior</button>
                            <button class="btn-premium" type="button" onclick="validarPaso(2,3)">Siguiente</button>
                        </div>
                    </div>

                    <!-- Paso 3: Categorías -->
                    <div id="paso-3" class="hidden">
                        <h3 class="text-3xl font-bold mb-2 text-gray-900">Categorías</h3>
                        <p class="text-gray-600 mb-8">¿Qué tipo de negocio tienes?</p>

                        <div>
                            <label class="block mb-4 text-gray-700 font-medium">Selecciona una o más categorías</label>
                            @if($categorias->isEmpty())
                            <div class="flex flex-col items-center justify-center p-8 bg-gray-50 border border-gray-200 rounded-xl text-center text-gray-500 shadow-sm">
                                <svg class="w-12 h-12 mb-3 text-primary-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                </svg>
                                <span class="block text-lg font-semibold mb-1">No hay categorías disponibles</span>
                                <span class="text-sm">Por favor, contacta al administrador o intenta más tarde.</span>
                            </div>
                            @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-[420px] overflow-x-auto custom-scroll scroll-smooth">
                                @foreach($categorias as $categoria)
                                <label class="categoria-checkbox">
                                    <input type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria }}" class="hidden" />
                                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors bg-white shadow-sm">
                                        <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                            <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-900">{{ $categoria->nombre_categoria }}</span>
                                            <p class="text-xs text-gray-500 mt-1">{{ $categoria->descripcion }}</p>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="flex justify-between mt-10">
                            <button class="btn-premium-outline" type="button" onclick="cambiarPaso(3,2)">Anterior</button>
                            <button class="btn-premium" type="button" onclick="validarPaso(3,4)">Siguiente</button>
                        </div>
                    </div>

                    <!-- Paso 4: Servicios -->
                    <div id="paso-4" class="hidden">
                        <h3 class="text-3xl font-bold mb-2 text-gray-900">Servicios ofrecidos</h3>
                        <p class="text-gray-600 mb-8">Selecciona los servicios predefinidos y/o agrega servicios personalizados.</p>

                        <div class="space-y-8">
                            <!-- Servicios predefinidos -->
                            <div>
                                <label class=" mb-4 text-gray-700 font-medium flex items-center gap-2">Servicios predefinidos
                                    <span class="relative group">
                                        <svg class="w-4 h-4 text-primary-400 cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01" />
                                        </svg>
                                        <!-- Tooltip -->
                                        <span class="absolute left-6 top-0 z-10 hidden group-hover:block bg-white border border-gray-200 rounded-lg shadow px-3 py-2 text-xs text-gray-700 w-56">
                                            Selecciona servicios predefinidos para que tu negocio sea más fácil de encontrar en las búsquedas y mejorar tu posicionamiento.
                                        </span>
                                    </span>
                                </label>
                                <p class="text-xs text-primary-600 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                    </svg>
                                    Selecciona servicios predefinidos para que tu negocio sea más fácil de encontrar en las búsquedas.
                                </p>
                                @if($categoriasServicio->isEmpty())
                                <div class="flex flex-col items-center justify-center p-8 bg-gray-50 border border-gray-200 rounded-xl text-center text-gray-500 shadow-sm">
                                    <svg class="w-12 h-12 mb-3 text-primary-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                    </svg>
                                    <span class="block text-lg font-semibold mb-1">No hay categorías de servicios disponibles</span>
                                    <span class="text-sm">Por favor, contacta al administrador o intenta más tarde.</span>
                                </div>
                                @else
                                <div class="max-h-96 max-w-full overflow-auto pr-2 custom-scroll scroll-smooth">
                                    @foreach($categoriasServicio as $catServ)
                                    @if($catServ->serviciosPredefinidos->isNotEmpty())
                                    <div class="mb-6">
                                        <h4 class="text-lg font-bold text-primary-700 mb-2">{{ $catServ->nombre_categoria_servicio }}</h4>
                                        <p class="text-sm text-gray-500 mb-3">{{ $catServ->descripcion }}</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach($catServ->serviciosPredefinidos as $servicio)
                                            <label class="relative flex items-center p-4 bg-white rounded-xl shadow border border-gray-200 cursor-pointer transition hover:border-primary-400 group">
                                                <input type="checkbox" name="servicios_predefinidos[]" value="{{ $servicio->id_servicio_predefinido }}"
                                                    class="peer absolute left-4 top-4 w-5 h-5 accent-primary-600 rounded focus:ring-2 focus:ring-primary-200 transition" aria-label="Seleccionar {{ $servicio->nombre_servicio }}" />
                                                <div class="pl-8">
                                                    <span class="block font-semibold text-gray-900 group-hover:text-primary-600 transition">{{ $servicio->nombre_servicio }}</span>
                                                    <span class="block text-xs text-gray-500 mt-1">{{ $servicio->descripcion }}</span>
                                                </div>
                                                <span class="absolute left-4 top-4 w-5 h-5 border-2 border-primary-300 rounded bg-white peer-checked:bg-primary-600 peer-checked:border-primary-600 transition"></span>
                                                <svg class="absolute left-4 top-4 w-5 h-5 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <!-- Servicios personalizados -->
                            <div id="servicios-personalizados">
                                <label class=" mb-4 text-gray-700 font-medium flex items-center gap-2">Servicios personalizados
                                    <span class="relative group">
                                        <svg class="w-4 h-4 text-primary-400 cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01" />
                                        </svg>
                                        <!-- Tooltip -->
                                        <span class="absolute left-6 top-0 z-10 hidden group-hover:block bg-white border border-gray-200 rounded-lg shadow px-3 py-2 text-xs text-gray-700 w-56  group-hover:opacity-100 opacity-0 transition-opacity duration-300">
                                            Agrega servicios únicos que no estén en la lista predefinida para destacar tu negocio.
                                        </span>
                                    </span>
                                </label>
                                <div class="space-y-4" id="personalizados-lista">
                                    <!-- Aquí se agregan dinámicamente los campos -->
                                </div>
                                <button type="button" onclick="agregarServicioPersonalizado(this)" class="btn-premium-outline mt-2 flex items-center gap-2">
                                    <x-icons.plus></x-icons.plus>
                                    <span>Agregar servicio personalizado</span>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-between mt-10">
                            <button class="btn-premium-outline" type="button" onclick="cambiarPaso(4,3)">Anterior</button>
                            <button class="btn-premium" type="button" onclick="validarPaso(4,5)">Siguiente</button>
                        </div>
                    </div>

                    <!-- Paso 5: Horario y contacto -->
                    <div id="paso-5" class="hidden">
                        <h3 class="text-3xl font-bold mb-2 text-gray-900">Horario y contacto</h3>
                        <p class="text-gray-600 mb-8">¿Cómo pueden contactarte tus clientes?</p>

                        <div class="space-y-6">
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Horario de atención</label>
                                <p class="text-xs text-gray-500 mb-4">Selecciona los días y horarios de atención. Los horarios se almacenarán en UTC y se mostrarán en la zona horaria local del usuario.</p>
                                <div class="space-y-2">
                                    @php
                                    $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
                                    @endphp
                                    @foreach($dias as $i => $dia)
                                    <div class="flex items-center gap-2">
                                        <label class="w-24">{{ $dia }}</label>
                                        <input type="time" name="horarios[{{ $i }}][inicio]" class="border rounded px-2 py-1" />
                                        <span>a</span>
                                        <input type="time" name="horarios[{{ $i }}][fin]" class="border rounded px-2 py-1" />
                                        <label class="ml-4 flex items-center gap-1 text-sm">
                                            <input type="checkbox" name="horarios[{{ $i }}][cerrado]" onchange="toggleCerrado(this)"> Cerrado
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Teléfono</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                            <x-icons.phone />
                                        </span>
                                        <input type="text" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Teléfono" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">WhatsApp</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                            <x-icons.whatsapp />
                                        </span>
                                        <input type="text" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="WhatsApp" />
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Facebook</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                            <x-icons.facebook />
                                        </span>
                                        <input type="text" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Facebook" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700 font-medium">Instagram</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                            <x-icons.instagram />
                                        </span>
                                        <input type="text" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Instagram" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Sitio web</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                        <x-icons.globe />
                                    </span>
                                    <input type="text" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Sitio web" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-10">
                            <button class="btn-premium-outline" type="button" onclick="cambiarPaso(5,4)">Anterior</button>
                            <button class="btn-premium" type="button" onclick="validarPaso(5,6)">Siguiente</button>
                        </div>
                    </div>

                    <!-- Paso 6: Resumen -->
                    <div id="paso-6" class="hidden">
                        <h3 class="text-3xl font-bold mb-2 text-gray-900">Resumen</h3>
                        <p class="text-gray-600 mb-8">Revisa que todos los datos sean correctos</p>

                        <div class="bg-gray-50 rounded-lg p-6 text-gray-700">
                            <div class="mb-4">
                                <h4 class="font-semibold text-lg mb-2">Servicios seleccionados</h4>
                                <ul id="resumen-servicios" class="list-disc pl-6 space-y-1 text-sm">
                                    <!-- Aquí se mostrarán los servicios seleccionados con JS -->
                                </ul>
                            </div>
                            <p class="text-center">Revisa que todos los datos sean correctos antes de guardar tu negocio.</p>
                        </div>
                        <div class="flex justify-between mt-10">
                            <button class="btn-premium-outline" type="button" onclick="cambiarPaso(6,5)">Anterior</button>
                            <button class="btn-premium" type="submit">Guardar negocio</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    function toggleCerrado(checkbox) {
        const row = checkbox.closest('div.flex');
        const inputs = row.querySelectorAll('input[type="time"]');
        inputs.forEach(inp => inp.disabled = checkbox.checked);
    }
</script>

@endsection