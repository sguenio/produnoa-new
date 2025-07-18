<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Muestra el historial completo de actividades.
     */
    public function index()
    {
        // Obtenemos todas las actividades, cargando la relación con el usuario
        // y ordenando por la más reciente primero.
        $actividades = Actividad::with('usuario')->latest()->get();

        return view('actividades.index', compact('actividades'));
    }
}
