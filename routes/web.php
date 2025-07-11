<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::post('/logout', [AuthController::class, 'cerrarSesion'])->name('logout');

// Ruta del Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


// 2. Añadimos las rutas para la administración de usuarios
// Las envolvemos en un middleware de 'auth' para que solo usuarios logueados puedan acceder.
// Ahora este grupo requiere que el usuario esté autenticado Y que sea administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});
