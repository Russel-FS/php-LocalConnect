<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\Admin\AdminNegocioController;
use App\Http\Controllers\Admin\AdminNegocioPanelController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// rutas de autenticación 
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// rutas para negocios - se requiere autenticación
Route::middleware('auth')->group(function () {
    Route::get('/negocios/registro', [NegocioController::class, 'showRegistro'])->name('negocios.registro');
    Route::post('/negocios/guardar', [NegocioController::class, 'guardar'])->name('negocios.guardar');
    Route::get('/negocios/mis-negocios', [NegocioController::class, 'misNegocios'])->name('negocios.mis-negocios');
    Route::get('/negocios/{negocio}/editar', [NegocioController::class, 'editar'])->name('negocios.editar');
    Route::put('/negocios/{negocio}', [NegocioController::class, 'actualizar'])->name('negocios.actualizar');
    Route::post('/negocios/{id}/comentar', [NegocioController::class, 'comentarNegocio'])->name('negocios.comentar');
    Route::put('/negocios/comentarios/{id}/editar', [NegocioController::class, 'editarComentario'])->name('negocios.editar-comentario');
    Route::delete('/negocios/comentarios/{id}/eliminar', [NegocioController::class, 'eliminarComentario'])->name('negocios.eliminar-comentario');
});

// rutas públicas para ver negocios
Route::get('/negocios/buscar', [NegocioController::class, 'buscar'])->name('negocios.buscar');
Route::get('/negocios/{id}', [NegocioController::class, 'mostrarNegocio'])->name('negocios.mostrar');

// Rutas de administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/solicitudes', [AdminNegocioController::class, 'index'])->name('negocios.solicitudes');
    Route::get('/negocios/{negocio}', [AdminNegocioController::class, 'show'])->name('negocios.show');
    Route::patch('/solicitudes/{negocio}', [AdminNegocioController::class, 'update'])->name('negocios.update');
    Route::get('/negocios', [AdminNegocioPanelController::class, 'index'])->name('negocios.panel');
});

// Ruta de perfil de usuario
Route::middleware('auth')->get('/perfil', [UserController::class, 'perfil'])->name('perfil');
