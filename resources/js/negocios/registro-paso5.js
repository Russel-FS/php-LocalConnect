// Paso 5: Características

// Validación específica del paso 5
window.validarPaso5 = function () {
    console.log("Ejecutando validación del paso 5");

    const paso5 = document.getElementById("paso-5");
    if (!paso5) {
        console.error("No se encontró el elemento paso-5");
        return false;
    }

    const caracteristicasSeleccionadas = paso5.querySelectorAll(
        'input[name="caracteristicas[]"]:checked'
    );
    console.log(
        "Características seleccionadas:",
        caracteristicasSeleccionadas.length
    );

    if (caracteristicasSeleccionadas.length === 0) {
        // Mostrar error visual
        const contenedores = paso5.querySelectorAll(
            ".border.border-gray-200.rounded-xl"
        );
        if (contenedores.length > 0) {
            contenedores[0].classList.add("border-red-400", "border-2");
        }

        // Mostrar mensaje de error
        if (window.notyf) {
            window.notyf.dismissAll();
            window.notyf.open({
                type: "error",
                message:
                    "Debes seleccionar al menos una característica para tu negocio",
            });
        }

        console.log("Validación fallida: no hay características seleccionadas");
        return false;
    } else {
        // Limpiar error visuall
        paso5
            .querySelectorAll(".border.border-gray-200.rounded-xl")
            .forEach((contenedor) => {
                contenedor.classList.remove("border-red-400", "border-2");
            });

        console.log("Validación exitosa");
        return true;
    }
};

// Configurar eventos cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
    const paso5 = document.getElementById("paso-5");
    if (!paso5) return;

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
                    paso5
                        .querySelectorAll(".border.border-gray-200.rounded-xl")
                        .forEach((contenedor) => {
                            contenedor.classList.remove(
                                "border-red-400",
                                "border-2"
                            );
                        });
                }

                console.log(
                    `Características seleccionadas: ${caracteristicasSeleccionadas}`
                );
            });
        });
});
