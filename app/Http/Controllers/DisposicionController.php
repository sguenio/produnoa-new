<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Disposicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposicionController extends Controller
{
    /**
     * Muestra la lista de lotes rechazados que necesitan una disposición.
     */
    public function index()
    {
        // Buscamos lotes 'Rechazados' que NO TENGAN una disposición ya registrada.
        $lotesRechazados = Lote::where('estado', 'Rechazado')
            ->doesntHave('disposicion')
            ->with(['producto', 'remito.proveedor'])
            ->get();

        return view('disposiciones.index', compact('lotesRechazados'));
    }

    /**
     * Muestra el formulario para registrar la disposición de un lote.
     */
    public function create(Lote $lote)
    {
        // Verificación por si se intenta acceder a un lote no rechazado.
        if ($lote->estado !== 'Rechazado' || $lote->disposicion) {
            return redirect()->route('disposiciones.index')->with('error', 'Este lote no requiere una disposición.');
        }
        return view('disposiciones.create', compact('lote'));
    }

    /**
     * Guarda la nueva disposición en la base de datos.
     */
    public function store(Request $request, Lote $lote)
    {
        $request->validate([
            'tipo_disposicion' => 'required|in:Devolución a Proveedor,Destrucción',
            'motivo' => 'required|string',
            'fecha_disposicion' => 'required|date',
        ]);

        Disposicion::create([
            'lote_id' => $lote->id,
            'usuario_id' => Auth::id(),
            'tipo_disposicion' => $request->tipo_disposicion,
            'motivo' => $request->motivo,
            'fecha_disposicion' => $request->fecha_disposicion,
        ]);

        // Podríamos cambiar el estado del lote a "Disposición Finalizada" si quisiéramos.
        // Por ahora, simplemente lo dejamos como "Rechazado".

        return redirect()->route('disposiciones.index')->with('success', 'Disposición para el lote #' . $lote->id . ' registrada exitosamente.');
    }

    public function showHistory()
    {
        // Buscamos TODAS las disposiciones y cargamos sus relaciones para mostrarlas en la tabla.
        $disposiciones = Disposicion::with(['lote.producto', 'usuario'])
            ->orderBy('fecha_disposicion', 'desc')
            ->get();

        return view('disposiciones.historial', compact('disposiciones'));
    }
}
