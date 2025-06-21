function mostrarResumen() {
    //  Datos del negocio
    const nombre = document.getElementById("nombre-negocio").value;
    const descripcion = document.getElementById("descripcion-negocio").value;
    const img = document.getElementById("vista-previa")?.src || "";
    // Ubicación
    const direccion = document.getElementById("direccion").value;
    const distrito = document.getElementById("distrito").value;
    const ciudad = document.getElementById("ciudad").value;
    const provincia = document.getElementById("provincia").value;
    const departamento = document.getElementById("departamento")?.value || "";
    const pais = document.getElementById("pais").value;
    const lat = document.getElementById("latitud").value;
    const lng = document.getElementById("longitud").value;
    // Categorías
    const cats = Array.from(
        document.querySelectorAll('input[name="categorias[]"]:checked')
    ).map(
        (cb) => cb.closest("label").querySelector(".font-medium").textContent
    );
    // Servicios predefinidos
    const servs = Array.from(
        document.querySelectorAll(
            'input[name="servicios_predefinidos[]"]:checked'
        )
    ).map(
        (cb) => cb.closest("label").querySelector(".font-semibold").textContent
    );
    // Servicios personalizados
    const pers = Array.from(
        document.querySelectorAll('input[name^="servicio_personalizado"]')
    )
        .map((inp) => inp.value)
        .filter(Boolean);
    //  Horario
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
    // Contacto
    const tel = document.getElementById("contacto-telefono").value;
    const wa = document.getElementById("contacto-whatsapp").value;
    const fb = document.getElementById("contacto-facebook").value;
    const ig = document.getElementById("contacto-instagram").value;
    const web = document.getElementById("contacto-web").value;
    // Mapa estático de Mapbox
    let mapaImg = "";
    if (lat && lng) {
        mapaImg = `<img src='https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s+2851e1(${lng},${lat})/${lng},${lat},16/400x200?access_token=pk.eyJ1IjoicnVzc2VsLWZzIiwiYSI6ImNtYTJ5djZ3NDFidzcybHNmZjl6dTEweGkifQ.L1_wuZGVMGSOmSKazwjxJg' class='w-full h-40 object-cover rounded-lg border mb-2 mt-6' alt='Mapa' />`;
    }
    // elementos HTML
    let html = `
    <div class="bg-white rounded-3xl shadow-xl p-0 sm:p-0 flex flex-col sm:flex-row items-stretch overflow-hidden mb-8">
        ${
            img
                ? `<div class='sm:w-1/3 w-full h-56 sm:h-auto flex-shrink-0 bg-primary-100 flex items-center justify-center'><img src="${img}" class="object-cover w-full h-full" alt="Portada" /></div>`
                : ""
        }
        <div class="flex-1 p-8 flex flex-col justify-center">
            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 mb-2">
                <h4 class="font-bold text-3xl text-primary-700 mb-2 sm:mb-0">${nombre}</h4>
                <div class="flex flex-wrap gap-2">
                    ${cats
                        .map(
                            (cat) =>
                                `<span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-medium">${cat}</span>`
                        )
                        .join("")}
                </div>
            </div>
            <div class="text-primary-400 text-base mb-2">${descripcion}</div>
            <div class="flex items-center gap-2 text-primary-400 text-sm">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/></svg>
                <span><span class="font-semibold text-primary-700">${direccion}</span>${
        distrito ? ", " + distrito : ""
    }${ciudad ? ", " + ciudad : ""}${provincia ? ", " + provincia : ""}${
        departamento ? ", " + departamento : ""
    }${pais ? ", " + pais : ""}</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow p-8 flex-1">
            <h5 class="font-semibold text-2xl mb-3 flex items-center gap-2 text-primary-700"><svg class='w-5 h-5 text-primary-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-width='2' d='M7 7h.01M7 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z'/></svg> Categorías</h5>
            <div class="flex flex-wrap gap-2">
                ${cats
                    .map(
                        (cat) =>
                            `<span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-medium">${cat}</span>`
                    )
                    .join("")}
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow p-8 flex-1">
            <h5 class="font-semibold text-2xl mb-3 flex items-center gap-2 text-primary-700"><svg class='w-5 h-5 text-secondary-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-width='2' d='M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z'/></svg> Servicios</h5>
            <div class="flex flex-wrap gap-2">
                ${servs
                    .map(
                        (s) =>
                            `<span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-medium">${s}</span>`
                    )
                    .join("")}
                ${pers
                    .map(
                        (s) =>
                            `<span class="px-3 py-1 bg-secondary-50 text-secondary-700 rounded-full text-xs font-medium">${s}</span>`
                    )
                    .join("")}
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow p-8 flex-1">
            <h5 class="font-semibold text-2xl mb-3 flex items-center gap-2 text-primary-700"><svg class='w-5 h-5 text-primary-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' stroke='currentColor' stroke-width='2'/><path stroke-linecap='round' stroke-width='2' d='M12 8v4l3 3'/></svg> Horario de atención</h5>
            <div class="overflow-x-auto">
                <table class="min-w-[250px] w-full text-xs">
                    <tbody>${horarios}</tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow p-8 flex-1">
            <h5 class="font-semibold text-2xl mb-3 flex items-center gap-2 text-primary-700"><svg class='w-5 h-5 text-secondary-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-width='2' d='M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z'/></svg> Contacto</h5>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                <div><span class="font-medium text-primary-700">Teléfono:</span> <span class="text-primary-400">${tel}</span></div>
                <div><span class="font-medium text-primary-700">WhatsApp:</span> <span class="text-primary-400">${wa}</span></div>
                <div><span class="font-medium text-primary-700">Facebook:</span> <span class="text-primary-400">${fb}</span></div>
                <div><span class="font-medium text-primary-700">Instagram:</span> <span class="text-primary-400">${ig}</span></div>
                <div class="sm:col-span-2"><span class="font-medium text-primary-700">Sitio web:</span> <span class="text-primary-400">${web}</span></div>
            </div>
        </div>
        ${
            mapaImg
                ? `<div class='bg-white rounded-2xl shadow p-8 flex-1'><h5 class="font-semibold text-2xl mb-3 flex items-center gap-2 text-primary-700"><svg class='w-5 h-5 text-secondary-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' stroke='currentColor' stroke-width='2'/></svg> Ubicación en el mapa</h5>${mapaImg}</div>`
                : ""
        }
    </div>
    `;
    document.getElementById("resumen-negocio").innerHTML = html;
}

const cambiarPasoOriginal = window.cambiarPaso;
window.cambiarPaso = function (actual, siguiente) {
    if (siguiente === 6) mostrarResumen();
    if (typeof cambiarPasoOriginal === "function") {
        cambiarPasoOriginal(actual, siguiente);
    }
};
