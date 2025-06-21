<div id="paso-5" class="hidden">
    <h3 class="text-3xl font-bold mb-2 text-gray-900">Horario y contacto</h3>
    <p class="text-gray-600 mb-8">¿Cómo pueden contactarte tus clientes?</p>
    <div class="space-y-6">
        <div>
            <label class="block mb-2 text-gray-700 font-medium">Horario de atención</label>
            <p class="text-xs text-gray-500 mb-4">Selecciona los días y horarios de atención</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @php
                $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
                @endphp
                @foreach($dias as $i => $dia)
                <div class="bg-white border border-gray-200 rounded-lg p-3 flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-700">{{ $dia }}</span>
                        <label class="flex items-center gap-2 text-xs select-none cursor-pointer relative">
                            <span class="text-gray-400">Cerrado</span>
                            <input type="checkbox" name="horarios[{{ $i }}][cerrado]" value="true" class="sr-only peer" data-dia="{{ $i }}" onchange="toggleCerrado(this)">
                            <!-- Campo hidden para enviar false cuando no está marcado -->
                            <input type="hidden" name="horarios[{{ $i }}][cerrado_hidden]" value="false">
                            <!--cuerpo-->
                            <div class="w-8 h-4 bg-gray-200 rounded-full relative transition peer-checked:bg-primary-400">
                            </div>
                            <!--circulo-->
                            <span class="absolute left-14.5 top-1 w-2 h-2 bg-white rounded-full shadow transition peer-checked:translate-x-4"></span>
                        </label>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </span>
                        <input type="time" name="horarios[{{ $i }}][inicio]" class="border border-gray-200 rounded px-2 py-1 focus:ring-1 focus:ring-primary-100 focus:border-primary-400 transition text-xs" />
                        <span class="mx-1 text-gray-300">a</span>
                        <input type="time" name="horarios[{{ $i }}][fin]" class="border border-gray-200 rounded px-2 py-1 focus:ring-1 focus:ring-primary-100 focus:border-primary-400 transition text-xs" />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Teléfono</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <x-icons.phone />
                    </span>
                    <input type="text" id="contacto-telefono" name="telefono" required class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Teléfono" />
                </div>
            </div>
            <div>
                <label class="block mb-2 text-gray-700 font-medium">WhatsApp</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <x-icons.whatsapp />
                    </span>
                    <input type="text" id="contacto-whatsapp" name="whatsapp" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="WhatsApp" />
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Facebook</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <x-icons.facebook />
                    </span>
                    <input type="text" id="contacto-facebook" name="facebook" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Facebook" />
                </div>
            </div>
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Instagram</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                        <x-icons.instagram />
                    </span>
                    <input type="text" id="contacto-instagram" name="instagram" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Instagram" />
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-gray-700 font-medium">Sitio web</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-600">
                    <x-icons.globe />
                </span>
                <input type="text" id="contacto-web" name="web" class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Sitio web" />
            </div>
        </div>
    </div>
    <div class="flex justify-between mt-10">
        <button class="btn-premium-outline" type="button" onclick="cambiarPaso(5,4)">Anterior</button>
        <button class="btn-premium" type="button" onclick="validarPaso(5,6)">Siguiente</button>
    </div>
</div>