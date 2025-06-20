// Paso 3: Validación y manejo de categorías

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

document.addEventListener("DOMContentLoaded", function () {
    configurarCategorias();
});
