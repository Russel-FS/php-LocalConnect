<div id="mapa-ubicacion" class="w-full h-full rounded-2xl overflow-hidden shadow-lg border border-primary-100"></div>

<script>
    let mapaUbicacion = null;
    let marcadorUbicacion = null;

    function inicializarMapaUbicacion() {
        const latitud = <?php echo $negocio->ubicacion->latitud ?? -12.0464; ?>;
        const longitud = <?php echo $negocio->ubicacion->longitud ?? -77.0428; ?>;

        if (!mapaUbicacion) {
            mapaUbicacion = L.map("mapa-ubicacion").setView([latitud, longitud], 16);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(mapaUbicacion);

            const iconoNegocio = L.divIcon({
                className: "marcador-negocio-ubicacion",
                html: '<div class="w-8 h-8 bg-secondary-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            marcadorUbicacion = L.marker([latitud, longitud], {
                icon: iconoNegocio,
                draggable: false
            }).addTo(mapaUbicacion);

            const popupContent = '<div class="p-3"><div class="font-semibold text-gray-800"><?php echo addslashes($negocio->nombre_negocio); ?></div><div class="text-gray-600 text-sm mt-1"><?php echo addslashes($negocio->ubicacion->direccion); ?></div></div>';

            marcadorUbicacion.bindPopup(popupContent);
        }

        setTimeout(() => {
            mapaUbicacion.invalidateSize();
        }, 100);
    }

    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('mapa-ubicacion')) {
            inicializarMapaUbicacion();
        }
    });
</script>

<style>
    .marcador-negocio-ubicacion {
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    #mapa-ubicacion {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    #mapa-ubicacion .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }

    #mapa-ubicacion .leaflet-popup-tip {
        background: white;
        border: 1px solid #e2e8f0;
    }
</style>