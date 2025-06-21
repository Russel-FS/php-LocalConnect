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

// Paso 5: Horario de atención
window.toggleCerrado = function (checkbox) {
    const card = checkbox.closest(".flex.flex-col");
    const inputs = card.querySelectorAll('input[type="time"]');
    inputs.forEach((inp) => (inp.disabled = checkbox.checked));
};

window.validarHorarios = function () {
    let valido = true;
    let mensajes = [];
    document.querySelectorAll("#paso-5 .flex.flex-col").forEach((card, i) => {
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
            if (!inicio.value) {
                valido = false;
                mensajes.push(
                    `Completa el horario o marca el día como cerrado.`
                );
            }
            if (!fin.value) {
                valido = false;
                mensajes.push(
                    `Completa el horario o marca el día como cerrado.`
                );
            }
        }
    });
    if (!valido) {
        window.notyf.dismissAll();
        window.notyf.open({
            type: "error",
            message:
                mensajes[0] ||
                "Completa el horario o marca el día como cerrado.",
        });
    }
    return valido;
};

const validarPasoOriginal = window.validarPaso;
window.validarPaso = function (actual, siguiente) {
    if (actual === 5) {
        if (window.validarHorarios()) {
            validarPasoOriginal(actual, siguiente);
        }
    } else {
        validarPasoOriginal(actual, siguiente);
    }
};
