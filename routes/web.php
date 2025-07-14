<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

// Rutas públicas y de autenticación
Route::get('/', function () {
    // Es mejor redirigir a la página de login si la raíz es solo para eso
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login')->middleware('guest');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::post('/logout', [AuthController::class, 'cerrarSesion'])->name('logout');


// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    // Ruta del Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas que además requieren ser Administrador
    Route::middleware('admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        // Aquí añadiremos las rutas para Proveedores, Categorías, etc.
    });
});
