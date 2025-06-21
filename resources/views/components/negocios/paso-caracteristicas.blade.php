<div class="hidden" id="paso-5">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-primary-800 mb-2">Características del negocio</h2>
        <p class="text-primary-600">Selecciona las características que mejor describan tu negocio</p>
    </div>

    <div class="space-y-8">
        @foreach($categoriasCaracteristica as $categoria)
        <div class="border border-gray-200 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-primary-700 mb-4 flex items-center gap-2">
                <x-icons.outline.check-circle class="w-5 h-5 text-primary-400" />
                {{ $categoria->nombre_categoria }}
            </h3>
            @if($categoria->descripcion)
            <p class="text-sm text-primary-500 mb-4">{{ $categoria->descripcion }}</p>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($categoria->caracteristicas as $caracteristica)
                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-primary-50 hover:border-primary-300 cursor-pointer transition-colors">
                    <input
                        type="checkbox"
                        name="caracteristicas[]"
                        value="{{ $caracteristica->id_caracteristica }}"
                        class="w-4 h-4 text-secondary-600 focus:ring-secondary-500 border-primary-300 rounded">
                    <span class="ml-3 text-sm font-medium text-primary-700">{{ $caracteristica->nombre }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex justify-between mt-8">
        <button type="button" class="btn-outline" onclick="cambiarPaso(5, 4)">
            Anterior
        </button>
        <button type="button" class="btn-solid" onclick="cambiarPaso(5, 6)">
            Siguiente
        </button>
    </div>
</div>