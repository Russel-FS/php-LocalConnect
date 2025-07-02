<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\Admin\AdminNegocioController;
use App\Http\Controllers\Admin\AdminNegocioPanelController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServicioPredefinidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NegocioPublicoController;
use App\Http\Controllers\NegocioInteraccionController;
use App\Http\Controllers\PromocionController;

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
    Route::get('/negocios/{id}/estadisticas', [NegocioController::class, 'estadisticas'])->name('negocios.estadisticas');
    Route::get('/negocios/{id}/estadisticas-pdf', [NegocioController::class, 'estadisticasPDF'])->name('negocios.estadisticas.pdf');
    Route::get('/negocios/{id}/estadisticas-excel', [NegocioController::class, 'estadisticasExcel'])->name('negocios.estadisticas.excel');
    Route::get('/negocios/mis-negocios/{id}/ver', [NegocioController::class, 'verPropioNegocio'])->name('negocios.ver-propio');
    // Favoritos
    Route::post('/negocios/{id}/favorito', [NegocioInteraccionController::class, 'agregarFavorito'])->name('negocios.favorito.agregar');
    Route::post('/negocios/{id}/favorito/quitar', [NegocioInteraccionController::class, 'quitarFavorito'])->name('negocios.favorito.quitar');
    // Me gusta
    Route::post('/negocios/{id}/megusta', [NegocioInteraccionController::class, 'agregarMeGusta'])->name('negocios.megusta.agregar');
    Route::post('/negocios/{id}/megusta/quitar', [NegocioInteraccionController::class, 'quitarMeGusta'])->name('negocios.megusta.quitar');

    // Rutass para promociones
    Route::resource('promociones', PromocionController::class);
    Route::post('/promociones/{id}/toggle-status', [PromocionController::class, 'toggleStatus'])->name('promociones.toggle-status');
});

// rutas públicas para ver negocios
Route::get('/negocios/buscar', [NegocioPublicoController::class, 'buscar'])->name('negocios.buscar');
Route::get('/negocios/sugerencias', [NegocioPublicoController::class, 'sugere   ncias'])->name('negocios.sugerencias');
Route::get('/negocios/sugerencias-busqueda', [NegocioPublicoController::class, 'sugerenciasBusqueda'])->name('negocios.sugerencias.busqueda');
Route::get('/negocios/{id}', [NegocioPublicoController::class, 'mostrar'])->name('negocios.mostrar');

// Rutas de administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/solicitudes', [AdminNegocioController::class, 'index'])->name('negocios.solicitudes');
    Route::get('/negocios/{negocio}', [AdminNegocioController::class, 'show'])->name('negocios.show');
    Route::patch('/solicitudes/{negocio}', [AdminNegocioController::class, 'update'])->name('negocios.update');
    Route::get('/negocios', [AdminNegocioPanelController::class, 'index'])->name('negocios.panel');

    // Rutas de reportes
    Route::get('/reportes/dashboard-pdf', [AdminDashboardController::class, 'generarReportePDF'])->name('reportes.dashboard-pdf');
    Route::get('/reportes/negocios-pdf', [AdminDashboardController::class, 'generarReporteNegociosPDF'])->name('reportes.negocios-pdf');

    // Rutas de servicios predefinidos
    Route::resource('servicios-predefinidos', AdminServicioPredefinidoController::class);
    Route::patch('servicios-predefinidos/{id}/activate', [AdminServicioPredefinidoController::class, 'activate'])->name('servicios-predefinidos.activate');
    // Rutas de categorías
    Route::resource('categorias', \App\Http\Controllers\Admin\AdminCategoriaController::class);
    // Rutas de características
    Route::resource('caracteristicas', \App\Http\Controllers\Admin\AdminCaracteristicaController::class);
});

// Rutas para editar perfil y cambiar contraseña
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');
    Route::get('/perfil/editar', [UserController::class, 'editarPerfil'])->name('perfil.editar');
    Route::post('/perfil/editar', [UserController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::get('/perfil/password', [UserController::class, 'editarPassword'])->name('perfil.password');
    Route::post('/perfil/password', [UserController::class, 'actualizarPassword'])->name('perfil.password.actualizar');
});
