@extends('layouts.app')
@section('title', 'Remitos')

@push('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printable-remito,
            #printable-remito * {
                visibility: visible;
            }

            #printable-remito {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none;
            }

            /* Estilos para forzar un tema claro en la impresión */
            #printable-remito {
                background-color: white !important;
                color: black !important;
            }

            #printable-remito h3,
            #printable-remito p,
            #printable-remito span,
            #printable-remito div,
            #printable-remito td,
            #printable-remito th {
                color: black !important;
                background-color: transparent !important;
            }
        }
    </style>
@endpush

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Remitos</span></li>
@endsection

@section('content')
    <div x-data="{ showModal: false, showObsModal: false, selectedRemito: null, modalObservaciones: '' }" @keydown.escape.window="showModal = false; showObsModal = false">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-100">Recepción de Mercadería</h1>
            <a href="{{ route('remitos.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Registrar Remito
            </a>
        </div>
        <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
            <table class="datatable w-full text-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cód. Remito</th>
                        <th>Proveedor</th>
                        <th>Fecha de Recepción</th>
                        <th class="text-center no-sort">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($remitos as $remito)
                        <tr>
                            <td class="font-mono">{{ $remito->id }}</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <span>{{ $remito->codigo_remito }}</span>
                                    {{-- 2. AÑADIMOS EL BOTÓN DE OBSERVACIONES (SOLO SI EXISTEN) --}}
                                    @if ($remito->observaciones)
                                        <button
                                            @click="showObsModal = true; modalObservaciones = `{{ e($remito->observaciones) }}`"
                                            class="text-sky-400 hover:text-sky-300" title="Ver observaciones del remito">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2s10 4.477 10 10z">
                                                </path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $remito->proveedor->nombre }}</td>
                            <td>{{ $remito->fecha_recepcion->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <button @click="selectedRemito = {{ Js::from($remito) }}; showModal = true"
                                        class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-sky-400 hover:bg-gray-700"
                                        title="Ver Remito Completo">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                    <a href="{{ route('remitos.edit', $remito->id) }}"
                                        class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-amber-400 hover:bg-gray-700"
                                        title="Editar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('remitos.destroy', $remito->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-red-500 hover:bg-gray-700"
                                            title="Eliminar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
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

        {{-- HTML para el Modal del Remito Virtual --}}
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4"
            x-cloak>
            <div @click.outside="showModal = false"
                class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col">
                <div class="p-8 text-gray-800 overflow-y-auto" id="printable-remito">
                    <div class="flex justify-between items-start pb-4 border-b">
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900" x-text="selectedRemito?.proveedor.nombre"></h3>
                            <p class="text-sm text-gray-600"
                                x-text="selectedRemito?.proveedor.direccion || 'Dirección no disponible'"></p>
                            <p class="text-sm text-gray-600"
                                x-text="selectedRemito?.proveedor.telefono || 'Teléfono no disponible'"></p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-gray-500">Código de Remito</p>
                            <p class="text-5xl font-bold font-mono text-gray-900"
                                x-text="'' + (selectedRemito?.codigo_remito || '')"></p>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mt-4">
                        <p class="text-sm">Total de Lotes: <strong x-text="selectedRemito?.lotes.length || 0"></strong>
                        </p>
                        <p class="text-sm">Recibido el: <strong
                                x-text="new Date(selectedRemito?.fecha_recepcion).toLocaleDateString('es-AR', { timeZone: 'UTC' })"></strong>
                        </p>
                    </div>
                    <div class="mt-4 border-t pt-4 space-y-2">
                        <template x-if="selectedRemito?.lotes.length > 0">
                            <template x-for="lote in selectedRemito.lotes" :key="lote.id">
                                <div class="p-3 border rounded-md flex justify-between items-center text-sm bg-gray-50">
                                    <div>
                                        <p class="font-bold text-gray-900" x-text="lote.producto.nombre"></p>
                                        <p class="text-xs text-gray-500">Lote Proveedor: <span class="font-mono"
                                                x-text="lote.lote_proveedor_codigo"></span></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold"
                                            x-text="lote.cantidad_recibida + ' ' + lote.unidad.abreviatura"></p>
                                        {{-- CORRECCIÓN: Se reemplaza el estado por la fecha de vencimiento --}}
                                        <p class="text-xs text-gray-500">Vto: <span class="font-semibold"
                                                x-text="new Date(lote.fecha_vencimiento).toLocaleDateString('es-AR', { timeZone: 'UTC' })"></span>
                                        </p>
                                    </div>
                                </div>
                            </template>
                        </template>
                        <template x-if="!selectedRemito || selectedRemito.lotes.length === 0">
                            <p class="text-sm text-center text-gray-500 py-6">Este remito aún no tiene lotes registrados.
                            </p>
                        </template>
                    </div>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-100 rounded-b-lg no-print">
                    {{-- Botón de Añadir Lote a la izquierda --}}
                    <a x-bind:href="`/remitos/${selectedRemito?.id}/lotes/create`"
                        class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        + Añadir Lote a este Remito
                    </a>

                    {{-- Grupo de botones a la derecha --}}
                    <div class="flex items-center gap-2">
                        <button @click="showModal = false"
                            class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200">
                            Cancelar
                        </button>
                        <button @click="window.print()"
                            class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. AÑADIMOS EL HTML PARA EL MODAL DE OBSERVACIONES --}}
        <div x-show="showObsModal" x-transition
            class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4" x-cloak>
            <div @click.outside="showObsModal = false"
                class="bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-lg border border-gray-700">
                <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
                    <h3 class="text-xl font-semibold text-slate-200">Observaciones del Remito</h3>
                    <button @click="showObsModal = false" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="max-h-64 overflow-y-auto text-slate-300 whitespace-pre-wrap">
                    <p x-text="modalObservaciones"></p>
                </div>
                <div class="text-right mt-6">
                    <button @click="showObsModal = false"
                        class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
