<div id="paso-1">
    <h3 class="text-3xl font-bold mb-2 text-primary-700">Datos del negocio</h3>
    <p class="text-primary-500 mb-8">Comencemos con la información básica de tu negocio</p>
    <div class="space-y-8">
        <!-- Nombre del negocio -->
        <div>
            <label class="block mb-2 text-primary-600 font-medium">Nombre del negocio</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-400">
                    <x-icons.form.email />
                </span>
                <input type="text" id="nombre-negocio" name="nombre_negocio" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" placeholder="Ej: Panadería San Juan" value="{{ old('nombre_negocio') }}" />
            </div>
            @if($errors->has('nombre_negocio'))
            <span class="text-red-500 text-xs mt-1 block">{{ $errors->first('nombre_negocio') }}</span>
            @endif
        </div>
        <!-- Descripción -->
        <div>
            <label class="block mb-2 text-primary-600 font-medium">Descripción</label>
            <textarea id="descripcion-negocio" name="descripcion_negocio" required class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" rows="3" placeholder="Describe tu negocio, qué productos o servicios ofreces, tu historia, etc.">{{ old('descripcion_negocio') }}</textarea>
            @if($errors->has('descripcion_negocio'))
            <span class="text-red-500 text-xs mt-1 block">{{ $errors->first('descripcion_negocio') }}</span>
            @endif
        </div>
        <!-- Imagen de portada -->
        <div>
            <label class="block mb-2 text-primary-600 font-medium">Imagen de portada</label>
            <div class="space-y-4">
                <!-- Input file-->
                <div class="relative">
                    <input type="file" id="imagen-portada" name="imagen_portada" accept="image/*" required class="hidden" />
                    <label for="imagen-portada" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-primary-200 rounded-lg cursor-pointer bg-primary-50 hover:bg-primary-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mb-2 text-sm text-primary-500">
                                <span class="font-semibold">Haz clic para subir</span>
                            </p>
                            <p class="text-xs text-primary-400">PNG, JPG, GIF hasta 10MB</p>
                        </div>
                    </label>
                </div>
                <!-- Vista previa de la imagen -->
                <div id="vista-previa-container" class="hidden">
                    <div class="relative inline-block">
                        <img id="vista-previa" class="w-48 h-32 object-cover rounded-lg border border-primary-200" alt="Vista previa" />
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
        <button class="btn-solid" type="button" onclick="validarPaso(1,2)">Siguiente</button>
    </div>
</div>