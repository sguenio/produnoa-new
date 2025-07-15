<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ParametroAnalisisController;
use App\Http\Controllers\EspecificacionController;
use App\Http\Controllers\RemitoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS Y DE AUTENTICACIÓN ---
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login')->middleware('guest');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::post('/logout', [AuthController::class, 'cerrarSesion'])->name('logout');


// --- RUTAS PROTEGIDAS (Requieren iniciar sesión) ---
Route::middleware('auth')->group(function () {

    // Dashboard (accesible para todos los logueados)
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Categorías (la lista es visible para todos, la gestión es solo para admins)
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    // Remitos (CRUD accesible para todos los logueados)
    Route::resource('remitos', RemitoController::class); 



    // --- RUTAS SÓLO PARA ADMINISTRADORES ---
    Route::middleware('admin')->group(function () {
        // Excluimos 'index' porque ya está definida arriba para todos los roles
        Route::resource('categorias', CategoriaController::class)->except(['index']);
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']);
        Route::resource('unidades', UnidadController::class)->parameters(['unidades' => 'unidad']);
        Route::resource('productos', ProductoController::class);
        Route::resource('parametros', ParametroAnalisisController::class)->parameters(['parametros' => 'parametroAnalisis']);

        // --- RUTAS PARA GESTIONAR ESPECIFICACIONES DE UNA CATEGORÍA ---
        Route::prefix('categorias/{categoria}/especificaciones')->name('categorias.especificaciones.')->group(function () {
            Route::get('/', [EspecificacionController::class, 'index'])->name('index');
            Route::post('/', [EspecificacionController::class, 'store'])->name('store');
            Route::delete('/{especificacion}', [EspecificacionController::class, 'destroy'])->name('destroy');
        });



        // Aquí añadiremos el resto de los CRUDs de admin
    });
});
