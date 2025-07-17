@extends('layouts.app')
@section('title', 'Disposición de Lotes')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Disposición de Lotes</span></li>
@endsection
@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mb-6">Lotes Rechazados Pendientes de Disposición</h1>
    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID Lote</th>
                    <th>Producto</th>
                    <th>Cód. Lote Proveedor</th>
                    <th>Proveedor</th>
                    <th class="text-center no-sort">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lotesRechazados as $lote)
                    <tr>
                        <td class="font-mono">{{ $lote->id }}</td>
                        <td>{{ $lote->producto->nombre }}</td>
                        <td>{{ $lote->lote_proveedor_codigo }}</td>
                        <td>{{ $lote->remito->proveedor->nombre }}</td>
                        <td class="text-center">
                            <a href="{{ route('disposiciones.create', $lote->id) }}"
                                class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-3 rounded-lg inline-flex items-center text-xs">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Registrar Disposición
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-slate-500">No hay lotes rechazados pendientes de
                            disposición.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
