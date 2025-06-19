@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <x-wizard-sidebar />

    <!-- Contenido principal -->
    <main class="flex-1">
        <div class="max-w-4xl mx-auto p-8 lg:p-16">
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
                        <div class="grid grid-cols-2 gap-4">
                            <label class="categoria-checkbox">
                                <input type="checkbox" name="categorias[]" value="restaurante" class="hidden" />
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                        <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Restaurante</span>
                                        <p class="text-sm text-gray-500">Comida y bebidas</p>
                                    </div>
                                </div>
                            </label>

                            <label class="categoria-checkbox">
                                <input type="checkbox" name="categorias[]" value="farmacia" class="hidden" />
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                        <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Farmacia</span>
                                        <p class="text-sm text-gray-500">Medicamentos y salud</p>
                                    </div>
                                </div>
                            </label>

                            <label class="categoria-checkbox">
                                <input type="checkbox" name="categorias[]" value="ferreteria" class="hidden" />
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                        <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Ferretería</span>
                                        <p class="text-sm text-gray-500">Herramientas y materiales</p>
                                    </div>
                                </div>
                            </label>

                            <label class="categoria-checkbox">
                                <input type="checkbox" name="categorias[]" value="servicios" class="hidden" />
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                        <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Servicios</span>
                                        <p class="text-sm text-gray-500">Servicios profesionales</p>
                                    </div>
                                </div>
                            </label>

                            <label class="categoria-checkbox">
                                <input type="checkbox" name="categorias[]" value="comercio" class="hidden" />
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                        <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Comercio</span>
                                        <p class="text-sm text-gray-500">Tiendas y retail</p>
                                    </div>
                                </div>
                            </label>

                            <label class="categoria-checkbox">
                                <input type="checkbox" name="categorias[]" value="otros" class="hidden" />
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-300 transition-colors">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded mr-3 flex items-center justify-center transition-colors">
                                        <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Otros</span>
                                        <p class="text-sm text-gray-500">Otras categorías</p>
                                    </div>
                                </div>
                            </label>
                        </div>
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
                            <label class="block mb-4 text-gray-700 font-medium">Servicios predefinidos</label>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($serviciosPredefinidos as $servicio)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="servicios_predefinidos[]" value="{{ $servicio->id_servicio_predefinido }}">
                                    <span>{{ $servicio->nombre_servicio }}</span>
                                    <span class="text-xs text-gray-400">{{ $servicio->descripcion }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Servicios personalizados -->
                        <div id="servicios-personalizados">
                            <label class="block mb-4 text-gray-700 font-medium">Servicios personalizados</label>
                            <div class="space-y-4" id="personalizados-lista">
                                <!-- Aquí se agregan dinámicamente los campos -->
                            </div>
                            <button type="button" onclick="agregarServicioPersonalizado()" class="btn-premium-outline mt-2">Agregar servicio personalizado</button>
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
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Lunes a viernes 8am - 8pm" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Teléfono</label>
                                <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">WhatsApp</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Facebook</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Instagram</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700 font-medium">Sitio web</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
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
                        <!-- Aquí se mostraría el resumen de todos los datos ingresados -->
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

<script>
    function agregarServicioPersonalizado() {
        const lista = document.getElementById('personalizados-lista');
        const div = document.createElement('div');
        div.className = 'flex gap-2 mb-2';
        div.innerHTML = `
        <input type="text" name="servicios_personalizados[nombre][]" placeholder="Nombre del servicio" class="w-full px-4 py-2 rounded-lg border border-gray-200" required>
        <input type="text" name="servicios_personalizados[descripcion][]" placeholder="Descripción" class="w-full px-4 py-2 rounded-lg border border-gray-200">
        <input type="number" name="servicios_personalizados[precio][]" placeholder="Precio" class="w-32 px-4 py-2 rounded-lg border border-gray-200" min="0" step="0.01">
        <button type="button" onclick="this.parentNode.remove()" class="text-red-500 hover:text-red-700">Quitar</button>
    `;
        lista.appendChild(div);
    }
</script>
@endsection