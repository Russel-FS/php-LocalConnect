// Funcionalidad global del Wizard de Registro de Negocios

let pasoActual = 1;
const totalPasos = 6;
let contadorServicios = 1;

// Funciones para cambiar de paso
document.addEventListener("DOMContentLoaded", function () {
    actualizarSidebar();
    actualizarProgreso();
});

window.cambiarPaso = function (actual, siguiente) {
    document.getElementById("paso-" + actual).classList.add("hidden");
    document.getElementById("paso-" + siguiente).classList.remove("hidden");
    window.pasoActual = siguiente;
    pasoActual = siguiente;
    actualizarSidebar();
    actualizarProgreso();
    if (pasoActual === 2) {
        if (typeof inicializarMapa === "function") inicializarMapa();
    }
};

document.addEventListener("DOMContentLoaded", function () {});

// Funciones para el sidebar
function actualizarSidebar() {
    const items = document.querySelectorAll(".wizard-step-item");
    items.forEach((item) => {
        item.classList.remove("active", "completed");
        const step = parseInt(item.getAttribute("data-step"));
        if (step < pasoActual) {
            item.classList.add("completed");
        } else if (step === pasoActual) {
            item.classList.add("active");
        }
    });
}

// Funciones para actualizar el progreso
function actualizarProgreso() {
    const porcentaje = (pasoActual / totalPasos) * 100;
    const progressBar = document.getElementById("progress-bar");
    const progressText = document.getElementById("progress-text");

    if (progressBar) {
        progressBar.style.width = porcentaje + "%";
    }

    if (progressText) {
        progressText.textContent = pasoActual + " de " + totalPasos;
    }
}

// validaciones .
// Funciones para validar el paso
window.validarPaso = function (actual, siguiente) {
    const pasoDiv = document.getElementById("paso-" + actual);
    const inputs = pasoDiv.querySelectorAll("input, textarea, select");
    let valido = true;

    inputs.forEach((input) => {
        if (input.hasAttribute("required") && !input.value) {
            input.classList.add("border-red-400");
            valido = false;
        } else {
            input.classList.remove("border-red-400");
        }
    });

    // Validación especial para checkboxes de categorías - paso 3
    if (actual === 3) {
        const checkboxes = pasoDiv.querySelectorAll(
            'input[type="checkbox"]:checked'
        );
        if (checkboxes.length === 0) {
            const categoriaContainer = pasoDiv.querySelector(".grid");
            // error visual
            categoriaContainer.classList.add(
                "border-red-400",
                "border-2",
                "rounded-lg",
                "p-4"
            );
            valido = false;
        } else {
            const categoriaContainer = pasoDiv.querySelector(".grid");
            categoriaContainer.classList.remove(
                "border-red-400",
                "border-2",
                "rounded-lg",
                "p-4"
            );
        }
    }

    // valicacioon para servicios - paso 4
    if (actual === 4) {
        const servicios = pasoDiv.querySelectorAll(".servicio-item");
        let serviciosValidos = true;

        servicios.forEach((servicio) => {
            const inputs = servicio.querySelectorAll("input[required]");
            inputs.forEach((input) => {
                if (!input.value.trim()) {
                    input.classList.add("border-red-400");
                    serviciosValidos = false;
                } else {
                    input.classList.remove("border-red-400");
                }
            });
        });

        if (!serviciosValidos) {
            valido = false;
        }
    }

    // Validación para ubicación - paso 2
    if (actual === 2) {
        const latitud = document.getElementById("latitud").value;
        const longitud = document.getElementById("longitud").value;

        if (!latitud || !longitud) {
            // Mostrar error en el mapa
            const mapContainer = document.getElementById("map");
            mapContainer.classList.add("border-red-400", "border-2");
            valido = false;
        } else {
            const mapContainer = document.getElementById("map");
            mapContainer.classList.remove("border-red-400", "border-2");
        }
    }

    if (valido) {
        cambiarPaso(actual, siguiente);
    }
};
