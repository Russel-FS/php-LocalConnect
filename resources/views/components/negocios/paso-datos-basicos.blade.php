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
                <input type="text" id="nombre-negocio" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Panadería San Juan" />
            </div>
        </div>
        <!-- Descripción -->
        <div>
            <label class="block mb-2 text-gray-700 font-medium">Descripción</label>
            <textarea id="descripcion-negocio" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" rows="3" placeholder="Describe tu negocio, qué productos o servicios ofreces, tu historia, etc."></textarea>
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