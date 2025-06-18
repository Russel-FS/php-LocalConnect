// Funcionalidad del Wizard de Registro de Negocios

let pasoActual = 1;
const totalPasos = 6;

window.cambiarPaso = function (actual, siguiente) {
    document.getElementById("paso-" + actual).classList.add("hidden");
    document.getElementById("paso-" + siguiente).classList.remove("hidden");
    pasoActual = siguiente;
    actualizarSidebar();
    actualizarProgreso();
};

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

    if (valido) {
        cambiarPaso(actual, siguiente);
    }
};

function actualizarSidebar() {
    const items = document.querySelectorAll(".wizard-step-item");
    items.forEach((item, idx) => {
        item.classList.remove("active", "completed");
        const step = parseInt(item.getAttribute("data-step"));
        if (step < pasoActual) {
            item.classList.add("completed");
        } else if (step === pasoActual) {
            item.classList.add("active");
        }
    });
}

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

document.addEventListener("DOMContentLoaded", function () {
    actualizarSidebar();
    actualizarProgreso();
});
