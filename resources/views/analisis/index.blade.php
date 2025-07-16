@extends('layouts.app')
@section('title', 'Control de Calidad')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Control de Calidad</span></li>
@endsection
@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mb-6">Lotes en Cuarentena</h1>
    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID Lote</th>
                    <th>Producto</th>
                    <th>Cód. Lote Proveedor</th>
                    <th>Proveedor</th>
                    <th>Fecha Recepción</th>
                    <th class="text-center no-sort">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lotesEnCuarentena as $lote)
                    <tr>
                        <td class="font-mono">{{ $lote->id }}</td>
                        <td>
                            <div class="font-medium text-slate-200">{{ $lote->producto->nombre }}</div>
                            <div class="text-xs text-slate-500">{{ $lote->producto->categoria->nombre }}</div>
                        </td>
                        <td>{{ $lote->lote_proveedor_codigo }}</td>
                        <td>{{ $lote->remito->proveedor->nombre }}</td>
                        <td>{{ $lote->remito->fecha_recepcion->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('analisis.create', $lote->id) }}"
                                class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2 px-3 rounded-lg inline-flex items-center text-xs">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                                Analizar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-slate-500">No hay lotes en cuarentena pendientes de
                            análisis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
