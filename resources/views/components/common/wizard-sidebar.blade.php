<aside class="hidden lg:flex flex-col w-80 bg-white rounded-2xl card-apple p-10 sticky top-28 z-20 h-fit">
    <!-- Progreso -->
    <div class="mb-4">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-semibold text-primary-700">Progreso</span>
            <span id="progress-text" class="text-xs text-secondary-600 font-bold">1 de 7</span>
        </div>
        <div class="w-full rounded-full h-2 progress-bar-container">
            <div id="progress-bar" class="h-2 rounded-full transition-all duration-300" style="width: 14.29%"></div>
        </div>
    </div>

    <ul id="wizard-sidebar" class="space-y-4">
        <li class="wizard-step-item" data-step="1">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.menu />
                </div>
                <div>
                    <span class="step-label">Datos del negocio</span>
                    <p class="text-xs text-primary-400 mt-1">Información básica</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="2">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.location />
                </div>
                <div>
                    <span class="step-label">Ubicación</span>
                    <p class="text-xs text-primary-400 mt-1">Dirección y coordenadas</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="3">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.category />
                </div>
                <div>
                    <span class="step-label">Categorías</span>
                    <p class="text-xs text-primary-400 mt-1">Tipo de negocio</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="4">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.services />
                </div>
                <div>
                    <span class="step-label">Servicios</span>
                    <p class="text-xs text-primary-400 mt-1">Productos y servicios</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="5">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.check />
                </div>
                <div>
                    <span class="step-label">Características</span>
                    <p class="text-xs text-primary-400 mt-1">Atributos del negocio</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="6">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.phone />
                </div>
                <div>
                    <span class="step-label">Contacto</span>
                    <p class="text-xs text-primary-400 mt-1">Información de contacto</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="7">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <x-icons.wizard.summary />
                </div>
                <div>
                    <span class="step-label">Resumen</span>
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