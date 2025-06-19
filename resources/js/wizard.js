// Funcionalidad del Wizard de Registro de Negocios

let pasoActual = 1;
const totalPasos = 6;
let contadorServicios = 1;

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

// Funciones para manejo de servicios
window.agregarServicio = function () {
    contadorServicios++;
    const container = document.getElementById("servicios-container");

    const nuevoServicio = document.createElement("div");
    nuevoServicio.className = "servicio-item bg-gray-50 rounded-lg p-6";
    nuevoServicio.innerHTML = `
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-900">Servicio #${contadorServicios}</h4>
            <button type="button" onclick="eliminarServicio(this)" class="text-red-500 hover:text-red-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Nombre del servicio</label>
                <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Ej: Corte de cabello" />
            </div>
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Descripción</label>
                <input type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="Descripción breve" />
            </div>
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Precio (S/)</label>
                <input type="number" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition" placeholder="0.00" min="0" step="0.01" />
            </div>
        </div>
    `;

    container.appendChild(nuevoServicio);

    // Actualizar numeración de servicios
    actualizarNumeracionServicios();
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

// evento para inicializar el wizard al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    actualizarSidebar();
    actualizarProgreso();
    configurarInputImagen();
    configurarCategorias();
});
