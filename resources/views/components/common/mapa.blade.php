<div id="map" class="w-full h-64 rounded-lg z-10"></div>
<script>
    let map = null;
    let marker = null;

    // Inicializar el mapa y el marcador
    function inicializarMapa() {
        let latitudInicial = -12.0464;
        let longitudInicial = -77.0428;

        const latitudInput = document.getElementById('latitud');
        const longitudInput = document.getElementById('longitud');

        if (latitudInput && longitudInput && latitudInput.value && longitudInput.value) {
            const lat = parseFloat(latitudInput.value);
            const lng = parseFloat(longitudInput.value);

            if (!isNaN(lat) && !isNaN(lng)) {
                latitudInicial = lat;
                longitudInicial = lng;
            }
        }

        if (!map) {
            map = L.map("map").setView([latitudInicial, longitudInicial], 17);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(map);
            const iconoPersonalizado = L.divIcon({
                className: "marcador-negocio",
                html: '<div class="w-6 h-6 bg-secondary-600 rounded-full border-2 border-white shadow-lg flex items-center justify-center"><div class="w-2 h-2 bg-white rounded-full"></div></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12],
            });
            marker = L.marker([latitudInicial, longitudInicial], {
                icon: iconoPersonalizado,
                draggable: true,
            }).addTo(map);
            map.on("click", function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                marker.setLatLng([lat, lng]);
                document.getElementById("latitud").value = lat.toFixed(6);
                document.getElementById("longitud").value = lng.toFixed(6);
                const mapContainer = document.getElementById("map");
                mapContainer.classList.remove("border-red-400", "border-2");
                map.setView([lat, lng], 17);
                window.actualizarMapaConCoordenadas(lat, lng);
            });
            marker.on("dragend", function(e) {
                const lat = e.target.getLatLng().lat;
                const lng = e.target.getLatLng().lng;
                document.getElementById("latitud").value = lat.toFixed(6);
                document.getElementById("longitud").value = lng.toFixed(6);
                const mapContainer = document.getElementById("map");
                mapContainer.classList.remove("border-red-400", "border-2");
                window.actualizarMapaConCoordenadas(lat, lng);
            });
        }
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    }
    // Esperar a que el que el domn este listo para inicializar el mapa
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('map')) {
            inicializarMapa();
        }
    });

    //funcion global para actualizar el mapa con coordenadas 
    window.actualizarMapaConCoordenadas = function(lat, lng) {
        if (map && marker) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 17);
            if (document.getElementById('latitud')) {
                document.getElementById('latitud').value = lat.toFixed(6);
            }
            if (document.getElementById('longitud')) {
                document.getElementById('longitud').value = lng.toFixed(6);
            }
        }
        obtenerDireccionDesdeCoordenadas(lat, lng);
    }

    // funcion para obtener direccion de las coordenadas
    function obtenerDireccionDesdeCoordenadas(lat, lng) {
        const mapboxKey = 'pk.eyJ1IjoicnVzc2VsLWZzIiwiYSI6ImNtYTJ5djZ3NDFidzcybHNmZjl6dTEweGkifQ.L1_wuZGVMGSOmSKazwjxJg';
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxKey}&language=es`)
            .then(res => res.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    let direccion = '';
                    let distrito = '';
                    let ciudad = '';
                    let provincia = '';
                    let departamento = '';
                    let pais = '';

                    const feature = data.features[0];
                    direccion = feature.place_name || '';

                    if (feature.context) {
                        feature.context.forEach(ctx => {
                            if (ctx.id.startsWith('locality.')) distrito = ctx.text;
                            if (ctx.id.startsWith('place.')) ciudad = ctx.text;
                            if (ctx.id.startsWith('region.')) provincia = ctx.text;
                            if (ctx.id.startsWith('country.')) pais = ctx.text;
                        });
                    }

                    if (feature.id.startsWith('locality.')) distrito = feature.text;
                    if (feature.id.startsWith('place.')) ciudad = feature.text;
                    if (feature.id.startsWith('region.')) provincia = feature.text;
                    if (feature.id.startsWith('country.')) pais = feature.text;

                    if (provincia === distrito) provincia = '';

                    //campos del formulario si existen
                    if (document.getElementById('direccion')) document.getElementById('direccion').value = direccion;
                    if (document.getElementById('distrito')) document.getElementById('distrito').value = distrito;
                    if (document.getElementById('ciudad')) document.getElementById('ciudad').value = ciudad;
                    if (document.getElementById('provincia')) document.getElementById('provincia').value = provincia;
                    if (document.getElementById('departamento')) document.getElementById('departamento').value = '';
                    if (document.getElementById('pais')) document.getElementById('pais').value = pais;
                }
            });
    }
</script>