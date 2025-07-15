@extends('layouts.app')
@section('title', 'Editar Remito')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('remitos.index') }}"
            class="text-slate-400 hover:text-red-500">Remitos</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Editar</span></li>
@endsection
@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Editar Remito #{{ $remito->codigo_remito }}</h1>
        <form action="{{ route('remitos.update', $remito->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="proveedor_id" class="block text-sm font-medium text-slate-300 mb-1">Proveedor</label>
                    <select id="proveedor_id" name="proveedor_id" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                        <option value="">Seleccionar proveedor...</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ old('proveedor_id', $remito->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="codigo_remito" class="block text-sm font-medium text-slate-300 mb-1">Código de
                        Remito</label>
                    <input type="text" id="codigo_remito" name="codigo_remito"
                        value="{{ old('codigo_remito', $remito->codigo_remito) }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('codigo_remito')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="fecha_recepcion" class="block text-sm font-medium text-slate-300 mb-1">Fecha de
                        Recepción</label>
                    <input type="date" id="fecha_recepcion" name="fecha_recepcion"
                        value="{{ old('fecha_recepcion', $remito->fecha_recepcion->format('Y-m-d')) }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('fecha_recepcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="observaciones" class="block text-sm font-medium text-slate-300 mb-1">Observaciones
                        (Opcional)</label>
                    <textarea id="observaciones" name="observaciones" rows="3"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">{{ old('observaciones', $remito->observaciones) }}</textarea>
                    @error('observaciones')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('remitos.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Actualizar
                    Remito</button>
            </div>
        </form>
    </div>
@endsection
