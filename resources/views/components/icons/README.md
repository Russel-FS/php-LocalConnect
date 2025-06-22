# Componentes de Iconos

Esta carpeta contiene componentes reutilizables de iconos SVG organizados por categorías para toda la aplicación.

## Estructura de Carpetas

```
icons/
├── navigation/     # Iconos de navegación y búsqueda
├── actions/        # Iconos de acciones y botones
├── content/        # Iconos de contenido y categorías
├── ui/            # Iconos de interfaz de usuario
├── outline/       # Iconos outline (ya existente)
├── solid/         # Iconos solid (ya existente)
├── form/          # Iconos de formularios (ya existente)
└── wizard/        # Iconos del wizard (ya existente)
```

## Uso

Para usar un icono, incluye el componente con la ruta de la carpeta:

```blade
<!-- Icono de navegación -->
<x-icons.navigation.search class="w-5 h-5 text-primary-400" />

<!-- Icono de acción -->
<x-icons.actions.plus class="w-5 h-5" />

<!-- Icono de contenido -->
<x-icons.content.category class="w-4 h-4" />
```

## Iconos por Categoría

### 🧭 Navigation

Iconos relacionados con navegación, búsqueda y exploración:

-   `search.blade.php` - Icono de búsqueda
-   `chevron-down.blade.php` - Flecha hacia abajo
-   `eye.blade.php` - Icono de ver/visualizar

### ⚡ Actions

Iconos de acciones, botones y operaciones:

-   `plus.blade.php` - Icono de agregar/plus
-   `filter.blade.php` - Icono de filtro
-   `refresh.blade.php` - Icono de limpiar/refresh

### 📄 Content

Iconos de contenido, categorías y elementos de datos:

-   `category.blade.php` - Icono de categorías
-   `check-circle.blade.php` - Icono de características/verificación
-   `lightning.blade.php` - Icono de servicios
-   `star.blade.php` - Icono de valoraciones
-   `clock.blade.php` - Icono de horarios

### 🎨 UI

Iconos de interfaz de usuario y elementos visuales:

-   `business.blade.php` - Icono de negocio/empresa

### 📝 Form (ya existente)

Iconos específicos para formularios:

-   `user.blade.php` - Icono de usuario
-   `email.blade.php` - Icono de email
-   `lock.blade.php` - Icono de contraseña

### 🔗 Social (ya existente)

Iconos de redes sociales:

-   `facebook.blade.php` - Icono de Facebook
-   `instagram.blade.php` - Icono de Instagram
-   `whatsapp.blade.php` - Icono de WhatsApp

### 🧙‍♂️ Wizard (ya existente)

Iconos específicos del wizard de registro:

-   `book.blade.php` - Icono de libro
-   `category.blade.php` - Icono de categoría
-   `check.blade.php` - Icono de verificación
-   `location.blade.php` - Icono de ubicación
-   `marker.blade.php` - Icono de marcador
-   `menu.blade.php` - Icono de menú
-   `phone.blade.php` - Icono de teléfono
-   `services.blade.php` - Icono de servicios
-   `summary.blade.php` - Icono de resumen

## Personalización

Todos los iconos aceptan atributos HTML estándar como:

-   `class` - Para estilos CSS
-   `style` - Para estilos inline
-   `width` y `height` - Para dimensiones
-   `fill` - Para color de relleno
-   `stroke` - Para color de trazo

## Ejemplos de Uso

```blade
<!-- Icono básico -->
<x-icons.navigation.search />

<!-- Con clases de Tailwind -->
<x-icons.navigation.search class="w-6 h-6 text-blue-500" />

<!-- En botones -->
<button class="flex items-center gap-2">
    <x-icons.actions.plus class="w-4 h-4" />
    Agregar
</button>

<!-- En filtros -->
<div class="flex items-center gap-2">
    <x-icons.content.category class="w-4 h-4" />
    <x-icons.navigation.chevron-down class="w-4 h-4" />
</div>
```

## Beneficios de la Organización

1. **Mantenibilidad**: Cambios centralizados y organizados por función
2. **Reutilización**: Mismos iconos en múltiples vistas
3. **Consistencia**: Estilo uniforme en toda la aplicación
4. **Legibilidad**: Código más limpio y fácil de entender
5. **Escalabilidad**: Fácil agregar nuevos iconos en la categoría correcta
6. **Búsqueda**: Encontrar iconos más rápido por categoría
7. **Colaboración**: Equipos pueden trabajar en diferentes categorías sin conflictos

## Convenciones de Nomenclatura

-   **Archivos**: `kebab-case.blade.php` (ej: `chevron-down.blade.php`)
-   **Carpetas**: `snake_case` (ej: `navigation`, `content`)
-   **Componentes**: `x-icons.{categoria}.{nombre}` (ej: `x-icons.navigation.search`)
