<div id="map" class="w-full h-64 rounded-lg border border-gray-200 z-40"></div>
<script>
    let map = null;
    let marker = null;

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
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('map')) {
            inicializarMapa();
        }
    });
</script>