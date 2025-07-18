<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Actividad; // <-- Importa el modelo Actividad
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        // --- Estadísticas para las Tarjetas ---
        $stats['lotesEnCuarentena'] = Lote::where('estado', 'En Cuarentena')->count();
        if ($user->rol === 'Administrador') {
            $stats['lotesPendientesAprobacion'] = Lote::where('estado', 'Pendiente de Aprobación')->count();
            $stats['lotesParaDisposicion'] = Lote::where('estado', 'Rechazado')->doesntHave('disposicion')->count();
        }

        // --- Datos para el Gráfico de Pastel ---
        $lotesPorEstado = Lote::select('estado', DB::raw('count(*) as total'))->groupBy('estado')->get()->pluck('total', 'estado');
        $stats['chartData'] = ['labels' => $lotesPorEstado->keys(), 'data' => $lotesPorEstado->values()];

        // --- AÑADIMOS LA LÓGICA PARA ACTIVIDAD RECIENTE ---
        // Obtenemos las últimas 7 actividades, cargando la relación con el usuario
        $stats['actividadesRecientes'] = Actividad::with('usuario')->latest()->take(7)->get();

        return view('dashboard', compact('stats'));
    }
}
