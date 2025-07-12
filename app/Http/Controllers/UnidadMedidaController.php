<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        $unidades = UnidadMedida::all();
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:100|unique:unidad_medidas,nombre']);
        UnidadMedida::create($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidad de Medida creada exitosamente.');
    }

    public function edit(UnidadMedida $unidadMedida)
    {
        return view('unidades.edit', compact('unidadMedida'));
    }

    public function update(Request $request, UnidadMedida $unidadMedida)
    {
        $request->validate(['nombre' => ['required', 'string', 'max:100', Rule::unique('unidad_medidas')->ignore($unidadMedida->id)]]);
        $unidadMedida->update($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidad de Medida actualizada exitosamente.');
    }

    public function destroy(UnidadMedida $unidadMedida)
    {
        $unidadMedida->delete();
        return redirect()->route('unidades.index')->with('success', 'Unidad de Medida eliminada exitosamente.');
    }
}
