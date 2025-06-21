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
                    `Debes ingresar la hora de inicio para el día #${i + 1}`
                );
            }
            if (!fin.value) {
                valido = false;
                mensajes.push(
                    `Debes ingresar la hora de fin para el día #${i + 1}`
                );
            }
        }
    });
    if (!valido) {
        alert(mensajes.join("\n"));
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
