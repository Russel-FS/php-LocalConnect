<div class="absolute right-3 top-2 w-full max-w-md mx-auto z-20">
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" stroke-width="2" />
                <path stroke-linecap="round" stroke-width="2" d="M21 21l-2-2" />
            </svg>
        </span>
        <input
            type="text"
            id="input-sugerencia"
            placeholder="Buscar dirección o lugar..."
            class="w-full pl-10 pr-4 py-2.5 rounded-full border border-primary-200 bg-white shadow-sm focus:outline-none text-sm placeholder-primary-400 focus:border-secondary-700  transition"
            autocomplete="off" />
    </div>
    <div id="resultados-sugerencia" class="custom-scroll scroll-smooth absolute right-0 mt-2 bg-white rounded-xl shadow-lg z-50 overflow-y-auto max-h-60 border border-primary-100 w-full min-w-[250px]" style="display:none;">
    </div>
</div>

<script>
    const input = document.getElementById('input-sugerencia');
    const resultados = document.getElementById('resultados-sugerencia');
    const mapboxKey = 'pk.eyJ1IjoicnVzc2VsLWZzIiwiYSI6ImNtYTJ5djZ3NDFidzcybHNmZjl6dTEweGkifQ.L1_wuZGVMGSOmSKazwjxJg';

    input.addEventListener('input', function() {
        const valor = input.value.trim();
        if (valor.length < 3) {
            resultados.innerHTML = '';
            resultados.style.display = 'none';
            return;
        }
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(valor)}.json?access_token=${mapboxKey}&autocomplete=true&limit=5&language=es`)
            .then(res => res.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    resultados.innerHTML = data.features.map(f => {
                        const mainText = f.text;
                        const contextText = f.context ? f.context.map(c => c.text).join(', ') : '';

                        return `<button type='button' class='w-full text-left px-4 py-3 hover:bg-primary-50 focus:bg-primary-50 focus:outline-none transition-colors flex items-center gap-4 border-b last:border-b-0 border-primary-100' onclick='seleccionarSugerencia(${JSON.stringify(f)})'>
                           <div class="flex-shrink-0">
                               <svg class="w-5 h-5 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                  <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="2" />
                               </svg>
                           </div>
                           <div class="text-sm overflow-hidden">
                                <p class="font-semibold text-primary-700 truncate">${mainText}</p>
                                <p class="text-primary-500 truncate">${contextText}</p>
                           </div>
                        </button>`
                    }).join('');
                    resultados.style.display = 'block';
                } else {
                    resultados.innerHTML = '<div class="px-5 py-3 text-primary-400 text-sm">Sin resultados</div>';
                    resultados.style.display = 'block';
                }
            });
    });

    function seleccionarSugerencia(feature) {
        input.value = feature.place_name;
        resultados.innerHTML = '';
        resultados.style.display = 'none';
        if (window.actualizarMapaConCoordenadas && feature.center) {
            window.actualizarMapaConCoordenadas(feature.center[1], feature.center[0]);
        }
        if (document.getElementById('latitud')) {
            document.getElementById('latitud').value = feature.center[1].toFixed(6);
        }
        if (document.getElementById('longitud')) {
            document.getElementById('longitud').value = feature.center[0].toFixed(6);
        }
    }
</script>