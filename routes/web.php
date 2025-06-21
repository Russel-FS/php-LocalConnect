<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegocioController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// rutas de autenticación 
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/negocios/registro', [NegocioController::class, 'showRegistro'])->name('negocios.registro');
Route::post('/negocios/guardar', [NegocioController::class, 'guardar'])->name('negocios.guardar');
