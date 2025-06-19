<div class="absolute right-3 top-2 w-full max-w-xs mx-auto z-20">
    <input
        type="text"
        id="input-sugerencia"
        placeholder="Buscar dirección o lugar..."
        class="w-full px-4 py-2 rounded-full border border-gray-200 bg-white shadow focus:outline-none text-sm placeholder-gray-400 focus:border-primary-400 transition"
        autocomplete="off" />
    <div id="resultados-sugerencia" class="custom-scroll scroll-smooth absolute  right-0 mt-2 bg-white rounded-xl shadow-lg z-50 overflow-y-auto max-h-32 border border-gray-100 ">

    </div>
    {{ $slot }}
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
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(valor)}.json?access_token=${mapboxKey}&autocomplete=true&limit=5&language=es&country=PE`)
            .then(res => res.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    resultados.innerHTML = data.features.map(f =>
                        `<button type='button' class='w-full text-left px-5 py-3 hover:bg-primary-50 focus:bg-primary-100 transition-colors flex items-center gap-2 border-b last:border-b-0 border-gray-100 text-gray-700 font-medium text-sm' onclick='seleccionarSugerencia(${JSON.stringify(f)})'>
                           <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                              <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="2" />
                           </svg>
                            <span>${f.place_name}</span>
                        </button>`
                    ).join('');
                    resultados.style.display = 'block';
                } else {
                    resultados.innerHTML = '<div class="px-5 py-3 text-gray-400 text-sm">Sin resultados</div>';
                    resultados.style.display = 'block';
                }
            });
    });

    function seleccionarSugerencia(feature) {
        input.value = feature.place_name;
        resultados.innerHTML = '';
        resultados.style.display = 'none';
        console.log('Sugerencia seleccionada:', feature);
    }
</script>