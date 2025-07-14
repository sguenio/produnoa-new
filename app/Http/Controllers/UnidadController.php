<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadController extends Controller
{
    public function index()
    {
        $unidades = Unidad::all();
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'abreviatura' => 'required|string|max:10|unique:unidades,abreviatura',
        ]);
        Unidad::create($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidad de Medida creada exitosamente.');
    }

    public function edit(Unidad $unidad)
    {
        return view('unidades.edit', compact('unidad'));
    }

    public function update(Request $request, Unidad $unidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'abreviatura' => ['required', 'string', 'max:10', Rule::unique('unidades')->ignore($unidad->id)],
        ]);
        $unidad->update($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidad de Medida actualizada exitosamente.');
    }

    public function destroy(Unidad $unidad)
    {
        $unidad->delete();
        return redirect()->route('unidades.index')->with('success', 'Unidad de Medida eliminada exitosamente.');
    }
}
