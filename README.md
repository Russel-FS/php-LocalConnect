# LocalConnect

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Descripción

LocalConnect es una plataforma digital para conectar negocios locales con residentes de una zona, facilitando la visibilidad de productos y servicios cercanos.

---

## Requisitos Previos

- PHP >= 8.1
- Composer
- MySQL
- Node.js y npm (para assets frontend)
- Git

---

## Instalación y Puesta en Marcha

### 1. Clonar el repositorio

```bash
git clone https://github.com/Russel-FS/php-LocalConnect.git
cd php-LocalConnect
```

### 2. Instalar Composer

Si no tienes Composer, instálalo desde [getcomposer.org](https://getcomposer.org/).

### 3. Instalar dependencias PHP

```bash
composer install
```

### 4. Instalar dependencias de Node.js

```bash
npm install
```

### 5. Copiar y configurar el archivo de entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` y configura la conexión a tu base de datos MySQL:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=localconnect
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 6. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 7. Crear la base de datos

Crea una base de datos llamada `localconnect` en MySQL (puedes usar phpMyAdmin o la terminal):

```sql
CREATE DATABASE localconnect;
```

### 8. Ejecutar migraciones y seeders

Esto creará las tablas necesarias en la base de datos:

```bash
php artisan migrate --seed
```

> Si tienes un archivo `database.sql`, también puedes importarlo manualmente si lo prefieres.

### 9. Compilar los assets frontend

```bash
npm run dev
```
o para producción:
```bash
npm run build
```

### 10. Levantar el servidor de desarrollo

```bash
php artisan serve
```

Accede a la aplicación en [http://localhost:8000](http://localhost:8000)

---

## Comandos útiles

- Ejecutar pruebas:
  ```bash
  php artisan test
  ```
- Limpiar cachés:
  ```bash
  php artisan config:clear
  php artisan cache:clear
  php artisan route:clear
  php artisan view:clear
  ```

---

## Recursos

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación de Composer](https://getcomposer.org/doc/)
- [Documentación de MySQL](https://dev.mysql.com/doc/)

---

## Licencia

Este proyecto está bajo la licencia MIT.
