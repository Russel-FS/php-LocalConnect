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