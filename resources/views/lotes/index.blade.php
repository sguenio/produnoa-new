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
        <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
            <table id="lotesDataTable" class="datatable w-full text-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cód. Lote Proveedor</th>
                        <th>Remito Asociado</th> {{-- Columna para agrupar (será ocultada por JS) --}}
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
                                            class="text-sky-400 hover:text-sky-300" title="Ver observaciones">
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
                                @php
                                    $estadoClasses =
                                        [
                                            'En Cuarentena' => 'bg-yellow-500/20 text-yellow-300',
                                            'Pendiente de Aprobación' => 'bg-sky-500/20 text-sky-300', 
                                            'Rechazado' => 'bg-red-500/20 text-red-300',
                                            'Listo para Producción' => 'bg-green-500/20 text-green-300',
                                            'Agotado' => 'bg-gray-500/20 text-gray-400',
                                        ][$lote->estado] ?? 'bg-gray-500/20 text-gray-400';
                                @endphp
                                <span
                                    class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClasses }}">
                                    {{ $lote->estado }}
                                </span>
                            </td>
                            <td>{{ $lote->fecha_vencimiento->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="flex justify-center items-center space-x-2">

                                    {{-- 1. BOTÓN "ANALIZAR" (habilitado solo si el estado es "En Cuarentena") --}}
                                    <button
                                        class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-sky-400 transition-colors disabled:opacity-25 disabled:cursor-not-allowed disabled:hover:bg-gray-700/50"
                                        title="Realizar Análisis" {{ $lote->estado !== 'En Cuarentena' ? 'disabled' : '' }}
                                        onclick="window.location.href='{{ route('analisis.create', $lote->id) }}'">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                            </path>
                                        </svg>
                                    </button>

                                    {{-- 2. BOTÓN "EDITAR" (siempre habilitado) --}}
                                    <a href="{{ route('lotes.edit', $lote->id) }}"
                                        class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-amber-400 hover:bg-gray-700 transition-colors"
                                        title="Editar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>

                                    {{-- 3. BOTÓN "ELIMINAR" (siempre habilitado) --}}
                                    <form action="{{ route('lotes.destroy', $lote->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-red-500 hover:bg-gray-700 transition-colors"
                                            title="Eliminar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>

                                    {{-- 4. BOTÓN "MARCAR COMO AGOTADO" (al final, ícono representativo de caja tachada) --}}
                                    <form action="{{ route('lotes.agotar', $lote->id) }}" method="POST"
                                        onsubmit="return confirm('¿Confirmas que este lote se ha consumido por completo?');">
                                        @csrf
                                        <button type="submit"
                                            class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-gray-400 hover:text-red-500 transition-colors
                    disabled:opacity-25 disabled:cursor-not-allowed disabled:hover:bg-gray-700/50"
                                            title="Marcar como Agotado"
                                            {{ $lote->estado !== 'Listo para Producción' ? 'disabled' : '' }}>
                                            {{-- Ícono: Caja tachada (archive-off) de Tabler Icons --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M8 4h11a2 2 0 1 1 0 4h-7m-4 0h-3a2 2 0 0 1 -.826 -3.822" />
                                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 1.824 -1.18m.176 -3.82v-7" />
                                                <path d="M10 12h2" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal para Observaciones --}}
        <div x-show="showModal" x-transition
            class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4" x-cloak>
            <div @click.outside="showModal = false"
                class="bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-lg border border-gray-700">
                <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
                    <h3 class="text-xl font-semibold text-slate-200">Observaciones del Lote</h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-white"><svg class="w-6 h-6"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg></button>
                </div>
                <div class="max-h-64 overflow-y-auto text-slate-300 whitespace-pre-wrap">
                    <p x-text="modalObservaciones"></p>
                </div>
                <div class="text-right mt-6"><button @click="showModal = false"
                        class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
