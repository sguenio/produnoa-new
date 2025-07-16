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
use App\Http\Controllers\LoteController;
use App\Http\Controllers\AnalisisController;

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
    Route::resource('lotes', LoteController::class);
    Route::post('/lotes/{lote}/agotar', [LoteController::class, 'marcarAgotado'])->name('lotes.agotar');


    // --- RUTAS PARA EL FLUJO DE ANÁLISIS DE CALIDAD ---
    Route::get('/control-calidad', [AnalisisController::class, 'index'])->name('analisis.index');
    Route::get('/lotes/{lote}/analizar', [AnalisisController::class, 'create'])->name('analisis.create');
    Route::post('/lotes/{lote}/analizar', [AnalisisController::class, 'store'])->name('analisis.store');

    // Análisis decisión
    Route::get('/analisis/{analisis}/decision', [AnalisisController::class, 'showDecisionForm'])->name('analisis.decision');

    // Ver análisis (HISTORIAL)
    Route::get('/analisis/{analisis}', [AnalisisController::class, 'show'])->name('analisis.show');





    // --- RUTAS SÓLO PARA ADMINISTRADORES ---
    Route::middleware('admin')->group(function () {
        // Excluimos 'index' porque ya está definida arriba para todos los roles
        Route::resource('categorias', CategoriaController::class)->except(['index']);
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']);
        Route::resource('unidades', UnidadController::class)->parameters(['unidades' => 'unidad']);
        Route::resource('productos', ProductoController::class);
        Route::resource('parametros', ParametroAnalisisController::class)->parameters(['parametros' => 'parametroAnalisis']);

        // Aprobaciones
        Route::get('/aprobaciones', [AnalisisController::class, 'showAprobaciones'])->name('aprobaciones.index');
        Route::post('/lotes/{lote}/aprobar', [AnalisisController::class, 'aprobar'])->name('lotes.aprobar');
        Route::post('/lotes/{lote}/rechazar', [AnalisisController::class, 'rechazar'])->name('lotes.rechazar');



        // --- RUTAS PARA GESTIONAR ESPECIFICACIONES DE UNA CATEGORÍA ---
        Route::prefix('categorias/{categoria}/especificaciones')->name('categorias.especificaciones.')->group(function () {
            Route::get('/', [EspecificacionController::class, 'index'])->name('index');
            Route::post('/', [EspecificacionController::class, 'store'])->name('store');
            Route::delete('/{especificacion}', [EspecificacionController::class, 'destroy'])->name('destroy');
        });


        // Historial de análisis
        Route::get('/historial/analisis', [AnalisisController::class, 'showHistory'])->name('analisis.historial');




        // Aquí añadiremos el resto de los CRUDs de admin
    });
});
