<div id="paso-4" class="hidden">
    <h3 class="text-3xl font-bold mb-2 text-primary-700">Servicios ofrecidos</h3>
    <p class="text-primary-400 mb-8">Selecciona los servicios predefinidos y/o agrega servicios personalizados.</p>
    <div class="space-y-8">
        <!-- Servicios predefinidos -->
        <div class="bg-primary-50 rounded-xl border border-primary-200 shadow-sm p-6" id="servicios-predefinidos-contenedor">
            <label class="mb-4 text-primary-700 font-medium flex items-center gap-2">Servicios predefinidos
                <span class="relative group">
                    <svg class="w-4 h-4 text-secondary-500 cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01" />
                    </svg>
                    <!-- Tooltip -->
                    <span class="absolute left-6 top-0 z-10 hidden group-hover:block bg-white border border-secondary-200 rounded-lg shadow px-3 py-2 text-xs text-secondary-700 w-56">
                        Selecciona servicios predefinidos para que tu negocio sea más fácil de encontrar en las búsquedas y mejorar tu posicionamiento.
                    </span>
                </span>
            </label>
            <p class="text-xs text-primary-600 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 inline-block text-secondary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                </svg>
                Selecciona servicios predefinidos para que tu negocio sea más fácil de encontrar en las búsquedas.
            </p>
            @if($categoriasServicio->isEmpty())
            <div class="flex flex-col items-center justify-center p-8 bg-primary-100 border border-primary-200 rounded-xl text-center text-primary-400 shadow-sm">
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
                    <p class="text-sm text-primary-400 mb-3">{{ $catServ->descripcion }}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($catServ->serviciosPredefinidos as $servicio)
                        <label class="relative flex items-center p-4 bg-white rounded-xl shadow border border-primary-200 cursor-pointer transition hover:border-primary-400 group">
                            <input type="checkbox" name="servicios_predefinidos[]" value="{{ $servicio->id_servicio_predefinido }}"
                                class="peer absolute left-4 top-4 w-5 h-5 accent-primary-600 rounded focus:ring-2 focus:ring-primary-200 transition" aria-label="Seleccionar {{ $servicio->nombre_servicio }}" />
                            <div class="pl-8">
                                <span class="block font-semibold text-primary-700 group-hover:text-primary-600 transition">{{ $servicio->nombre_servicio }}</span>
                                <span class="block text-xs text-primary-400 mt-1">{{ $servicio->descripcion }}</span>
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
        <div class="bg-secondary-50 rounded-xl border border-secondary-200 shadow-sm p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-secondary-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-secondary-700">Servicios Personalizados</h3>
                    <p class="text-secondary-500">Agrega servicios únicos que no estén en la lista predefinida</p>
                </div>
            </div>

            <div id="servicios-personalizados" class="space-y-4">
                <!-- Los servicios personalizados se agregarán aquí mediante JavaScript -->
            </div>

            <button type="button" onclick="agregarServicioPersonalizado()"
                class="mt-6 w-full flex items-center justify-center gap-3 px-6 py-3 bg-secondary-100 border border-secondary-200 text-secondary-700 rounded-xl hover:bg-secondary-200 hover:border-secondary-300 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="font-medium">Agregar servicio personalizado</span>
            </button>
        </div>
    </div>
    <div class="flex justify-between mt-10">
        <button class="btn-outline" type="button" onclick="cambiarPaso(4,3)">Anterior</button>
        <button class="btn-solid" type="button" onclick="validarPaso(4,5)">Siguiente</button>
    </div>
</div>