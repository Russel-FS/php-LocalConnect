// Paso 5: Características
document.addEventListener("DOMContentLoaded", function () {
    const paso5 = document.querySelector('[data-step="5"]');
    if (!paso5) return;

    // Validación específica del paso 5
    window.validarPaso5 = function () {
        const caracteristicasSeleccionadas = paso5.querySelectorAll(
            'input[name="caracteristicas[]"]:checked'
        );
        const caracteristicasContainer = paso5.querySelector(
            "#caracteristicas-contenedor"
        );
        let valido = true;

        if (caracteristicasSeleccionadas.length === 0) {
            // Mostrar error visual
            if (caracteristicasContainer) {
                caracteristicasContainer.classList.add(
                    "border-red-400",
                    "border-2",
                    "rounded-lg",
                    "p-4"
                );
            }

            // Mostrar notificación si está disponible
            if (window.notyf) {
                window.notyf.dismissAll();
                window.notyf.open({
                    type: "error",
                    message: "Debes seleccionar al menos una característica.",
                });
            }
            valido = false;
        } else {
            // Limpiar error visual
            if (caracteristicasContainer) {
                caracteristicasContainer.classList.remove(
                    "border-red-400",
                    "border-2",
                    "rounded-lg",
                    "p-4"
                );
            }
        }

        return valido;
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

    // Configurar eventos para limpiar errores cuando se selecciona una característica
    paso5
        .querySelectorAll('input[name="caracteristicas[]"]')
        .forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const caracteristicasSeleccionadas = paso5.querySelectorAll(
                    'input[name="caracteristicas[]"]:checked'
                ).length;

                // Limpiar error visual si hay selecciones
                if (caracteristicasSeleccionadas > 0) {
                    const caracteristicasContainer = paso5.querySelector(
                        "#caracteristicas-contenedor"
                    );
                    if (caracteristicasContainer) {
                        caracteristicasContainer.classList.remove(
                            "border-red-400",
                            "border-2",
                            "rounded-lg",
                            "p-4"
                        );
                    }
                }

                console.log(
                    `Características seleccionadas: ${caracteristicasSeleccionadas}`
                );
            });
        });
});
