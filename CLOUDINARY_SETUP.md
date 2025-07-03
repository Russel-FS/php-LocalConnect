# Configuración de Cloudinary para LocalConnect

## Variables de Entorno Requeridas

Para que el sistema de subida de imágenes funcione correctamente, necesitas configurar las siguientes variables en tu archivo `.env`:

```env
CLOUDINARY_CLOUD_NAME=tu_cloud_name
CLOUDINARY_API_KEY=tu_api_key
CLOUDINARY_API_SECRET=tu_api_secret
```

## Cómo obtener las credenciales de Cloudinary:

1. Ve a [Cloudinary](https://cloudinary.com/) y crea una cuenta gratuita
2. Una vez registrado, ve al Dashboard
3. En la sección "Account Details" encontrarás:
    - Cloud Name
    - API Key
    - API Secret

## Instalación del paquete Cloudinary

Si no tienes instalado el paquete de Cloudinary, ejecuta:

```bash
composer require cloudinary/cloudinary_php
```

## Funcionalidades implementadas:

-   ✅ Subida de imágenes para categorías
-   ✅ Validación de formatos (JPEG, PNG, JPG, GIF, WEBP)
-   ✅ Límite de tamaño (2MB máximo)
-   ✅ Almacenamiento en carpeta "local-connect/categorias"
-   ✅ URLs seguras HTTPS
-   ✅ Manejo de errores

## Uso en el CRUD de Categorías:

1. **Crear categoría**: Puedes subir una imagen opcional
2. **Editar categoría**: Puedes cambiar la imagen o mantener la actual
3. **Vista de lista**: Muestra miniaturas de las imágenes
4. **Validación**: Verifica formato y tamaño antes de subir
