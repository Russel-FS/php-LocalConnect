<div id="paso-4" class="hidden">
    <h3 class="text-3xl font-bold mb-2 text-gray-900">Servicios ofrecidos</h3>
    <p class="text-gray-600 mb-8">Selecciona los servicios predefinidos y/o agrega servicios personalizados.</p>
    <div class="space-y-8">
        <!-- Servicios predefinidos -->
        <div class="bg-gray-50 rounded-xl border border-gray-200 shadow-sm p-6">
            <label class="mb-4 text-gray-700 font-medium flex items-center gap-2">Servicios predefinidos
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
            <div class="flex flex-col items-center justify-center p-8 bg-gray-100 border border-gray-200 rounded-xl text-center text-gray-500 shadow-sm">
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
        <div id="servicios-personalizados" class="bg-gray-50 rounded-xl border border-gray-200 shadow-sm p-6">
            <label class="mb-4 text-gray-700 font-medium flex items-center gap-2">Servicios personalizados
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
                <input type="text" name="servicios_personalizados[nombre][]" placeholder="Nombre del servicio" class="w-full sm:w-1/4 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition" required>
                <input type="text" name="servicios_personalizados[descripcion][]" placeholder="Descripción" class="w-full sm:w-2/4 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition">
                <input type="number" name="servicios_personalizados[precio][]" placeholder="Precio" class="w-full sm:w-1/6 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition" min="0" step="0.01">
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