<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Remito;
use App\Models\Producto;
use App\Models\Unidad;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index()
    {
        $lotes = Lote::with(['remito.proveedor', 'producto', 'unidad'])
            ->orderBy('remito_id', 'desc') // <-- Esta línea es muy importante
            ->orderBy('created_at', 'desc')
            ->get();

        return view('lotes.index', compact('lotes'));
    }

    public function create()
    {
        // Pasamos todos los datos necesarios para los <select> del formulario
        $remitos = Remito::orderBy('fecha_recepcion', 'desc')->get();
        $productos = Producto::orderBy('nombre')->get();
        $unidades = Unidad::orderBy('nombre')->get();
        return view('lotes.create', compact('remitos', 'productos', 'unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'remito_id' => 'required|exists:remitos,id',
            'producto_id' => 'required|exists:productos,id',
            'lote_proveedor_codigo' => 'required|string|max:255',
            'cantidad_recibida' => 'required|numeric|min:0',
            'unidad_id' => 'required|exists:unidades,id',
            'fecha_elaboracion' => 'nullable|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_elaboracion',
            'estado' => 'required|in:En Cuarentena,Rechazado,Listo para Producción,Agotado',
            'observaciones' => 'nullable|string',
        ]);

        Lote::create($request->all());
        return redirect()->route('lotes.index')->with('success', 'Lote registrado exitosamente.');
    }

    public function edit(Lote $lote)
    {
        // También pasamos los datos para los <select> en la vista de edición
        $remitos = Remito::orderBy('fecha_recepcion', 'desc')->get();
        $productos = Producto::orderBy('nombre')->get();
        $unidades = Unidad::orderBy('nombre')->get();
        return view('lotes.edit', compact('lote', 'remitos', 'productos', 'unidades'));
    }

    public function update(Request $request, Lote $lote)
    {
        $request->validate([
            'remito_id' => 'required|exists:remitos,id',
            'producto_id' => 'required|exists:productos,id',
            'lote_proveedor_codigo' => 'required|string|max:255',
            'cantidad_recibida' => 'required|numeric|min:0',
            'unidad_id' => 'required|exists:unidades,id',
            'fecha_elaboracion' => 'nullable|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_elaboracion',
            'observaciones' => 'nullable|string',
        ]);

        $lote->update($request->all());
        return redirect()->route('lotes.index')->with('success', 'Lote actualizado exitosamente.');
    }

    public function destroy(Lote $lote)
    {
        // Aquí podríamos añadir lógica para no permitir borrar si ya fue analizado, etc.
        $lote->delete();
        return redirect()->route('lotes.index')->with('success', 'Lote eliminado exitosamente.');
    }

    public function marcarAgotado(Lote $lote)
    {
        // Una capa extra de seguridad: solo permite esta acción si el lote está listo para producción.
        if ($lote->estado === 'Listo para Producción') {
            $lote->estado = 'Agotado';
            $lote->save();
            return redirect()->route('lotes.index')->with('success', "El lote #{$lote->id} ha sido marcado como AGOTADO.");
        }

        return redirect()->route('lotes.index')->with('error', 'Esta acción no se puede realizar sobre este lote.');
    }
}
