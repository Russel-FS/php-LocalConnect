// Paso 7 Resumen del negocio

// Función para truncar texto con ellipsis
function truncateText(text, maxLength) {
    if (text.length <= maxLength) return text;
    return text.substring(0, maxLength) + "...";
}

function mostrarResumen() {
    //  Datos del negocio
    const nombre = document.getElementById("nombre-negocio").value;
    const descripcion = document.getElementById("descripcion-negocio").value;
    const img = document.getElementById("vista-previa")?.src || "";

    // Truncar título y descripción
    const nombreTruncado = truncateText(nombre, 50);
    const descripcionTruncada = truncateText(descripcion, 120);

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

    // Características
    const caracteristicas = Array.from(
        document.querySelectorAll('input[name="caracteristicas[]"]:checked')
    ).map(
        (cb) => cb.closest("label").querySelector(".font-medium").textContent
    );
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
        horarios += `<tr class="border-b border-primary-100"><td class='py-4 px-0 font-medium text-primary-700 text-sm'>${dia}</td><td class='py-4 px-0 text-sm'>${
            cerrado
                ? "<span class='text-primary-500 font-medium'>Cerrado</span>"
                : `<span class='text-primary-600'>${inicio} - ${fin}</span>`
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
        mapaImg = `<img src='https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s+2851e1(${lng},${lat})/${lng},${lat},16/600x300?access_token=pk.eyJ1IjoicnVzc2VsLWZzIiwiYSI6ImNtYTJ5djZ3NDFidzcybHNmZjl6dTEweGkifQ.L1_wuZGVMGSOmSKazwjxJg' class='w-full h-48 object-cover rounded-2xl border border-primary-100' alt='Mapa' />`;
    }

    // elementos HTML con estilo Apple
    let html = `
    <!-- Hero Section - Estilo Apple -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary-50 to-white rounded-3xl mb-16">
        <div class="absolute inset-0 bg-gradient-to-r from-secondary-500/5 to-primary-500/5"></div>
        <div class="relative p-12 lg:p-20">
            <div class="max-w-4xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <h1 class="text-5xl lg:text-6xl font-bold text-primary-700 leading-tight tracking-tight" title="${nombre}">
                                ${nombreTruncado}
                            </h1>
                            <p class="text-xl text-primary-500 leading-relaxed max-w-lg" title="${descripcion}">
                                ${descripcionTruncada}
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">
                            ${cats
                                .map(
                                    (cat) =>
                                        `<span class="px-4 py-2 bg-white/80 backdrop-blur-sm border border-primary-200 text-primary-700 rounded-full text-sm font-medium shadow-sm">${cat}</span>`
                                )
                                .join("")}
                        </div>
                        
                        <div class="flex items-center gap-3 text-primary-500">
                            <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-lg">
                                <span class="font-semibold text-primary-700">${direccion}</span>${
        distrito ? ", " + distrito : ""
    }${ciudad ? ", " + ciudad : ""}${provincia ? ", " + provincia : ""}${
        departamento ? ", " + departamento : ""
    }${pais ? ", " + pais : ""}
                            </span>
                        </div>
                    </div>
                    
                    ${
                        img
                            ? `<div class="relative">
                                <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl">
                                    <img src="${img}" class="w-full h-full object-cover" alt="Portada" />
                                </div>
                                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-secondary-500 rounded-2xl shadow-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>`
                            : `<div class="relative">
                                <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <svg class="w-32 h-32 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>`
                    }
                </div>
            </div>
        </div>
    </div>

    <!-- Secciones de información - Estilo Apple -->
    <div class="space-y-16">
        <!-- Servicios y Características -->
        <div class="grid lg:grid-cols-2 gap-12">
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-primary-700 mb-6">Servicios</h2>
                    <div class="space-y-4">
                        ${
                            servs.length > 0
                                ? `
                            <div class="space-y-3">
                                <h3 class="text-lg font-semibold text-primary-600">Servicios predefinidos</h3>
                                <div class="flex flex-wrap gap-3">
                                    ${servs
                                        .map(
                                            (s) =>
                                                `<span class="px-4 py-2 bg-primary-50 text-primary-700 rounded-xl text-sm font-medium border border-primary-200">${s}</span>`
                                        )
                                        .join("")}
                                </div>
                            </div>
                        `
                                : ""
                        }
                        ${
                            pers.length > 0
                                ? `
                            <div class="space-y-3">
                                <h3 class="text-lg font-semibold text-primary-600">Servicios personalizados</h3>
                                <div class="flex flex-wrap gap-3">
                                    ${pers
                                        .map(
                                            (s) =>
                                                `<span class="px-4 py-2 bg-secondary-50 text-secondary-700 rounded-xl text-sm font-medium border border-secondary-200">${s}</span>`
                                        )
                                        .join("")}
                                </div>
                            </div>
                        `
                                : ""
                        }
                    </div>
                </div>
            </div>
            
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-primary-700 mb-6">Características</h2>
                    <div class="space-y-4">
                        ${
                            caracteristicas.length > 0
                                ? `<div class="flex flex-wrap gap-3">
                                    ${caracteristicas
                                        .map(
                                            (car) =>
                                                `<span class="px-4 py-2 bg-secondary-50 text-secondary-700 rounded-xl text-sm font-medium border border-secondary-200">${car}</span>`
                                        )
                                        .join("")}
                                </div>`
                                : '<p class="text-primary-400 text-lg">No se seleccionaron características</p>'
                        }
                    </div>
                </div>
            </div>
        </div>

        <!-- Horario y Contacto -->
        <div class="grid lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold text-primary-700 mb-6">Horario de atención</h2>
                <div class="bg-white rounded-2xl p-8 border border-primary-100">
                    <table class="w-full">
                        <tbody class="divide-y divide-primary-100">
                            ${horarios}
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div>
                <h2 class="text-3xl font-bold text-primary-700 mb-6">Información de contacto</h2>
                <div class="bg-white rounded-2xl p-8 border border-primary-100 space-y-6">
                    ${
                        tel
                            ? `
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Teléfono</p>
                                <p class="text-lg text-primary-700 font-semibold">${tel}</p>
                            </div>
                        </div>
                    `
                            : ""
                    }
                    ${
                        wa
                            ? `
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">WhatsApp</p>
                                <p class="text-lg text-primary-700 font-semibold">${wa}</p>
                            </div>
                        </div>
                    `
                            : ""
                    }
                    ${
                        fb
                            ? `
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Facebook</p>
                                <p class="text-lg text-primary-700 font-semibold">${fb}</p>
                            </div>
                        </div>
                    `
                            : ""
                    }
                    ${
                        ig
                            ? `
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.928.875 1.418 2.026 1.418 3.323s-.49 2.448-1.418 3.244c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.781c-.49 0-.928-.175-1.297-.49-.368-.315-.49-.753-.49-1.243 0-.49.122-.928.49-1.243.369-.315.807-.49 1.297-.49s.928.175 1.297.49c.368.315.49.753.49 1.243 0 .49-.122.928-.49 1.243-.369.315-.807.49-1.297.49z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Instagram</p>
                                <p class="text-lg text-primary-700 font-semibold">${ig}</p>
                            </div>
                        </div>
                    `
                            : ""
                    }
                    ${
                        web
                            ? `
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-primary-500 font-medium">Sitio web</p>
                                <p class="text-lg text-primary-700 font-semibold">${web}</p>
                            </div>
                        </div>
                    `
                            : ""
                    }
                </div>
            </div>
        </div>

        ${
            mapaImg
                ? `<div>
                    <h2 class="text-3xl font-bold text-primary-700 mb-6">Ubicación</h2>
                    <div class="bg-white rounded-2xl p-8 border border-primary-100">
                        ${mapaImg}
                    </div>
                </div>`
                : ""
        }
    </div>
    `;
    document.getElementById("resumen-negocio").innerHTML = html;
}

// Sobrescribir la función cambiarPaso
const cambiarPasoOriginal = window.cambiarPaso;
window.cambiarPaso = function (actual, siguiente) {
    if (siguiente === 7) {
        mostrarResumen();
    }
    if (typeof cambiarPasoOriginal === "function") {
        cambiarPasoOriginal(actual, siguiente);
    }
};
