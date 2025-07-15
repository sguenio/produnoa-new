@extends('layouts.app')
@section('title', 'Remitos')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Remitos</span></li>
@endsection

@section('content')
    {{-- 1. Añadimos el estado de Alpine para controlar el modal --}}
    <div x-data="{ showModal: false, modalObservaciones: '' }">
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
                                    {{-- 2. Mostramos el icono SOLO si hay observaciones --}}
                                    @if ($remito->observaciones)
                                        <button
                                            @click="showModal = true; modalObservaciones = `{{ e($remito->observaciones) }}`"
                                            class="text-sky-400 hover:text-sky-300" title="Ver observaciones">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
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
                                    <a href="#"
                                        class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-sky-400 hover:bg-gray-700"
                                        title="Ver Lotes">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                    </a>
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

        {{-- 3. HTML para el Modal (inicialmente oculto) --}}
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4" x-cloak>
            {{-- Contenido del Modal --}}
            <div @click.outside="showModal = false"
                class="bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-lg border border-gray-700">
                <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
                    <h3 class="text-xl font-semibold text-slate-200">Observaciones del Remito</h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                {{-- Aquí se muestra el contenido dinámico de la observación --}}
                <div class="prose prose-invert max-w-none text-slate-300">
                    <p x-text="modalObservaciones"></p>
                </div>
                <div class="text-right mt-6">
                    <button @click="showModal = false"
                        class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
