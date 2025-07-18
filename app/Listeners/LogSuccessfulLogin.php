<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Actividad;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        Actividad::create([
            'usuario_id' => $event->user->id,
            'tipo_accion' => 'LOGIN',
            'descripcion' => "El usuario {$event->user->nombre} inició sesión.",
            'ip_address' => request()->ip(),
        ]);
    }
}
