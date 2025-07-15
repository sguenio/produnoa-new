<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Especificacion;
use App\Models\ParametroAnalisis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EspecificacionController extends Controller
{
    public function index(Categoria $categoria)
    {
        // Carga las especificaciones existentes con sus parámetros relacionados
        $especificacionesActuales = Especificacion::where('categoria_id', $categoria->id)
            ->with('parametro.unidad')
            ->get();

        // Obtiene los IDs de los parámetros que ya están asignados a esta categoría
        $parametrosAsignadosIds = $especificacionesActuales->pluck('parametro_id');

        // Busca todos los parámetros que AÚN NO han sido asignados a esta categoría
        $parametrosDisponibles = ParametroAnalisis::whereNotIn('id', $parametrosAsignadosIds)
            ->orderBy('nombre')
            ->get();

        return view('especificaciones.index', compact('categoria', 'especificacionesActuales', 'parametrosDisponibles'));
    }

    public function store(Request $request, Categoria $categoria)
    {
        $request->validate([
            'parametro_id' => [
                'required',
                'exists:parametros_analisis,id',
                // Regla para asegurar que la combinación categoría-parámetro sea única
                Rule::unique('categorias_parametros_especificaciones')->where(function ($query) use ($categoria) {
                    return $query->where('categoria_id', $categoria->id);
                }),
            ],
            'valor_minimo' => 'nullable|numeric',
            'valor_maximo' => 'nullable|numeric|gte:valor_minimo', // gte = greater than or equal
            'valor_texto' => 'nullable|string|max:255',
        ]);

        Especificacion::create([
            'categoria_id' => $categoria->id,
            'parametro_id' => $request->parametro_id,
            'valor_minimo' => $request->valor_minimo,
            'valor_maximo' => $request->valor_maximo,
            'valor_texto' => $request->valor_texto,
        ]);

        return back()->with('success', 'Especificación añadida exitosamente.');
    }

    public function destroy(Categoria $categoria, Especificacion $especificacion)
    {
        $especificacion->delete();
        return back()->with('success', 'Especificación eliminada exitosamente.');
    }
}
