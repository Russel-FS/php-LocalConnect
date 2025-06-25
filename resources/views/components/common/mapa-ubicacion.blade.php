<div id="mapa-ubicacion" class="w-full h-full rounded-2xl overflow-hidden shadow-lg border border-primary-100" style="min-height: 400px;"></div>

<script>
    let mapaUbicacion = null;
    let marcadorUbicacion = null;

    function inicializarMapaUbicacion() {
        // Verificar leaflet
        if (typeof L === 'undefined') {
            console.error('Leaflet no está cargado');
            return;
        }

        const latitud = <?php echo $negocio->ubicacion->latitud ?? -12.0464; ?>;
        const longitud = <?php echo $negocio->ubicacion->longitud ?? -77.0428; ?>;

        const mapContainer = document.getElementById('mapa-ubicacion');
        if (!mapContainer) {
            console.error('Contenedor del mapa no encontrado');
            return;
        }

        try {
            //  mapa
            mapaUbicacion = L.map('mapa-ubicacion', {
                center: [latitud, longitud],
                zoom: 16,
                zoomControl: true,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                keyboard: false,
                dragging: true,
                touchZoom: true
            });

            // Agregar capa de tilesss xd
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(mapaUbicacion);

            // Icono personalizado para el negocio
            const iconoNegocio = L.divIcon({
                className: 'marcador-negocio-ubicacion',
                html: '<div class="w-10 h-10 bg-secondary-500 rounded-full border-4 border-white shadow-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>',
                iconSize: [40, 40],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            // marcador
            marcadorUbicacion = L.marker([latitud, longitud], {
                icon: iconoNegocio,
                draggable: false
            }).addTo(mapaUbicacion);

            // Contenido del popup
            const popupContent = `
                <div class="p-4">
                    <div class="font-bold text-gray-800 text-lg mb-2"><?php echo addslashes($negocio->nombre_negocio); ?></div>
                    <div class="text-gray-600 text-sm"><?php echo addslashes($negocio->ubicacion->direccion); ?></div>
                </div>
            `;

            // Agregar popup al marcador
            marcadorUbicacion.bindPopup(popupContent);

            // esperar
            setTimeout(() => {
                if (mapaUbicacion) {
                    mapaUbicacion.invalidateSize();
                    mapaUbicacion.setView([latitud, longitud], 16);
                }
            }, 200);

        } catch (error) {
            console.error('Error al inicializar el mapa:', error);
            mapContainer.innerHTML = '<div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-500">Error al cargar el mapa</div>';
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', inicializarMapaUbicacion);
    } else {
        inicializarMapaUbicacion();
    }

    // Función global para actualizar  
    window.actualizarMapaUbicacion = function(lat, lng) {
        if (mapaUbicacion && marcadorUbicacion) {
            marcadorUbicacion.setLatLng([lat, lng]);
            mapaUbicacion.setView([lat, lng], 16);
        }
    };
</script>

<style>
    .marcador-negocio-ubicacion {
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
    }

    #mapa-ubicacion {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        z-index: 1;
    }

    #mapa-ubicacion .leaflet-popup-content-wrapper {
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        border: 1px solid #e2e8f0;
        backdrop-filter: blur(8px);
    }

    #mapa-ubicacion .leaflet-popup-tip {
        background: white;
        border: 1px solid #e2e8f0;
    }

    #mapa-ubicacion .leaflet-control-zoom {
        border: none;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    #mapa-ubicacion .leaflet-control-zoom a {
        background: white;
        border: none;
        color: #374151;
        font-weight: 600;
        transition: all 0.2s;
    }

    #mapa-ubicacion .leaflet-control-zoom a:hover {
        background: #f3f4f6;
        color: #1f2937;
    }
</style>