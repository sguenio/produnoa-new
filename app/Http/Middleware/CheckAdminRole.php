<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // LÍNEA DE DEPURACIÓN: Esto detendrá la página y nos mostrará el rol exacto.

        if (!Auth::check() || Auth::user()->rol !== 'Administrador') {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
