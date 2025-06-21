// Paso 6 Horario de atención
window.toggleCerrado = function (checkbox) {
    const card = checkbox.closest(".flex.flex-col");
    const inputs = card.querySelectorAll('input[type="time"]');
    inputs.forEach((inp) => (inp.disabled = checkbox.checked));
};

// Validación específica del paso 6
window.validarPaso6 = function () {
    let valido = true;
    let mensajes = [];

    document.querySelectorAll("#paso-6 .flex.flex-col").forEach((card, i) => {
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
                valido = false;
                mensajes.push(
                    `Completa el horario o marca el día como cerrado.`
                );
            } else if (inicio.value >= fin.value) {
                valido = false;
                mensajes.push(
                    `La hora de fin debe ser mayor que la de inicio para el día #${
                        i + 1
                    }.`
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
