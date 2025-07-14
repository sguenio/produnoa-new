<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;

// Rutas públicas y de autenticación
Route::get('/', function () {
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
        Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']);
        // Aquí añadiremos las otras rutas de admin más adelante
    });
});
