@extends('layouts.app')
@section('title', 'Historial de Disposiciones')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Historial de Disposiciones</span></li>
@endsection

@section('content')
    <div x-data="{ showModal: false, modalContent: '' }" @keydown.escape.window="showModal = false">
        <h1 class="text-3xl font-bold text-slate-100 mb-6">Historial de Disposiciones de Lotes</h1>

        <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
            <table class="datatable w-full text-sm">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Lote ID</th>
                        <th>Producto</th>
                        <th>Tipo de Disposición</th>
                        <th>Motivo</th>
                        <th>Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disposiciones as $disposicion)
                        <tr>
                            <td>{{ $disposicion->fecha_disposicion->format('d/m/Y H:i') }}</td>
                            <td class="font-mono">{{ $disposicion->lote->id }}</td>
                            <td>{{ $disposicion->lote->producto->nombre }}</td>
                            <td>
                                @php
                                    $tipoClasses =
                                        $disposicion->tipo_disposicion == 'Destrucción'
                                            ? 'bg-red-500/20 text-red-300'
                                            : 'bg-orange-500/20 text-orange-300';
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tipoClasses }}">
                                    {{ $disposicion->tipo_disposicion }}
                                </span>
                            </td>
                            <td>
                                {{-- Acortamos el motivo y añadimos un botón para ver el texto completo en un modal --}}
                                <span class="text-slate-400">{{ Str::limit($disposicion->motivo, 50) }}</span>
                                @if (strlen($disposicion->motivo) > 50)
                                    <button @click="showModal = true; modalContent = `{{ e($disposicion->motivo) }}`"
                                        class="text-sky-400 hover:text-sky-300 text-xs ml-1">(Ver más)</button>
                                @endif
                            </td>
                            <td>{{ $disposicion->usuario->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal para ver el motivo completo --}}
        <div x-show="showModal" x-transition
            class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4" x-cloak>
            <div @click.outside="showModal = false"
                class="bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-lg border border-gray-700">
                <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
                    <h3 class="text-xl font-semibold text-slate-200">Motivo de la Disposición</h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="max-h-64 overflow-y-auto text-slate-300 whitespace-pre-wrap">
                    <p x-text="modalContent"></p>
                </div>
                <div class="text-right mt-6">
                    <button @click="showModal = false"
                        class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
