<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;      // 1. Importa la clase Event
use Illuminate\Auth\Events\Login;         // 2. Importa el evento Login
use App\Listeners\LogSuccessfulLogin; // 3. Importa tu Listener

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 4. AÑADE ESTE BLOQUE DE CÓDIGO AQUÍ
        // Esto le dice a Laravel: "Escucha el evento de Login
        // y, cuando ocurra, ejecuta la clase LogSuccessfulLogin".
        Event::listen(
            Login::class,
            LogSuccessfulLogin::class
        );
    }
}
