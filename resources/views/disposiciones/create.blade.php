@extends('layouts.app')
@section('title', 'Registrar Disposición')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('disposiciones.index') }}"
            class="text-slate-400 hover:text-red-500">Disposición de Lotes</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Registrar</span></li>
@endsection
@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-2xl mx-auto">
        <div class="border-b border-gray-700 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-slate-100">Registrar Disposición Final</h1>
            <p class="text-sm text-slate-400">Lote #{{ $lote->id }} - {{ $lote->producto->nombre }}</p>
        </div>
        <form action="{{ route('disposiciones.store', $lote->id) }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="tipo_disposicion" class="block text-sm font-medium text-slate-300 mb-1">Tipo de
                        Disposición</label>
                    <select id="tipo_disposicion" name="tipo_disposicion" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                        <option value="Devolución a Proveedor"
                            {{ old('tipo_disposicion') == 'Devolución a Proveedor' ? 'selected' : '' }}>Devolución a
                            Proveedor</option>
                        <option value="Destrucción" {{ old('tipo_disposicion') == 'Destrucción' ? 'selected' : '' }}>
                            Destrucción</option>
                    </select>
                    @error('tipo_disposicion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="fecha_disposicion" class="block text-sm font-medium text-slate-300 mb-1">Fecha de
                        Disposición</label>
                    <input type="datetime-local" id="fecha_disposicion" name="fecha_disposicion"
                        value="{{ old('fecha_disposicion', now()->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('fecha_disposicion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="motivo" class="block text-sm font-medium text-slate-300 mb-1">Motivo / Causa</label>
                    <textarea id="motivo" name="motivo" rows="4" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                        placeholder="Detallar la razón de la disposición final del lote.">{{ old('motivo') }}</textarea>
                    @error('motivo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('disposiciones.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Registrar
                    Disposición</button>
            </div>
        </form>
    </div>
@endsection
