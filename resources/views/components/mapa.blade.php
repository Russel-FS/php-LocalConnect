<div id="map" class="w-full h-64 rounded-lg border border-gray-200 z-10"></div>
<script>
    let map = null;
    let marker = null;

    // Inicializar el mapa y el marcador
    function inicializarMapa() {
        const latitudDefault = -12.0464;
        const longitudDefault = -77.0428;
        if (!map) {
            map = L.map("map").setView([latitudDefault, longitudDefault], 13);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(map);
            const iconoPersonalizado = L.divIcon({
                className: "marcador-negocio",
                html: '<div class="w-6 h-6 bg-primary-600 rounded-full border-2 border-white shadow-lg flex items-center justify-center"><div class="w-2 h-2 bg-white rounded-full"></div></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12],
            });
            marker = L.marker([latitudDefault, longitudDefault], {
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
            });
            marker.on("dragend", function(e) {
                const lat = e.target.getLatLng().lat;
                const lng = e.target.getLatLng().lng;
                document.getElementById("latitud").value = lat.toFixed(6);
                document.getElementById("longitud").value = lng.toFixed(6);
                const mapContainer = document.getElementById("map");
                mapContainer.classList.remove("border-red-400", "border-2");
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
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxKey}&language=es&country=PE`)
            .then(res => res.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    let direccion = '';
                    let distrito = '';
                    let ciudad = '';
                    let provincia = '';
                    let departamento = '';
                    let pais = '';

                    // filtrar los datos encontrados
                    data.features.forEach(f => {
                        if (f.place_type.includes('address')) direccion = f.place_name;
                        if (f.place_type.includes('place')) ciudad = f.text;
                        if (f.place_type.includes('region')) departamento = f.text;
                        if (f.place_type.includes('district')) distrito = f.text;
                        if (f.place_type.includes('locality')) provincia = f.text;
                        if (f.place_type.includes('country')) pais = f.text;
                    });

                    // datos encontrados mostrar al input 
                    if (document.getElementById('direccion')) document.getElementById('direccion').value = direccion;
                    if (document.getElementById('distrito')) document.getElementById('distrito').value = distrito;
                    if (document.getElementById('ciudad')) document.getElementById('ciudad').value = ciudad;
                    if (document.getElementById('provincia')) document.getElementById('provincia').value = provincia;
                    if (document.getElementById('departamento')) document.getElementById('departamento').value = departamento;
                    if (document.getElementById('pais')) document.getElementById('pais').value = pais;
                }
            });
    }
</script>