@extends('layouts.app')

@section('content')
<section class="section-premium bg-white min-h-[80vh] flex items-center justify-center">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-10 relative overflow-hidden">
        <h2 class="text-3xl font-extrabold mb-8 text-center tracking-tight">Registrar Negocio</h2>
        <form id="wizard-form">
            <!-- Paso 1: Datos del negocio -->
            <div id="paso-1">
                <h3 class="text-xl font-semibold mb-6">Datos del negocio</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block mb-2 text-gray-700">Nombre del negocio</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                                    <rect x="4" y="8" width="16" height="10" rx="4" stroke="#4f6d7a" stroke-width="1.5" />
                                </svg>
                            </span>
                            <input type="text" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Panadería San Juan" />
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-700">Descripción</label>
                        <textarea required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" rows="3" placeholder="Describe tu negocio"></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-700">Imagen de portada</label>
                        <input type="file" required class="w-full text-gray-600" />
                    </div>
                </div>
                <div class="flex justify-end mt-8">
                    <button class="btn-premium" type="button" onclick="cambiarPaso(1,2)">Siguiente</button>
                </div>
            </div>
            <!-- Paso 2: Ubicación -->
            <div id="paso-2" class="hidden">
                <h3 class="text-xl font-semibold mb-6">Ubicación</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block mb-2 text-gray-700">Dirección</label>
                        <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Calle, número, referencia" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-gray-700">Distrito</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700">Ciudad</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-gray-700">Provincia</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700">Departamento</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-700">País</label>
                        <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" value="Perú" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-gray-700">Latitud</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700">Longitud</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <button class="btn-premium-outline" type="button" onclick="cambiarPaso(2,1)">Anterior</button>
                    <button class="btn-premium" type="button" onclick="cambiarPaso(2,3)">Siguiente</button>
                </div>
            </div>
            <!-- Paso 3: Categorías -->
            <div id="paso-3" class="hidden">
                <h3 class="text-xl font-semibold mb-6">Categorías</h3>
                <div>
                    <label class="block mb-2 text-gray-700">Selecciona una o más categorías</label>
                    <select multiple required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition">
                        <option>Restaurante</option>
                        <option>Farmacia</option>
                        <option>Ferretería</option>
                        <option>Servicios</option>
                        <option>Otros</option>
                    </select>
                </div>
                <div class="flex justify-between mt-8">
                    <button class="btn-premium-outline" type="button" onclick="cambiarPaso(3,2)">Anterior</button>
                    <button class="btn-premium" type="button" onclick="cambiarPaso(3,4)">Siguiente</button>
                </div>
            </div>
            <!-- Paso 4: Servicios -->
            <div id="paso-4" class="hidden">
                <h3 class="text-xl font-semibold mb-6">Servicios ofrecidos</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-3 gap-4">
                        <input type="text" required class="col-span-1 px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Nombre" />
                        <input type="text" required class="col-span-1 px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Descripción" />
                        <input type="number" required class="col-span-1 px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Precio" />
                    </div>
                    <!-- Aquí se pueden agregar más servicios dinámicamente con JS -->
                </div>
                <div class="flex justify-between mt-8">
                    <button class="btn-premium-outline" type="button" onclick="cambiarPaso(4,3)">Anterior</button>
                    <button class="btn-premium" type="button" onclick="cambiarPaso(4,5)">Siguiente</button>
                </div>
            </div>
            <!-- Paso 5: Horario y contacto -->
            <div id="paso-5" class="hidden">
                <h3 class="text-xl font-semibold mb-6">Horario y contacto</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block mb-2 text-gray-700">Horario de atención</label>
                        <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Lunes a viernes 8am - 8pm" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-gray-700">Teléfono</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700">WhatsApp</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-gray-700">Facebook</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700">Instagram</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-700">Sitio web</label>
                        <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <button class="btn-premium-outline" type="button" onclick="cambiarPaso(5,4)">Anterior</button>
                    <button class="btn-premium" type="button" onclick="cambiarPaso(5,6)">Siguiente</button>
                </div>
            </div>
            <!-- Paso 6: Resumen -->
            <div id="paso-6" class="hidden">
                <h3 class="text-xl font-semibold mb-6">Resumen</h3>
                <div class="bg-gray-50 rounded-lg p-6 text-gray-700">
                    <!-- Aquí se mostraría el resumen de todos los datos ingresados -->
                    <p class="text-center">Revisa que todos los datos sean correctos antes de guardar tu negocio.</p>
                </div>
                <div class="flex justify-between mt-8">
                    <button class="btn-premium-outline" type="button" onclick="cambiarPaso(6,5)">Anterior</button>
                    <button class="btn-premium" type="submit">Guardar negocio</button>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    function cambiarPaso(actual, siguiente) {
        document.getElementById('paso-' + actual).classList.add('hidden');
        document.getElementById('paso-' + siguiente).classList.remove('hidden');
    }
</script>
@endsection