// Paso 6 Horario de atención
window.toggleCerrado = function (checkbox) {
    const card = checkbox.closest(".bg-primary-50");
    const inputs = card.querySelectorAll('input[type="time"]');
    inputs.forEach((inp) => (inp.disabled = checkbox.checked));
};

// Validación específica del paso 6
window.validarPaso6 = function () {
    let valido = true;
    let mensajeError = "";
    // Validar telefónos
    const telefono = document.getElementById("contacto-telefono");
    if (!telefono || telefono.value.trim() === "") {
        mensajeError = "El número de teléfono es obligatorio.";
        valido = false;
    }
    // Validar horarios
    const dias = [
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado",
        "Domingo",
    ];

    for (let i = 0; i < 7; i++) {
        const card = document.getElementById(`horario-dia-${i}`);
        if (!card) {
            console.error(`No se encontró el elemento horario-dia-${i}`);
            continue;
        }

        const cerrado = card.querySelector(
            'input[type="checkbox"][name^="horarios"]'
        ).checked;
        const inicio = card.querySelector(
            'input[name^="horarios"][name$="[inicio]"]'
        );
        const fin = card.querySelector(
            'input[name^="horarios"][name$="[fin]"]'
        );

        if (!cerrado) {
            if (!inicio.value || !fin.value) {
                mensajeError = `Completa el horario del ${dias[i]} o márcalo como cerrado`;
                valido = false;
                break;
            } else if (inicio.value >= fin.value) {
                mensajeError = `La hora de cierre debe ser posterior a la de apertura para el ${dias[i]}`;
                valido = false;
                break;
            }
        }
    }

    if (!valido && window.notyf) {
        window.notyf.dismissAll();
        window.notyf.open({
            type: "error",
            message: mensajeError,
        });
    }

    return valido;
};
