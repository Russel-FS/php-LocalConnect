// Validación específica del paso 2
window.validarPaso2 = function () {
    const latitud = document.getElementById("latitud");
    const longitud = document.getElementById("longitud");
    const direccion = document.getElementById("direccion");
    const pais = document.getElementById("pais");
    const mapContainer = document.getElementById("map");
    let valido = true;
    let mensajeError = "";

    // Validar campos requeridos de ubicación
    if (!direccion.value.trim()) {
        direccion.classList.add("border-red-400");
        mensajeError = "La dirección es obligatoria";
        valido = false;
    } else {
        direccion.classList.remove("border-red-400");
    }

    // Validar país (solo si la dirección está bien)
    if (valido && !pais.value.trim()) {
        pais.classList.add("border-red-400");
        mensajeError = "El país es obligatorio";
        valido = false;
    } else {
        pais.classList.remove("border-red-400");
    }

    // Validar coordenadas del mapa (solo si los campos están bien)
    if (valido && (!latitud.value || !longitud.value)) {
        if (mapContainer) {
            mapContainer.classList.add("border-red-400", "border-2");
        }
        mensajeError = "Debes seleccionar una ubicación en el mapa";
        valido = false;
    } else {
        if (mapContainer) {
            mapContainer.classList.remove("border-red-400", "border-2");
        }
    }

    // Mostrar mensaje de error si hay problemas
    if (!valido && window.notyf) {
        window.notyf.dismissAll();
        window.notyf.open({
            type: "error",
            message: mensajeError,
        });
    }

    return valido;
};
