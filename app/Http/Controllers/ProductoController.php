<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function index()
    {
        // Usamos with('categoria') para optimizar la consulta (Eager Loading)
        $productos = Producto::with('categoria')->get();

        // Obtenemos todas las categorías para los botones de filtro
        $categorias = Categoria::orderBy('nombre')->get();

        // Pasamos ambas colecciones a la vista
        return view('productos.index', compact('productos', 'categorias'));
    }

    public function create()
    {
        // Pasamos todas las categorías a la vista para poder mostrarlas en un <select>
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo_interno' => 'required|string|max:50|unique:productos,codigo_interno',
            'categoria_id' => 'required|exists:categorias,id', // Valida que la categoría exista
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all(); // También necesitamos las categorías para el formulario de edición
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo_interno' => ['required', 'string', 'max:50', Rule::unique('productos')->ignore($producto->id)],
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
