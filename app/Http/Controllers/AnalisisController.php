<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Especificacion;
use App\Models\Analisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Actividad;

class AnalisisController extends Controller
{
    // Muestra la lista de lotes "En Cuarentena"
    public function index()
    {
        // CORRECCIÓN: Ahora solo filtramos por el estado. Si está 'En Cuarentena',
        // necesita ser analizado, sin importar si es la primera vez o un re-análisis.
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

        $resultadoGeneral = 'Pasa';

        DB::transaction(function () use ($request, $lote, &$resultadoGeneral) {
            $especificaciones = \App\Models\Especificacion::where('categoria_id', $lote->producto->categoria_id)->get()->keyBy('parametro_id');
            $todosPasan = true;
            $resultadosAGuardar = [];

            foreach ($request->resultados as $parametro_id => $valor_resultado) {
                // CORRECCIÓN: Definimos $aprueba aquí para que siempre exista
                $aprueba = true;

                $especificacion = $especificaciones[$parametro_id] ?? null;

                if ($especificacion) {
                    if (isset($especificacion->valor_texto)) {
                        $aprueba = (strtolower($valor_resultado) == strtolower($especificacion->valor_texto));
                    } else {
                        $valor_resultado_num = floatval($valor_resultado);
                        if ((isset($especificacion->valor_minimo) && $valor_resultado_num < $especificacion->valor_minimo) ||
                            (isset($especificacion->valor_maximo) && $valor_resultado_num > $especificacion->valor_maximo)
                        ) {
                            $aprueba = false;
                        }
                    }
                }

                if (!$aprueba) {
                    $todosPasan = false;
                }

                $resultadosAGuardar[] = [
                    'parametro_id' => $parametro_id,
                    'valor_resultado' => $valor_resultado,
                    'aprueba' => $aprueba,
                ];
            }

            if (!$todosPasan) {
                $resultadoGeneral = 'No Pasa';
            }

            $analisis = $lote->analisis()->create([
                'usuario_id' => Auth::id(),
                'version' => ($lote->analisis()->max('version') ?? 0) + 1,
                'resultado_general' => $resultadoGeneral,
                'fecha_analisis' => now(),
                'observaciones' => $request->observaciones,
            ]);

            $analisis->resultados()->createMany($resultadosAGuardar);

            $lote->estado = 'Pendiente de Aprobación';
            $lote->save();
        });

        Actividad::create([
            'usuario_id' => Auth::id(),
            'tipo_accion' => 'ANÁLISIS',
            'descripcion' => "Registró el análisis v{$lote->analisis()->latest()->first()->version} para el lote #{$lote->id} ({$lote->producto->nombre}) con resultado: {$resultadoGeneral}.",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('analisis.index')->with('success', 'Análisis del lote #' . $lote->id . ' guardado exitosamente.');
    }

    // app/Http/Controllers/AnalisisController.php -> showAprobaciones()
    public function showAprobaciones()
    {
        // La consulta ahora busca lotes con el estado 'Pendiente de Aprobación'
        $lotesPendientes = Lote::where('estado', 'Pendiente de Aprobación')
            ->with(['producto.categoria', 'remito.proveedor', 'analisis' => function ($query) {
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
    public function aprobar(Request $request, Lote $lote) // <-- CORRECCIÓN 2: Añadimos Request $request
    {
        $lote->estado = 'Listo para Producción';
        $lote->save();

        Actividad::create([
            'usuario_id' => Auth::id(),
            'tipo_accion' => 'DECISIÓN',
            'descripcion' => "APROBÓ el lote #{$lote->id} ({$lote->producto->nombre}).",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('aprobaciones.index')->with('success', "El lote #{$lote->id} ha sido APROBADO.");
    }

    /**
     * Cambia el estado de un lote a "Rechazado".
     */
    public function rechazar(Request $request, Lote $lote) // <-- CORRECCIÓN 2: Añadimos Request $request
    {
        $lote->estado = 'Rechazado';
        $lote->save();

        Actividad::create([
            'usuario_id' => Auth::id(),
            'tipo_accion' => 'DECISIÓN',
            'descripcion' => "RECHAZÓ el lote #{$lote->id} ({$lote->producto->nombre}).",
            'ip_address' => $request->ip(),
        ]);

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

    public function show(Analisis $analisis)
    {
        // La lógica es idéntica a la de showDecisionForm, solo que apunta a otra vista
        $analisis->load(['lote.producto.categoria', 'lote.remito.proveedor', 'resultados.parametro.unidad', 'usuario']);
        $especificaciones = \App\Models\Especificacion::where('categoria_id', $analisis->lote->producto->categoria_id)->get()->keyBy('parametro_id');

        // Apuntamos a la nueva vista 'analisis.show'
        return view('analisis.show', compact('analisis', 'especificaciones'));
    }
}
