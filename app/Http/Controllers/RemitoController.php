<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Remito;
use Illuminate\Http\Request;

class RemitoController extends Controller
{
    public function index()
    {
        $remitos = Remito::with('proveedor')->orderBy('fecha_recepcion', 'desc')->get();
        return view('remitos.index', compact('remitos'));
    }

    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('remitos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'codigo_remito' => 'required|string|max:255',
            'fecha_recepcion' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        Remito::create($request->all());
        return redirect()->route('remitos.index')->with('success', 'Remito creado exitosamente.');
    }

    public function edit(Remito $remito)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('remitos.edit', compact('remito', 'proveedores'));
    }

    public function update(Request $request, Remito $remito)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'codigo_remito' => 'required|string|max:255',
            'fecha_recepcion' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        $remito->update($request->all());
        return redirect()->route('remitos.index')->with('success', 'Remito actualizado exitosamente.');
    }

    public function destroy(Remito $remito)
    {
        $remito->delete();
        return redirect()->route('remitos.index')->with('success', 'Remito eliminado exitosamente.');
    }
}
