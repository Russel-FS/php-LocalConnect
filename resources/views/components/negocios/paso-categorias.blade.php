<div id="paso-3" class="hidden">
    <h3 class="text-3xl font-bold mb-2 text-primary-700">Categorías</h3>
    <p class="text-primary-500 mb-8">¿Qué tipo de negocio tienes?</p>
    <div class="bg-white rounded-xl border border-primary-200 shadow-sm p-6 " id="categoria-contenedor">
        <label class="block mb-4 text-primary-600 font-medium">Selecciona una o más categorías <span class="text-red-500">*</span></label>
        @if($categorias->isEmpty())
        <div class="flex flex-col items-center justify-center p-8 bg-primary-100 border border-primary-200 rounded-xl text-center text-primary-400 shadow-sm">
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
                <div class="flex items-center p-4 border-2 border-primary-200 rounded-lg cursor-pointer transition-colors bg-white shadow-sm">
                    <div class="w-5 h-5 border-2 border-primary-200 rounded mr-3 flex items-center justify-center transition-colors">
                        <svg class="w-3 h-3 text-white check-icon" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 20 20" style="display:none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-medium text-primary-700">{{ $categoria->nombre_categoria }}</span>
                        <p class="text-xs text-primary-400 mt-1">{{ $categoria->descripcion }}</p>
                    </div>
                </div>
            </label>
            @endforeach
        </div>
        @endif
    </div>
    <div class="flex justify-between mt-10">
        <button class="btn-outline" type="button" onclick="cambiarPaso(3,2)">Anterior</button>
        <button class="btn-solid" type="button" onclick="validarPaso(3,4)">Siguiente</button>
    </div>
</div>