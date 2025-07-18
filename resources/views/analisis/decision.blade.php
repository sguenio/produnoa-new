@extends('layouts.app')
@section('title', 'Decisión de Análisis')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('aprobaciones.index') }}"
            class="text-slate-400 hover:text-red-500">Aprobaciones Pendientes</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Decisión Lote #{{ $analisis->lote->id }}</span></li>
@endsection
@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-4xl mx-auto">
        {{-- Encabezado con Información General --}}
        <div class="border-b border-gray-700 pb-4 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-slate-100">{{ $analisis->lote->producto->nombre }}</h1>
                    <p class="text-sm text-slate-400">Lote de Proveedor: <span
                            class="font-mono text-slate-300">{{ $analisis->lote->lote_proveedor_codigo }}</span></p>
                    <p class="text-sm text-slate-400">Proveedor: <span
                            class="text-slate-300">{{ $analisis->lote->remito->proveedor->nombre }}</span></p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-400">Analizado por: <span
                            class="font-semibold text-slate-200">{{ $analisis->usuario->nombre }}</span></p>
                    <p class="text-sm text-slate-400">Fecha: <span
                            class="font-semibold text-slate-200">{{ $analisis->fecha_analisis->format('d/m/Y H:i') }}</span>
                    </p>
                    <p class="text-sm text-slate-400">Versión: <span
                            class="font-semibold text-slate-200">{{ $analisis->version }}</span></p>
                </div>
            </div>
        </div>

        {{-- Tabla de Resultados Detallados --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-200 mb-4">Resultados del Análisis</h2>
            <div class="overflow-x-auto border border-gray-700 rounded-lg">
                <table class="w-full text-sm">
                    <thead class="bg-gray-900/50">
                        <tr>
                            <th class="p-3 text-left">Parámetro</th>
                            <th class="p-3 text-left">Especificación</th>
                            <th class="p-3 text-left">Resultado Obtenido</th>
                            <th class="p-3 text-center">Veredicto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($analisis->resultados as $resultado)
                            <tr class="border-b border-gray-700 last:border-b-0">
                                <td class="p-3 font-medium">{{ $resultado->parametro->nombre }}</td>
                                <td class="p-3 text-slate-400">
                                    @php
                                        $spec = $especificaciones[$resultado->parametro_id] ?? null;
                                    @endphp
                                    @if ($spec)
                                        @if ($spec->valor_texto)
                                            {{ $spec->valor_texto }}
                                        @else
                                            Min: {{ $spec->valor_minimo ?? 'N/A' }} / Max:
                                            {{ $spec->valor_maximo ?? 'N/A' }}
                                        @endif
                                    @else
                                        <span class="italic">Sin especificar</span>
                                    @endif
                                </td>
                                <td class="p-3 font-semibold text-slate-100">{{ $resultado->valor_resultado }}</td>
                                <td class="p-3 text-center">
                                    @if ($resultado->aprueba)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-300">Pasa</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-300">No
                                            Pasa</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Observaciones y Decisión Final --}}
        {{-- 1. Cambiamos 'items-start' por 'items-stretch' para que ambas columnas tengan la misma altura --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">

            {{-- 2. Hacemos que el contenedor de observaciones sea un flexbox vertical --}}
            <div class="md:col-span-2 p-4 bg-gray-900/50 rounded-lg flex flex-col">
                <h3 class="font-semibold text-slate-200 mb-1 shrink-0">Observaciones del Analista</h3>
                {{-- 3. Hacemos que el párrafo crezca para ocupar el espacio disponible --}}
                <p class="text-slate-400 text-sm italic flex-grow">{{ $analisis->observaciones ?? 'Sin observaciones.' }}
                </p>
            </div>

            <div class="p-4 bg-gray-900 rounded-lg flex flex-col items-center justify-center gap-4">
                <p class="font-bold text-lg text-slate-200">Veredicto Final:
                    @if ($analisis->resultado_general == 'Pasa')
                        <span class="text-green-400">PASA</span>
                    @else
                        <span class="text-red-400">NO PASA</span>
                    @endif
                </p>
                <div class="flex w-full gap-2">
                    <form action="{{ route('lotes.rechazar', $analisis->lote_id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Rechazar
                            Lote</button>
                    </form>
                    <form action="{{ route('lotes.aprobar', $analisis->lote_id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700">Aprobar
                            Lote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
