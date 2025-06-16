<?php

// Iniciar sesión
session_start();

// Definir la constante de la ruta base
define('BASE_PATH', __DIR__);

// Cargar el archivo de rutas
require_once __DIR__ . '/src/application/routes/routes.php';
