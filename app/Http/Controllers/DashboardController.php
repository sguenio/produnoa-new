<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Actividad;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        // --- Estadísticas para las Tarjetas Superiores ---
        $stats['lotesEnCuarentena'] = Lote::where('estado', 'En Cuarentena')->count();
        if ($user->rol === 'Administrador') {
            $stats['lotesPendientesAprobacion'] = Lote::where('estado', 'Pendiente de Aprobación')->count();
            $stats['lotesParaDisposicion'] = Lote::where('estado', 'Rechazado')->doesntHave('disposicion')->count();
        }

        // --- Datos para el Gráfico de Pastel ---
        $lotesPorEstado = Lote::select('estado', DB::raw('count(*) as total'))->groupBy('estado')->get()->pluck('total', 'estado');
        $stats['chartData'] = ['labels' => $lotesPorEstado->keys(), 'data' => $lotesPorEstado->values()];

        // --- NUEVA LÓGICA PARA LOS WIDGETS ---

        // Top 5 Proveedores con más Remitos
        $stats['topProveedores'] = Proveedor::withCount('remitos')
            ->orderBy('remitos_count', 'desc')
            ->take(5)
            ->get();

        // Top 5 Productos más recibidos (contando lotes)
        $stats['topProductos'] = Producto::withCount('lotes')
            ->orderBy('lotes_count', 'desc')
            ->take(5)
            ->get();

        // Últimas 5 decisiones de calidad (lotes que pasaron de Pendiente a otro estado)
        $stats['ultimasDecisiones'] = Lote::whereIn('estado', ['Listo para Producción', 'Rechazado'])
            ->orderBy('updated_at', 'desc')
            ->with('producto')
            ->take(5)
            ->get();


        return view('dashboard', compact('stats'));
    }
}
