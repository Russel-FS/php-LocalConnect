// Paso 2: Validación de ubicación

window.validarUbicacion = function () {
    const latitud = document.getElementById("latitud").value;
    const longitud = document.getElementById("longitud").value;
    const mapContainer = document.getElementById("map");
    if (!latitud || !longitud) {
        if (mapContainer)
            mapContainer.classList.add("border-red-400", "border-2");
        return false;
    } else {
        if (mapContainer)
            mapContainer.classList.remove("border-red-400", "border-2");
        return true;
    }
};
