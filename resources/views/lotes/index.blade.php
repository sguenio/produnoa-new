@extends('layouts.app')
@section('title', 'Gestión de Lotes')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Lotes</span></li>
@endsection

@section('content')
    <div x-data="{ showModal: false, modalObservaciones: '' }" @keydown.escape.window="showModal = false">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-100">Gestión de Lotes</h1>
            <a href="{{ route('lotes.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Registrar Lote
            </a>
        </div>

        {{-- INICIO: Filtros por Estado --}}
        <div class="mb-4">
            <span class="text-sm font-semibold text-slate-300 mr-3">Filtrar por estado:</span>
            <div class="inline-flex flex-wrap gap-2 mt-2 sm:mt-0">
                @php
                    $statusColors = [
                        'Todos' => 'bg-slate-600 text-white hover:bg-slate-500',
                        'En Cuarentena' => 'bg-yellow-200 text-yellow-800 hover:bg-yellow-300',
                        'Pendiente de Aprobación' => 'bg-sky-200 text-sky-800 hover:bg-sky-300',
                        'Listo para Producción' => 'bg-green-200 text-green-800 hover:bg-green-300',
                        'Rechazado' => 'bg-red-200 text-red-800 hover:bg-red-300',
                        'Agotado' => 'bg-gray-200 text-gray-800 hover:bg-gray-300',
                    ];
                @endphp
                <button data-status=""
                    class="lote-status-filter-btn px-3 py-1 text-xs font-medium rounded-full transition-colors {{ $statusColors['Todos'] }}">Todos</button>
                @foreach (['En Cuarentena', 'Pendiente de Aprobación', 'Listo para Producción', 'Rechazado', 'Agotado'] as $status)
                    <button data-status="{{ $status }}"
                        class="lote-status-filter-btn px-3 py-1 text-xs font-medium rounded-full transition-colors {{ $statusColors[$status] }}">{{ $status }}</button>
                @endforeach
            </div>
        </div>
        {{-- FIN: Filtros por Estado --}}

        <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
            <table id="lotesDataTable" class="datatable w-full text-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cód. Lote Proveedor</th>
                        <th>Remito Asociado</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Fecha Vto.</th>
                        <th class="text-center no-sort">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lotes as $lote)
                        <tr>
                            <td class="font-mono">{{ $lote->id }}</td>
                            <td>
                                <div class="font-medium text-slate-200">{{ $lote->producto->nombre }}</div>
                                <div class="text-xs text-slate-500">Cód: {{ $lote->producto->codigo_interno }}</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <span>{{ $lote->lote_proveedor_codigo }}</span>
                                    @if ($lote->observaciones)
                                        <button
                                            @click="showModal = true; modalObservaciones = `{{ e($lote->observaciones) }}`"
                                            class="text-sky-400 hover:text-sky-300" title="Ver observaciones del lote">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2s10 4.477 10 10z">
                                                </path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $lote->remito->codigo_remito }}</td>
                            <td>{{ $lote->cantidad_recibida }} {{ $lote->unidad->abreviatura }}</td>
                            <td>
                                <span
                                    class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$lote->estado] ?? 'bg-gray-500/20 text-gray-400' }}">{{ $lote->estado }}</span>
                            </td>
                            <td>{{ $lote->fecha_vencimiento->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    {{-- Aquí va la botonera corregida que te pasé en el paso anterior --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Aquí va el código de los modales --}}
    </div>
@endsection
