<aside class="hidden lg:flex flex-col w-80 bg-white rounded-2xl shadow-lg border border-primary-100 py-8 px-8 gap-8 sticky top-28 z-20 h-fit ml-12">
    <!-- Progreso -->
    <div class="mb-4">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-semibold text-primary-700">Progreso</span>
            <span id="progress-text" class="text-xs text-secondary-600 font-bold">1 de 6</span>
        </div>
        <div class="w-full bg-primary-100 rounded-full h-2">
            <div id="progress-bar" class="bg-secondary-600 h-2 rounded-full transition-all duration-300" style="width: 16.67%"></div>
        </div>
    </div>

    <ul id="wizard-sidebar" class="space-y-4">
        <li class="wizard-step-item" data-step="1">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle text-secondary-600">
                    <x-icons.wizard.menu />
                </div>
                <div>
                    <span class="step-label text-primary-700">Datos del negocio</span>
                    <p class="text-xs text-primary-400 mt-1">Información básica</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="2">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle text-secondary-600">
                    <x-icons.wizard.location />
                </div>
                <div>
                    <span class="step-label text-primary-700">Ubicación</span>
                    <p class="text-xs text-primary-400 mt-1">Dirección y coordenadas</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="3">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle text-secondary-600">
                    <x-icons.wizard.category />
                </div>
                <div>
                    <span class="step-label text-primary-700">Categorías</span>
                    <p class="text-xs text-primary-400 mt-1">Tipo de negocio</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="4">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle text-secondary-600">
                    <x-icons.wizard.services />
                </div>
                <div>
                    <span class="step-label text-primary-700">Servicios</span>
                    <p class="text-xs text-primary-400 mt-1">Productos y servicios</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="5">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle text-secondary-600">
                    <x-icons.wizard.phone />
                </div>
                <div>
                    <span class="step-label text-primary-700">Contacto</span>
                    <p class="text-xs text-primary-400 mt-1">Información de contacto</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="6">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle text-secondary-600">
                    <x-icons.wizard.summary />
                </div>
                <div>
                    <span class="step-label text-primary-700">Resumen</span>
                    <p class="text-xs text-primary-400 mt-1">Revisar información</p>
                </div>
            </div>
        </li>
    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.step-link').forEach(function(link) {
                const li = link.closest('li');
                const paso = parseInt(li.getAttribute('data-step'));
                link.addEventListener('click', function() {
                    if (paso <= window.pasoActual) {
                        window.cambiarPaso(window.pasoActual, paso);
                    }
                });
            });
        });
    </script>
</aside>