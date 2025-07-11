<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verificamos si el usuario está autenticado y si su rol es 'Administrador'.
        //    Usamos Auth::user()->Rol porque así se llama la columna en tu tabla.
        if (!Auth::check() || Auth::user()->Rol !== 'Administrador') {
            // 2. Si no es un administrador, le negamos el acceso.
            //    abort(403) muestra una página de error "Forbidden" (Prohibido).
            abort(403, 'Acceso no autorizado.');
        }

        // 3. Si es un administrador, le permitimos continuar con la petición.
        return $next($request);
    }
}
