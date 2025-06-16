<?php

require_once __DIR__ . '/Router.php';

$router = new Router();

// Rutas de autenticación
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@showRegister');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

// Rutas del dashboard
$router->get('/dashboard', 'DashboardController@index');
$router->get('/profile', 'UserController@profile');
$router->post('/profile/update', 'UserController@updateProfile');

// Rutas de la API
$router->get('/api/users', 'ApiController@getUsers');
$router->post('/api/users', 'ApiController@createUser');
$router->get('/api/users/1', 'ApiController@getUser');
$router->post('/api/users/1', 'ApiController@updateUser');
$router->post('/api/users/1/delete', 'ApiController@deleteUser');

// Ruta por defecto
$router->get('/', function () {
    header('Location: /login');
    exit;
});

// Despachar la ruta
$router->dispatch();
