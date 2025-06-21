<div id="paso-2" class="hidden">
    <h3 class="text-3xl font-bold mb-2 text-primary-700">Ubicación</h3>
    <p class="text-primary-500 mb-8">¿Dónde se encuentra tu negocio?</p>
    <div class="space-y-6">
        <!-- Mapa -->
        <div>
            <label class="block mb-2 text-primary-600 font-medium">Selecciona la ubicación en el mapa</label>
            <div class="relative w-full h-full">
                <x-common.sugerencia />
                <x-common.mapa />
            </div>
            <p class="text-sm text-primary-400 mt-2">Haz clic en el mapa para marcar la ubicación exacta de tu negocio</p>
        </div>
        <!-- Campos de dirección -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2 text-primary-600 font-medium">Dirección <span class="text-red-500">*</span></label>
                <input type="text" id="direccion" name="direccion" required class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" placeholder="Calle, número, referencia" />
            </div>
            <div>
                <label class="block mb-2 text-primary-600 font-medium">Distrito <span class="text-primary-400 text-xs">(opcional)</span></label>
                <input type="text" id="distrito" name="distrito" class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" placeholder="Ej: Miraflores" />
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div>
                <label class="block mb-2 text-primary-600 font-medium">Ciudad <span class="text-primary-400 text-xs">(opcional)</span></label>
                <input type="text" id="ciudad" name="ciudad" class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" placeholder="Ej: Lima" />
            </div>
            <div>
                <label class="block mb-2 text-primary-600 font-medium">Provincia <span class="text-primary-400 text-xs">(opcional)</span></label>
                <input type="text" id="provincia" name="provincia" class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" placeholder="Ej: Lima" />
            </div>
            <div>
                <label class="block mb-2 text-primary-600 font-medium">Departamento <span class="text-primary-400 text-xs">(opcional)</span></label>
                <input type="text" id="departamento" name="departamento" class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" placeholder="Ej: Lima" />
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div>
                <label class="block mb-2 text-primary-600 font-medium">País <span class="text-red-500">*</span></label>
                <input type="text" id="pais" name="pais" required class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-500/20 outline-none transition" value="Perú" />
            </div>
            <!-- Oculto latitud y longitud -->
            <input type="hidden" id="latitud" name="latitud" />
            <input type="hidden" id="longitud" name="longitud" />
        </div>
    </div>
    <div class="flex justify-between mt-10">
        <button class="btn-outline" type="button" onclick="cambiarPaso(2,1)">Anterior</button>
        <button class="btn-solid" type="button" onclick="validarPaso(2,3)">Siguiente</button>
    </div>
</div>