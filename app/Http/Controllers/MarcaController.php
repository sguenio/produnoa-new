<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. Obtiene todas las marcas de la base de datos
        $marcas = Marca::all();

        // 3. Devuelve la vista y le pasa la variable 'marcas'
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100|unique:marcas,nombre',
        ]);

        // 2. Creación de la marca en la base de datos
        Marca::create([
            'nombre' => $request->nombre,
        ]);

        // 3. Redireccionar con un mensaje de éxito
        return redirect()->route('marcas.index')
            ->with('success', 'Marca creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        // Laravel automáticamente encuentra la marca por su ID (Route Model Binding)
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        // Validación (la regla 'unique' debe ignorar a la marca actual)
        $request->validate([
            'nombre' => ['required', 'string', 'max:100', Rule::unique('marcas')->ignore($marca->id)],
        ]);

        // Actualizamos el registro
        $marca->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('marcas.index')
            ->with('success', 'Marca actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        // A diferencia de los usuarios, aquí no necesitamos una comprobación de seguridad
        // extra, ya que eliminar una marca no bloquea la aplicación.
        // Simplemente ejecutamos el borrado suave.
        $marca->delete();

        return redirect()->route('marcas.index')
            ->with('success', 'Marca eliminada exitosamente.');
    }
}
