// Paso 1: Imagen de portada

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

// Validación específica del paso 1
window.validarPaso1 = function () {
    const nombre = document.getElementById("nombre-negocio");
    const descripcion = document.getElementById("descripcion-negocio");
    let valido = true;

    // Validar nombre del negocio
    if (!nombre.value.trim()) {
        nombre.classList.add("border-red-400");
        valido = false;
    } else {
        nombre.classList.remove("border-red-400");
    }

    // Validar descripción del negocio
    if (!descripcion.value.trim()) {
        descripcion.classList.add("border-red-400");
        valido = false;
    } else {
        descripcion.classList.remove("border-red-400");
    }

    return valido;
};

function configurarInputImagen() {
    const input = document.getElementById("imagen-portada");
    if (input) {
        input.addEventListener("change", function () {
            mostrarVistaPrevia(this);
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    configurarInputImagen();
});
