<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para consultas directas
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        // --- Estadísticas para las Tarjetas ---
        // Esta es visible para todos
        $stats['lotesEnCuarentena'] = Lote::where('estado', 'En Cuarentena')->count();

        // Estas solo se calculan para el Administrador
        if ($user->rol === 'Administrador') {
            $stats['lotesPendientesAprobacion'] = Lote::where('estado', 'Pendiente de Aprobación')->count();
            $stats['lotesParaDisposicion'] = Lote::where('estado', 'Rechazado')->doesntHave('disposicion')->count();
        }

        // --- Datos para el Gráfico de Pastel ---
        // Contamos todos los lotes y los agrupamos por su estado
        $lotesPorEstado = Lote::select('estado', DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->get()
            ->pluck('total', 'estado');

        // Preparamos los datos para que el gráfico los entienda fácilmente
        $stats['chartData'] = [
            'labels' => $lotesPorEstado->keys(),
            'data' => $lotesPorEstado->values(),
        ];

        return view('dashboard', compact('stats'));
    }
}
