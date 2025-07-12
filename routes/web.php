<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoriaController;



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

// Rutas solo para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    // La ruta para VER la lista de categorías está aquí (accesible para Admin y Operario)
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
});


// 2. Añadimos las rutas para la administración de usuarios
// Las envolvemos en un middleware de 'auth' para que solo usuarios logueados puedan acceder.
// Ahora este grupo requiere que el usuario esté autenticado Y que sea administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('unidades', UnidadMedidaController::class)->parameters(['unidades' => 'unidadMedida']);
    Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']);
    Route::resource('categorias', CategoriaController::class)->except(['index']);
});
