// Paso 5: Horario de atención

window.toggleCerrado = function (checkbox) {
    const card = checkbox.closest(".flex.flex-col");
    const inputs = card.querySelectorAll('input[type="time"]');
    const diaIndex = checkbox.getAttribute("data-dia");

    // Deshabilitar campo tiempo
    inputs.forEach((inp) => (inp.disabled = checkbox.checked));

    if (checkbox.checked) {
        checkbox.value = "true";
        const hiddenField = card.querySelector(
            `input[name="horarios[${diaIndex}][cerrado_hidden]"]`
        );
        if (hiddenField) {
            hiddenField.style.display = "none";
        }
    } else {
        checkbox.value = "false";
        const hiddenField = card.querySelector(
            `input[name="horarios[${diaIndex}][cerrado_hidden]"]`
        );
        if (hiddenField) {
            hiddenField.style.display = "block";
        }
    }
};
