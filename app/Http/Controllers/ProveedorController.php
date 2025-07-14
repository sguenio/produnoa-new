<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:proveedores,nombre',
            'telefono' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255',
<<<<<<< Updated upstream
=======
            'info_adicional' => 'nullable|string',
>>>>>>> Stashed changes
        ]);

        Proveedor::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:100', Rule::unique('proveedores')->ignore($proveedor->id)],
            'telefono' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255',
<<<<<<< Updated upstream
=======
            'info_adicional' => 'nullable|string',
>>>>>>> Stashed changes
        ]);

        $proveedor->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
