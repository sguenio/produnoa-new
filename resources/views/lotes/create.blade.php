@extends('layouts.app')
@section('title', 'Registrar Lote')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('lotes.index') }}"
            class="text-slate-400 hover:text-red-500">Lotes</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Registrar</span></li>
@endsection

@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Registrar Nuevo Lote</h1>

        <form action="{{ route('lotes.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Remito Asociado --}}
                <div>
                    <label for="remito_id" class="block text-sm font-medium text-slate-300 mb-1">Remito Asociado</label>
                    {{-- Si venimos desde un remito específico, el campo está pre-seleccionado y bloqueado --}}
                    @if ($remito)
                        <input type="hidden" name="remito_id" value="{{ $remito->id }}">
                        <input type="text" value="{{ $remito->codigo_remito }} ({{ $remito->proveedor->nombre }})"
                            disabled class="w-full px-3 py-2 bg-gray-900/50 border border-gray-700 rounded-md">
                    @else
                        {{-- Si no, mostramos el selector de búsqueda como antes --}}
                        <select id="remito_id" name="remito_id" required class="w-full select2-enable">
                            <option></option>
                            @foreach ($remitos as $remitoItem)
                                <option value="{{ $remitoItem->id }}"
                                    {{ old('remito_id') == $remitoItem->id ? 'selected' : '' }}>
                                    N° {{ $remitoItem->codigo_remito }} ({{ $remitoItem->proveedor->nombre }})
                                </option>
                            @endforeach
                        </select>
                    @endif
                    @error('remito_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Producto --}}
                <div class="lg:col-span-2">
                    <label for="producto_id" class="block text-sm font-medium text-slate-300 mb-1">Producto</label>
                    <select id="producto_id" name="producto_id" required class="w-full select2-enable">
                        <option></option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}"
                                {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }} (Cód: {{ $producto->codigo_interno }})
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Código Lote del Proveedor --}}
                <div>
                    <label for="lote_proveedor_codigo" class="block text-sm font-medium text-slate-300 mb-1">Cód. Lote del
                        Proveedor</label>
                    <input type="text" id="lote_proveedor_codigo" name="lote_proveedor_codigo"
                        value="{{ old('lote_proveedor_codigo') }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('lote_proveedor_codigo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Cantidad Recibida --}}
                <div>
                    <label for="cantidad_recibida" class="block text-sm font-medium text-slate-300 mb-1">Cantidad
                        Recibida</label>
                    <input type="number" step="any" id="cantidad_recibida" name="cantidad_recibida"
                        value="{{ old('cantidad_recibida') }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('cantidad_recibida')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Unidad de Medida --}}
                <div>
                    <label for="unidad_id" class="block text-sm font-medium text-slate-300 mb-1">Unidad</label>
                    <select id="unidad_id" name="unidad_id" required class="w-full select2-enable">
                        <option></option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}" {{ old('unidad_id') == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->nombre }} ({{ $unidad->abreviatura }})
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fecha de Elaboración --}}
                <div>
                    <label for="fecha_elaboracion" class="block text-sm font-medium text-slate-300 mb-1">Fecha Elaboración
                        (Opcional)</label>
                    <input type="date" id="fecha_elaboracion" name="fecha_elaboracion"
                        value="{{ old('fecha_elaboracion') }}"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('fecha_elaboracion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fecha de Vencimiento --}}
                <div>
                    <label for="fecha_vencimiento" class="block text-sm font-medium text-slate-300 mb-1">Fecha
                        Vencimiento</label>
                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento"
                        value="{{ old('fecha_vencimiento') }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('fecha_vencimiento')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Estado (oculto, por defecto es 'En Cuarentena' según tu flujo) --}}
                <input type="hidden" name="estado" value="En Cuarentena">
            </div>

            {{-- Observaciones --}}
            <div class="mt-6">
                <label for="observaciones" class="block text-sm font-medium text-slate-300 mb-1">Observaciones
                    (Opcional)</label>
                <textarea id="observaciones" name="observaciones" rows="3"
                    class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">{{ old('observaciones') }}</textarea>
                @error('observaciones')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones de Acción --}}
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('lotes.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Registrar
                    Lote</button>
            </div>
        </form>
    </div>
@endsection
