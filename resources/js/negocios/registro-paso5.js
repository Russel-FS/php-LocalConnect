// Paso  Características
document.addEventListener("DOMContentLoaded", function () {
    const paso5 = document.querySelector('[data-step="5"]');
    if (!paso5) return;

    // Validación del paso 5
    window.validarPaso5 = function () {
        const caracteristicasSeleccionadas = paso5.querySelectorAll(
            'input[name="caracteristicas[]"]:checked'
        );
        if (caracteristicasSeleccionadas.length === 0) {
            window.notyf.dismissAll();
            window.notyf.open({
                type: "error",
                message: "Debes seleccionar al menos una característica.",
            });
            return false;
        }
        return true;
    };

    window.guardarPaso5 = function () {
        const caracteristicas = [];
        paso5
            .querySelectorAll('input[name="caracteristicas[]"]:checked')
            .forEach((checkbox) => {
                caracteristicas.push(checkbox.value);
            });

        window.wizardData.caracteristicas = caracteristicas;
    };

    window.cargarPaso5 = function () {
        if (window.wizardData.caracteristicas) {
            window.wizardData.caracteristicas.forEach((caracteristicaId) => {
                const checkbox = paso5.querySelector(
                    `input[name="caracteristicas[]"][value="${caracteristicaId}"]`
                );
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        }
    };

    paso5
        .querySelectorAll('input[name="caracteristicas[]"]')
        .forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const caracteristicasSeleccionadas = paso5.querySelectorAll(
                    'input[name="caracteristicas[]"]:checked'
                ).length;
                console.log(
                    `Características seleccionadas: ${caracteristicasSeleccionadas}`
                );
            });
        });
});
