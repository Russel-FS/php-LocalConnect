<?php
// Iniciar la sesión para manejar la autenticación
session_start();
// Definir la constante de la ruta base
define('BASE_PATH', __DIR__);
// Cargar el router y las rutas
require_once __DIR__ . '/src/application/routes/routes.php';
