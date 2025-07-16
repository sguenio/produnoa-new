<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Especificacion;
use App\Models\Analisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalisisController extends Controller
{
    // Muestra la lista de lotes "En Cuarentena"
    public function index()
    {
        $lotesEnCuarentena = Lote::where('estado', 'En Cuarentena')
            ->with(['producto.categoria', 'remito.proveedor'])
            ->orderBy('created_at', 'asc')
            ->get();
        return view('analisis.index', compact('lotesEnCuarentena'));
    }

    // Muestra el formulario de análisis para un lote específico
    public function create(Lote $lote)
    {
        // Buscamos las especificaciones para la categoría del producto de este lote
        $especificaciones = Especificacion::where('categoria_id', $lote->producto->categoria_id)
            ->with('parametro.unidad')
            ->get();

        return view('analisis.create', compact('lote', 'especificaciones'));
    }

    // Guarda los resultados del análisis
    // app/Http/Controllers/AnalisisController.php

    public function store(Request $request, Lote $lote)
    {
        $request->validate([
            'resultados' => 'required|array',
            'resultados.*' => 'required',
            'observaciones' => 'nullable|string',
        ]);

        // Usamos una transacción para asegurar que todo se guarde correctamente o no se guarde nada
        DB::transaction(function () use ($request, $lote) {
            $especificaciones = Especificacion::where('categoria_id', $lote->producto->categoria_id)->get()->keyBy('parametro_id');
            $todosPasan = true;
            $resultadosAGuardar = [];

            // 1. Primero, procesamos y validamos todos los resultados en memoria
            foreach ($request->resultados as $parametro_id => $valor_resultado) {
                $especificacion = $especificaciones[$parametro_id] ?? null;
                $aprueba = true; // Asumimos que aprueba por defecto

                if ($especificacion) {
                    if (isset($especificacion->valor_texto)) {
                        // Validación por texto (ignorando mayúsculas/minúsculas)
                        $aprueba = (strtolower($valor_resultado) == strtolower($especificacion->valor_texto));
                    } else {
                        // Validación numérica
                        $valor_resultado_num = floatval($valor_resultado);
                        if ((isset($especificacion->valor_minimo) && $valor_resultado_num < $especificacion->valor_minimo) ||
                            (isset($especificacion->valor_maximo) && $valor_resultado_num > $especificacion->valor_maximo)
                        ) {
                            $aprueba = false;
                        }
                    }
                }

                if (!$aprueba) {
                    $todosPasan = false; // Si uno falla, el resultado general falla
                }

                $resultadosAGuardar[] = [
                    'parametro_id' => $parametro_id,
                    'valor_resultado' => $valor_resultado,
                    'aprueba' => $aprueba,
                ];
            }

            // 2. Ahora, creamos el registro principal del análisis con el resultado general ya calculado
            $analisis = $lote->analisis()->create([
                'usuario_id' => Auth::id(),
                'version' => ($lote->analisis()->max('version') ?? 0) + 1,
                'resultado_general' => $todosPasan ? 'Pasa' : 'No Pasa',
                'fecha_analisis' => now(),
                'observaciones' => $request->observaciones,
            ]);

            // 3. Finalmente, guardamos los resultados individuales
            $analisis->resultados()->createMany($resultadosAGuardar);
        });

        return redirect()->route('analisis.index')->with('success', 'Análisis del lote #' . $lote->id . ' guardado exitosamente.');
    }

    public function showAprobaciones()
    {
        // Buscamos lotes que están 'En Cuarentena' PERO que ya tienen al menos un análisis.
        $lotesPendientes = Lote::where('estado', 'En Cuarentena')
            ->has('analisis')
            ->with(['producto.categoria', 'remito.proveedor', 'analisis' => function ($query) {
                // Cargamos solo el último análisis de cada lote para mostrar el resultado más reciente
                $query->latest('version');
            }])
            ->get();

        return view('analisis.aprobaciones', compact('lotesPendientes'));
    }

    public function showDecisionForm(Analisis $analisis)
    {
        // Cargamos todas las relaciones para mostrar la información completa
        $analisis->load(['lote.producto.categoria', 'lote.remito.proveedor', 'resultados.parametro.unidad', 'usuario']);

        // Buscamos la plantilla de especificaciones para poder compararla con los resultados
        $especificaciones = Especificacion::where('categoria_id', $analisis->lote->producto->categoria_id)
            ->get()
            ->keyBy('parametro_id');

        return view('analisis.decision', compact('analisis', 'especificaciones'));
    }

    /**
     * Cambia el estado de un lote a "Listo para Producción".
     */
    public function aprobar(Lote $lote)
    {
        $lote->estado = 'Listo para Producción';
        $lote->save();

        return redirect()->route('aprobaciones.index')->with('success', "El lote #{$lote->id} ha sido APROBADO.");
    }

    /**
     * Cambia el estado de un lote a "Rechazado".
     */
    public function rechazar(Lote $lote)
    {
        $lote->estado = 'Rechazado';
        $lote->save();

        return redirect()->route('aprobaciones.index')->with('success', "El lote #{$lote->id} ha sido RECHAZADO.");
    }

    public function showHistory()
    {
        $analisisHistorial = Analisis::with(['lote.producto', 'usuario'])
            ->orderBy('lote_id', 'desc') // <-- Ordenar por Lote
            ->orderBy('version', 'asc') // Luego por versión
            ->get();

        return view('analisis.historial', compact('analisisHistorial'));
    }
}
