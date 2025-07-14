<?php

namespace App\Http\Controllers;

use App\Models\ParametroAnalisis;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParametroAnalisisController extends Controller
{
    public function index()
    {
        // Usamos with('unidad') para cargar la relación y optimizar consultas
        $parametros = ParametroAnalisis::with('unidad')->get();
        return view('parametros.index', compact('parametros'));
    }

    public function create()
    {
        // Pasamos todas las unidades a la vista para poder mostrarlas en un <select>
        $unidades = Unidad::orderBy('nombre')->get();
        return view('parametros.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:parametros_analisis,nombre',
            'unidad_id' => 'nullable|exists:unidades,id', // Valida que la unidad exista
        ]);

        ParametroAnalisis::create($request->all());
        return redirect()->route('parametros.index')->with('success', 'Parámetro de Análisis creado exitosamente.');
    }

    public function edit(ParametroAnalisis $parametroAnalisis)
    {
        $unidades = Unidad::orderBy('nombre')->get();
        return view('parametros.edit', compact('parametroAnalisis', 'unidades'));
    }

    public function update(Request $request, ParametroAnalisis $parametroAnalisis)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', Rule::unique('parametros_analisis')->ignore($parametroAnalisis->id)],
            'unidad_id' => 'nullable|exists:unidades,id',
        ]);

        $parametroAnalisis->update($request->all());
        return redirect()->route('parametros.index')->with('success', 'Parámetro de Análisis actualizado exitosamente.');
    }

    public function destroy(ParametroAnalisis $parametroAnalisis)
    {
        $parametroAnalisis->delete();
        return redirect()->route('parametros.index')->with('success', 'Parámetro de Análisis eliminado exitosamente.');
    }
}
