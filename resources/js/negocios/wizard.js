// Funcionalidad global del Wizard de Registro de Negocios

let pasoActual = 1;
const totalPasos = 7;
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

// Función principal de validación que llama a las validaciones específicas
window.validarPaso = function (actual, siguiente) {
    let valido = true;

    // Llamar a la validación específica de cada paso
    switch (actual) {
        case 1:
            if (typeof window.validarPaso1 === "function") {
                valido = window.validarPaso1();
            }
            break;
        case 2:
            if (typeof window.validarPaso2 === "function") {
                valido = window.validarPaso2();
            }
            break;
        case 3:
            if (typeof window.validarPaso3 === "function") {
                valido = window.validarPaso3();
            }
            break;
        case 4:
            if (typeof window.validarPaso4 === "function") {
                valido = window.validarPaso4();
            }
            break;
        case 5:
            if (typeof window.validarPaso5 === "function") {
                valido = window.validarPaso5();
            }
            break;
        case 6:
            if (typeof window.validarPaso6 === "function") {
                valido = window.validarPaso6();
            }
            break;
        default:
            // Validación básica para campos requeridos
            const pasoDiv = document.getElementById("paso-" + actual);
            const inputs = pasoDiv.querySelectorAll(
                "input[required], textarea[required], select[required]"
            );
            inputs.forEach((input) => {
                if (!input.value.trim()) {
                    input.classList.add("border-red-400");
                    valido = false;
                } else {
                    input.classList.remove("border-red-400");
                }
            });
            break;
    }

    if (valido) {
        cambiarPaso(actual, siguiente);
    }
};

// personalizacion del toaster
window.notyf =
    window.notyf ||
    new Notyf({
        duration: 6000,
        position: { x: "right", y: "top" },
        types: [
            {
                type: "error",
                background: "var(--color-primary-700)",
                icon: false,
            },
            {
                type: "success",
                background: "var(--color-secondary-500)",
                icon: false,
            },
        ],
    });
