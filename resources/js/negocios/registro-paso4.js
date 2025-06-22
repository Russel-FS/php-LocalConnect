// Función para agregar un nuevo servicio personalizado
window.agregarServicioPersonalizado = function () {
    const contenedor = document.getElementById("servicios-personalizados");
    if (!contenedor) return;

    const nuevoServicio = document.createElement("div");
    nuevoServicio.className =
        "servicio-item bg-white rounded-xl shadow border border-gray-200 p-6 mb-4";

    nuevoServicio.innerHTML = `
        <div class="flex items-center gap-4 mb-4">
            <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                </svg>
            </div>
            <h4 class="font-semibold text-primary-700">Servicio Personalizado</h4>
            <button type="button" onclick="eliminarServicioPersonalizado(this)" 
                    class="ml-auto px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors text-sm">
                Eliminar
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del servicio</label>
                <input type="text" name="servicios_personalizados[nombre][]" placeholder="Ej: Masaje personalizado" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                <input type="text" name="servicios_personalizados[descripcion][]" placeholder="Descripción del servicio" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Precio (S/)</label>
                <input type="number" name="servicios_personalizados[precio][]" placeholder="0.00" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                       min="0" step="0.01">
            </div>
        </div>
    `;

    contenedor.appendChild(nuevoServicio);
};

// Función para eliminar servicio personalizado
window.eliminarServicioPersonalizado = function (boton) {
    const servicioItem = boton.closest(".servicio-item");
    if (servicioItem) {
        servicioItem.remove();
    }
};

// Validación específica del paso 4
window.validarPaso4 = function () {
    const paso4 = document.getElementById("paso-4");
    if (!paso4) return false;

    let valido = true;
    let mensajeError = "";

    // Validar servicios predefinidos seleccionados
    const serviciosPredefinidos = paso4.querySelectorAll(
        'input[name="servicios_predefinidos[]"]:checked'
    );
    if (serviciosPredefinidos.length === 0) {
        const serviciosContainer = paso4.querySelector(
            "#servicios-predefinidos-contenedor"
        );
        if (serviciosContainer) {
            serviciosContainer.classList.add(
                "border-red-400",
                "border-2",
                "rounded-lg",
                "p-4"
            );
        }
        mensajeError = "Debes seleccionar al menos un servicio predefinido";
        valido = false;
    } else {
        const serviciosContainer = paso4.querySelector(
            "#servicios-predefinidos-contenedor"
        );
        if (serviciosContainer) {
            serviciosContainer.classList.remove(
                "border-red-400",
                "border-2",
                "rounded-lg",
                "p-4"
            );
        }
    }

    // Validar servicios personalizados (solo si los predefinidos están bien)
    if (valido) {
        const serviciosPersonalizados = paso4.querySelectorAll(
            'input[name="servicios_personalizados[nombre][]"]'
        );
        for (let input of serviciosPersonalizados) {
            if (!input.value.trim()) {
                input.classList.add("border-red-400");
                mensajeError =
                    "Completa todos los nombres de servicios personalizados";
                valido = false;
                break;
            } else {
                input.classList.remove("border-red-400");
            }
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
