// Paso 4: Servicios personalizados

window.agregarServicioPersonalizado = function (btn) {
    const serviciosPersonalizados = btn.closest("#servicios-personalizados");
    if (!serviciosPersonalizados) return;
    const lista = serviciosPersonalizados.querySelector(
        "#personalizados-lista"
    );
    if (!lista) return;
    const div = document.createElement("div");
    div.className =
        "relative bg-white rounded-xl shadow border border-gray-200 p-4 flex flex-col sm:flex-row gap-4 items-center";
    div.innerHTML = `
        <input type="text" name="servicios_personalizados[nombre][]" placeholder="Nombre del servicio" class="w-full sm:w-1/4 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition" required>
        <input type="text" name="servicios_personalizados[descripcion][]" placeholder="Descripción" class="w-full sm:w-2/4 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition">
        <input type="number" name="servicios_personalizados[precio][]" placeholder="Precio" class="w-full sm:w-1/6 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition" min="0" step="0.01">
        <button type="button" onclick="this.parentNode.remove()" class="absolute top-2 right-2 text-red-500 hover:text-red-700 bg-red-50 rounded-full p-1 transition" title="Quitar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    `;
    lista.appendChild(div);
};

// Función para eliminar un servicio
window.eliminarServicio = function (boton) {
    const servicioItem = boton.closest(".servicio-item");
    const container = document.getElementById("servicios-container");

    if (container.children.length > 1) {
        servicioItem.remove();
        contadorServicios--;
        actualizarNumeracionServicios();
    }
};

// Función para actualizar la numeración de los servicios
function actualizarNumeracionServicios() {
    const servicios = document.querySelectorAll(".servicio-item");
    servicios.forEach((servicio, index) => {
        const titulo = servicio.querySelector("h4");
        titulo.textContent = `Servicio #${index + 1}`;
    });
}

// Paso 4: Validación de servicios

// Validación específica del paso 4
window.validarPaso4 = function () {
    const paso4 = document.getElementById("paso-4");
    const servicios = paso4.querySelectorAll(".servicio-item");
    let valido = true;

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
        valido = false;
    } else {
        // Limpiar error visual
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

    // Validar servicios personalizados
    servicios.forEach((servicio) => {
        const inputs = servicio.querySelectorAll("input[required]");
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                input.classList.add("border-red-400");
                valido = false;
            } else {
                input.classList.remove("border-red-400");
            }
        });
    });

    return valido;
};

// Función para agregar nuevo servicio personalizado
window.agregarServicioPersonalizado = function () {
    const contenedor = document.getElementById("servicios-personalizados");
    const nuevoServicio = document.createElement("div");
    nuevoServicio.className = "servicio-item bg-gray-50 p-4 rounded-lg mb-4";
    nuevoServicio.innerHTML = `
        <div class="flex items-center gap-4">
            <div class="flex-1">
                <input type="text" name="servicio_personalizado[]" placeholder="Nombre del servicio" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
            </div>
            <div class="flex-1">
                <input type="text" name="descripcion_servicio[]" placeholder="Descripción del servicio" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
            </div>
            <button type="button" onclick="eliminarServicioPersonalizado(this)" 
                    class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                Eliminar
            </button>
        </div>
    `;
    contenedor.appendChild(nuevoServicio);
};

// Función para eliminar servicio personalizado
window.eliminarServicioPersonalizado = function (boton) {
    boton.closest(".servicio-item").remove();
};
