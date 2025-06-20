function toggleCerrado(checkbox) {
    const card = checkbox.closest(".flex.flex-col");
    const inputs = card.querySelectorAll('input[type="time"]');
    inputs.forEach((inp) => (inp.disabled = checkbox.checked));
}

function mostrarResumen() {
    // 1. Datos del negocio
    const nombre = document.querySelector(
        'input[placeholder="Ej: Panadería San Juan"]'
    ).value;
    const descripcion = document.querySelector(
        'textarea[placeholder^="Describe tu negocio"]'
    ).value;
    const img = document.getElementById("vista-previa")?.src || "";
    // 2. Ubicación
    const direccion = document.getElementById("direccion").value;
    const distrito = document.getElementById("distrito").value;
    const ciudad = document.getElementById("ciudad").value;
    const provincia = document.getElementById("provincia").value;
    const departamento = document.getElementById("departamento")?.value || "";
    const pais = document.getElementById("pais").value;
    const lat = document.getElementById("latitud").value;
    const lng = document.getElementById("longitud").value;
    // 3. Categorías
    const cats = Array.from(
        document.querySelectorAll('input[name="categorias[]"]:checked')
    ).map(
        (cb) => cb.closest("label").querySelector(".font-medium").textContent
    );
    // 4. Servicios predefinidos
    const servs = Array.from(
        document.querySelectorAll(
            'input[name="servicios_predefinidos[]"]:checked'
        )
    ).map(
        (cb) => cb.closest("label").querySelector(".font-semibold").textContent
    );
    // 5. Servicios personalizados
    const pers = Array.from(
        document.querySelectorAll('input[name^="servicio_personalizado"]')
    )
        .map((inp) => inp.value)
        .filter(Boolean);
    // 6. Horario
    const dias = [
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado",
        "Domingo",
    ];
    let horarios = "";
    dias.forEach((dia, i) => {
        const cerrado = document.querySelector(
            `input[name='horarios[${i}][cerrado]']`
        ).checked;
        const inicio = document.querySelector(
            `input[name='horarios[${i}][inicio]']`
        ).value;
        const fin = document.querySelector(
            `input[name='horarios[${i}][fin]']`
        ).value;
        horarios += `<tr><td class='py-1 px-2 font-medium text-gray-700'>${dia}</td><td class='py-1 px-2 text-xs'>${
            cerrado
                ? "<span class='text-red-500 font-semibold'>Cerrado</span>"
                : `${inicio} - ${fin}`
        }</td></tr>`;
    });
    // 7. Contacto
    const tel = document.querySelector('input[placeholder="Teléfono"]').value;
    const wa = document.querySelector('input[placeholder="WhatsApp"]').value;
    const fb = document.querySelector('input[placeholder="Facebook"]').value;
    const ig = document.querySelector('input[placeholder="Instagram"]').value;
    const web = document.querySelector('input[placeholder="Sitio web"]').value;
    // Mapa estático de Mapbox
    let mapaImg = "";
    if (lat && lng) {
        mapaImg = `<img src='https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s+2851e1(${lng},${lat})/${lng},${lat},16/400x200?access_token=pk.eyJ1IjoicnVzc2VsLWZzIiwiYSI6ImNtYTJ5djZ3NDFidzcybHNmZjl6dTEweGkifQ.L1_wuZGVMGSOmSKazwjxJg' class='w-full h-40 object-cover rounded-lg border mb-2 mt-6' alt='Mapa' />`;
    }
    let html = `
    <div class="bg-white rounded-xl shadow p-8 flex flex-col sm:flex-row gap-8 items-center">
        ${
            img
                ? `<img src="${img}" class="w-36 h-36 object-cover rounded-lg border mb-4 sm:mb-0 shadow-md" alt="Portada" />`
                : ""
        }
        <div class="flex-1">
            <h4 class="font-bold text-2xl mb-2 text-primary-700">${nombre}</h4>
            <p class="text-gray-500 mb-3 text-base">${descripcion}</p>
            <div class="text-sm text-gray-400 mb-1"><span class="font-semibold text-gray-700">Dirección:</span> ${direccion}${
        distrito ? ", " + distrito : ""
    }${ciudad ? ", " + ciudad : ""}${provincia ? ", " + provincia : ""}${
        departamento ? ", " + departamento : ""
    }${pais ? ", " + pais : ""}</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-8">
        <h5 class="font-semibold text-lg mb-3 flex items-center gap-2"><svg class='w-5 h-5 text-primary-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-width='2' d='M7 7h.01M7 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z'/></svg> Categorías</h5>
        <div class="flex flex-wrap gap-2">
            ${cats
                .map(
                    (cat) =>
                        `<span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-medium">${cat}</span>`
                )
                .join("")}
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-8">
        <h5 class="font-semibold text-lg mb-3 flex items-center gap-2"><svg class='w-5 h-5 text-green-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-width='2' d='M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z'/></svg> Servicios</h5>
        <div class="flex flex-wrap gap-2">
            ${servs
                .map(
                    (s) =>
                        `<span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">${s}</span>`
                )
                .join("")}
            ${pers
                .map(
                    (s) =>
                        `<span class="px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-medium">${s}</span>`
                )
                .join("")}
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-8">
        <h5 class="font-semibold text-lg mb-3 flex items-center gap-2"><svg class='w-5 h-5 text-blue-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' stroke='currentColor' stroke-width='2'/><path stroke-linecap='round' stroke-width='2' d='M12 8v4l3 3'/></svg> Horario de atención</h5>
        <div class="overflow-x-auto">
            <table class="min-w-[250px] w-full text-xs">
                <tbody>${horarios}</tbody>
            </table>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-8">
        <h5 class="font-semibold text-lg mb-3 flex items-center gap-2"><svg class='w-5 h-5 text-pink-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-width='2' d='M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z'/></svg> Contacto</h5>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
            <div><span class="font-medium text-gray-700">Teléfono:</span> ${tel}</div>
            <div><span class="font-medium text-gray-700">WhatsApp:</span> ${wa}</div>
            <div><span class="font-medium text-gray-700">Facebook:</span> ${fb}</div>
            <div><span class="font-medium text-gray-700">Instagram:</span> ${ig}</div>
            <div class="sm:col-span-2"><span class="font-medium text-gray-700">Sitio web:</span> ${web}</div>
        </div>
    </div>
    ${
        mapaImg
            ? `<div class='bg-white rounded-xl shadow p-8 mt-6'><h5 class=\"font-semibold text-lg mb-3 flex items-center gap-2\"><svg class='w-5 h-5 text-blue-400' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' stroke='currentColor' stroke-width='2'/></svg> Ubicación en el mapa</h5>${mapaImg}</div>`
            : ""
    }
    `;
    document.getElementById("resumen-negocio").innerHTML = html;
}

// Sobrescribe cambiarPaso
const cambiarPasoOriginal = window.cambiarPaso;
window.cambiarPaso = function (actual, siguiente) {
    if (siguiente === 6) mostrarResumen();
    if (typeof cambiarPasoOriginal === "function") {
        cambiarPasoOriginal(actual, siguiente);
    }
};
