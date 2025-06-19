@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <aside class="hidden lg:flex flex-col w-80 bg-white rounded-2xl shadow-lg border border-gray-100 py-8 px-8 gap-8 sticky top-28 z-20 h-fit ml-8">
        <!-- Progreso -->
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-semibold text-gray-700">Progreso</span>
                <span id="progress-text" class="text-xs text-primary-600 font-bold">1 de 6</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progress-bar" class="bg-primary-600 h-2 rounded-full transition-all duration-300" style="width: 16.67%"></div>
            </div>
        </div>

        <ul id="wizard-sidebar" class="space-y-8">
            <li class="wizard-step-item" data-step="1">
                <div class="flex items-center gap-4">
                    <div class="step-circle">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                            <path d="M3 7h18M3 12h18M3 17h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <span class="step-label">Datos del negocio</span>
                        <p class="text-xs text-gray-400 mt-1">Información básica</p>
                    </div>
                </div>
            </li>

            <li class="wizard-step-item" data-step="2">
                <div class="flex items-center gap-4">
                    <div class="step-circle">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="currentColor" stroke-width="2" />
                            <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <span class="step-label">Ubicación</span>
                        <p class="text-xs text-gray-400 mt-1">Dirección y coordenadas</p>
                    </div>
                </div>
            </li>

            <li class="wizard-step-item" data-step="3">
                <div class="flex items-center gap-4">
                    <div class="step-circle">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                            <path d="M7 7h.01M7 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <span class="step-label">Categorías</span>
                        <p class="text-xs text-gray-400 mt-1">Tipo de negocio</p>
                    </div>
                </div>
            </li>

            <li class="wizard-step-item" data-step="4">
                <div class="flex items-center gap-4">
                    <div class="step-circle">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                            <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <span class="step-label">Servicios</span>
                        <p class="text-xs text-gray-400 mt-1">Productos y servicios</p>
                    </div>
                </div>
            </li>

            <li class="wizard-step-item" data-step="5">
                <div class="flex items-center gap-4">
                    <div class="step-circle">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <span class="step-label">Contacto</span>
                        <p class="text-xs text-gray-400 mt-1">Información de contacto</p>
                    </div>
                </div>
            </li>

            <li class="wizard-step-item" data-step="6">
                <div class="flex items-center gap-4">
                    <div class="step-circle">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                            <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <span class="step-label">Resumen</span>
                        <p class="text-xs text-gray-400 mt-1">Revisar información</p>
                    </div>
                </div>
            </li>
        </ul>
    </aside>

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
                        <div>
                            <label class="block mb-2 text-gray-700 font-medium">Dirección</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Calle, número, referencia" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Distrito</label>
                                <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Ciudad</label>
                                <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Provincia</label>
                                <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Departamento</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-700 font-medium">País</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" value="Perú" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Latitud</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-700 font-medium">Longitud</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" />
                            </div>
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
                    <p class="text-gray-600 mb-8">¿Qué servicios o productos ofreces?</p>

                    <div class="space-y-4">
                        <div class="grid grid-cols-3 gap-4">
                            <input type="text" required class="col-span-1 px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Nombre" />
                            <input type="text" required class="col-span-1 px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Descripción" />
                            <input type="number" required class="col-span-1 px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Precio" />
                        </div>
                        <!-- Aquí se pueden agregar más servicios dinámicamente con JS -->
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
@endsection