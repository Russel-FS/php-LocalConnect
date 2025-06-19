<div>
    <input
        type="text"
        id="input-sugerencia"
        placeholder="Buscar dirección o lugar..."
        class="z-50 absolute top-3 right-3 w-64 px-4 py-2 rounded-full border border-gray-200 bg-white shadow focus:outline-none text-sm placeholder-gray-400 focus:border-primary-400 transition"
        autocomplete="off" />
    <div id="resultados-sugerencia" class="absolute left-0 right-0 mt-2 bg-white shadow z-50"></div>
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
            return;
        }
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(valor)}.json?access_token=${mapboxKey}&autocomplete=true&limit=5&language=es&country=PE`)
            .then(res => res.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    resultados.innerHTML = data.features.map(f =>
                        `<div class='px-4 py-2 hover:bg-gray-100 cursor-pointer' onclick='seleccionarSugerencia(${JSON.stringify(f)})'>${f.place_name}</div>`
                    ).join('');
                } else {
                    resultados.innerHTML = '<div class=\"px-4 py-2 text-gray-400\">Sin resultados</div>';
                }
            });
    });

    function seleccionarSugerencia(feature) {
        input.value = feature.place_name;
        console.log('Sugerencia seleccionada:', feature);
    }
</script>