<aside class="hidden lg:flex flex-col w-80 bg-white rounded-2xl shadow-lg border border-gray-100 py-8 px-8 gap-8 sticky top-28 z-20 h-fit ml-8">
    <!-- Progreso -->
    <div class="mb-4">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-semibold text-gray-700">Progreso</span>
            <span id="progress-text" class="text-xs text-primary-600 font-bold">1 de 6</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div id="progress-bar" class="bg-primary-600 h-2 rounded-full transition-all duration-300" style="width: 16.67%"></div>
        </div>
    </div>

    <ul id="wizard-sidebar" class="space-y-4">
        <li class="wizard-step-item" data-step="1">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                        <path d="M3 7h18M3 12h18M3 17h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <span class="step-label">Datos del negocio</span>
                    <p class="text-xs text-gray-400 mt-1">Información básica</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="2">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="currentColor" stroke-width="2" />
                        <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>
                <div>
                    <span class="step-label">Ubicación</span>
                    <p class="text-xs text-gray-400 mt-1">Dirección y coordenadas</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="3">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                        <path d="M7 7h.01M7 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>
                <div>
                    <span class="step-label">Categorías</span>
                    <p class="text-xs text-gray-400 mt-1">Tipo de negocio</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="4">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>
                <div>
                    <span class="step-label">Servicios</span>
                    <p class="text-xs text-gray-400 mt-1">Productos y servicios</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="5">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>
                <div>
                    <span class="step-label">Contacto</span>
                    <p class="text-xs text-gray-400 mt-1">Información de contacto</p>
                </div>
            </div>
        </li>
        <li class="wizard-step-item" data-step="6">
            <div class="flex items-center gap-4 step-link" style="cursor:pointer;">
                <div class="step-circle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="step-icon">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>
                <div>
                    <span class="step-label">Resumen</span>
                    <p class="text-xs text-gray-400 mt-1">Revisar información</p>
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