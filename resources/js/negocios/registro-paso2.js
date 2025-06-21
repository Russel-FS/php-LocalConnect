// Validación específica del paso 2
window.validarPaso2 = function () {
    const latitud = document.getElementById("latitud");
    const longitud = document.getElementById("longitud");
    const direccion = document.getElementById("direccion");
    const distrito = document.getElementById("distrito");
    const ciudad = document.getElementById("ciudad");
    const provincia = document.getElementById("provincia");
    const pais = document.getElementById("pais");
    const mapContainer = document.getElementById("map");
    let valido = true;

    // Validar campos requeridos de ubicación
    const camposRequeridos = [direccion, pais];
    camposRequeridos.forEach((campo) => {
        if (!campo.value.trim()) {
            campo.classList.add("border-red-400");
            valido = false;
        } else {
            campo.classList.remove("border-red-400");
        }
    });

    // Validar coordenadas del mapa
    if (!latitud.value || !longitud.value) {
        if (mapContainer) {
            mapContainer.classList.add("border-red-400", "border-2");
        }
        valido = false;
    } else {
        // Limpiar error del mapa
        if (mapContainer) {
            mapContainer.classList.remove("border-red-400", "border-2");
        }
    }

    return valido;
};
