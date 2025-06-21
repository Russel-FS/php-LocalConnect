<div id="paso-5" class="hidden">
    <h3 class="text-3xl font-bold mb-2 text-primary-700">Horario y contacto</h3>
    <p class="text-primary-400 mb-8">¿Cómo pueden contactarte tus clientes?</p>
    <div class="space-y-6">
        <div>
            <label class="block mb-2 text-primary-700 font-medium">Horario de atención</label>
            <p class="text-xs text-primary-400 mb-4">Selecciona los días y horarios de atención</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @php
                $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
                @endphp
                @foreach($dias as $i => $dia)
                <div class="bg-primary-50 border border-primary-200 rounded-lg p-3 flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-primary-700">{{ $dia }}</span>
                        <label class="flex items-center gap-2 text-xs select-none cursor-pointer relative">
                            <span class="text-primary-400">Cerrado</span>

                            <!-- Este input oculto  -->
                            <input type="hidden" name="horarios[{{ $i }}][cerrado]" value="0">
                            <!-- Este checkbox marca el estado  -->
                            <input type="checkbox" name="horarios[{{ $i }}][cerrado]" value="1" class="sr-only peer" onchange="toggleCerrado(this)">

                            <!--cuerpo-->
                            <div class="w-8 h-4 bg-primary-100 rounded-full relative transition peer-checked:bg-secondary-500">
                            </div>
                            <!--circulo-->
                            <span class="absolute left-14.5 top-1 w-2 h-2 bg-white rounded-full shadow transition peer-checked:translate-x-4"></span>
                        </label>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-primary-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </span>
                        <input type="time" name="horarios[{{ $i }}][inicio]" class="border border-primary-200 rounded px-2 py-1 focus:ring-1 focus:ring-primary-100 focus:border-primary-400 transition text-xs" />
                        <span class="mx-1 text-primary-200">a</span>
                        <input type="time" name="horarios[{{ $i }}][fin]" class="border border-primary-200 rounded px-2 py-1 focus:ring-1 focus:ring-primary-100 focus:border-primary-400 transition text-xs" />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-primary-700 font-medium">Teléfono</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-400">
                        <x-icons.outline.phone class="w-4 h-4" />
                    </span>
                    <input type="text" id="contacto-telefono" name="telefono" required class="w-full pl-9 pr-4 py-3 rounded-lg border border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Teléfono" value="{{ old('telefono') }}" />
                </div>
            </div>
            <div>
                <label class="block mb-2 text-primary-700 font-medium">WhatsApp</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-500">
                        <x-icons.solid.whatsapp class="w-4 h-4" />
                    </span>
                    <input type="text" id="contacto-whatsapp" name="whatsapp" class="w-full pl-9 pr-4 py-3 rounded-lg border border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="WhatsApp" value="{{ old('whatsapp') }}" />
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-primary-700 font-medium">Facebook</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-600">
                        <x-icons.solid.facebook class="w-4 h-4" />
                    </span>
                    <input type="text" id="contacto-facebook" name="facebook" class="w-full pl-9 pr-4 py-3 rounded-lg border border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Facebook" value="{{ old('facebook') }}" />
                </div>
            </div>
            <div>
                <label class="block mb-2 text-primary-700 font-medium">Instagram</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-pink-600">
                        <x-icons.solid.instagram class="w-4 h-4" />
                    </span>
                    <input type="text" id="contacto-instagram" name="instagram" class="w-full pl-9 pr-4 py-3 rounded-lg border border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Instagram" value="{{ old('instagram') }}" />
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-primary-700 font-medium">Sitio web</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-400">
                    <x-icons.outline.globe class="w-4 h-4" />
                </span>
                <input type="text" id="contacto-web" name="web" class="w-full pl-9 pr-4 py-3 rounded-lg border border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Sitio web" value="{{ old('web') }}" />
            </div>
        </div>
    </div>
    <div class="flex justify-between mt-10">
        <button class="btn-outline" type="button" onclick="cambiarPaso(5,4)">Anterior</button>
        <button class="btn-solid" type="button" onclick="validarPaso(5,6)">Siguiente</button>
    </div>
</div>