// Funcionalidad del Wizard de Registro de Negocios

let pasoActual = 1;
const totalPasos = 6;

// Funciones para cambiar de paso
window.cambiarPaso = function (actual, siguiente) {
    document.getElementById("paso-" + actual).classList.add("hidden");
    document.getElementById("paso-" + siguiente).classList.remove("hidden");
    pasoActual = siguiente;
    actualizarSidebar();
    actualizarProgreso();
};

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

    // Validación especial para checkboxes de categorías (paso 3)
    if (actual === 3) {
        const checkboxes = pasoDiv.querySelectorAll(
            'input[type="checkbox"]:checked'
        );
        if (checkboxes.length === 0) {
            // Mostrar error visual en las categorías
            const categoriaContainer = pasoDiv.querySelector(".grid");
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

    if (valido) {
        cambiarPaso(actual, siguiente);
    }
};

// Funciones para manejo de imagen
window.mostrarVistaPrevia = function (input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const vistaPrevia = document.getElementById("vista-previa");
            const container = document.getElementById("vista-previa-container");
            const inputContainer = document.querySelector(
                'label[for="imagen-portada"]'
            );

            vistaPrevia.src = e.target.result;
            container.classList.remove("hidden");
            inputContainer.classList.add("hidden");
        };
        reader.readAsDataURL(file);
    }
};
// funcion que quita la imagen de la vista previa
window.eliminarImagen = function () {
    const input = document.getElementById("imagen-portada");
    const vistaPrevia = document.getElementById("vista-previa");
    const container = document.getElementById("vista-previa-container");
    const inputContainer = document.querySelector(
        'label[for="imagen-portada"]'
    );

    input.value = "";
    vistaPrevia.src = "";
    container.classList.add("hidden");
    inputContainer.classList.remove("hidden");
};

// Funciones para actualizar el sidebar
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

// Configurar el input de imagen
function configurarInputImagen() {
    const input = document.getElementById("imagen-portada");

    if (input) {
        input.addEventListener("change", function () {
            mostrarVistaPrevia(this);
        });
    }
}

// Configurar checkboxes de categorías
function configurarCategorias() {
    const checkboxes = document.querySelectorAll(
        '.categoria-checkbox input[type="checkbox"]'
    );

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const paso3 = document.getElementById("paso-3");
            const categoriaContainer = paso3.querySelector(".grid");
            const checkedBoxes = paso3.querySelectorAll(
                'input[type="checkbox"]:checked'
            );

            if (checkedBoxes.length > 0) {
                categoriaContainer.classList.remove(
                    "border-red-400",
                    "border-2",
                    "rounded-lg",
                    "p-4"
                );
            }
        });
    });
}

// Inicialización cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
    actualizarSidebar();
    actualizarProgreso();
    configurarInputImagen();
    configurarCategorias();
});
