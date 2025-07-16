@extends('layouts.app')
@section('title', 'Historial de Análisis')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Historial de Análisis</span></li>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mb-6">Historial de Todos los Análisis</h1>

    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table class="datatable w-full text-sm" id="historialAnalisisTable">
            <thead>
                <tr>
                    <th>ID Análisis</th>
                    <th>Fecha</th>
                    <th>Lote ID</th>
                    <th>Producto</th>
                    <th>Analista</th>
                    <th>Versión</th>
                    <th>Resultado</th>
                    <th class="text-center no-sort">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($analisisHistorial as $analisis)
                    <tr>
                        <td class="font-mono">{{ $analisis->id }}</td>
                        <td>{{ $analisis->fecha_analisis->format('d/m/Y H:i') }}</td>
                        <td class="font-mono">{{ $analisis->lote->id }}</td>
                        <td>{{ $analisis->lote->producto->nombre }}</td>
                        <td>{{ $analisis->usuario->nombre }}</td>
                        <td><span class="font-semibold">v{{ $analisis->version }}</span></td>
                        <td>
                            @php
                                $resultadoClasses =
                                    $analisis->resultado_general == 'Pasa'
                                        ? 'bg-green-500/20 text-green-300'
                                        : 'bg-red-500/20 text-red-300';
                            @endphp
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $resultadoClasses }}">
                                {{ $analisis->resultado_general }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{-- Reutilizamos la vista de decisión para ver el detalle --}}
                            <a href="{{ route('analisis.decision', $analisis->id) }}"
                                class="bg-sky-600/50 hover:bg-sky-700/50 text-sky-300 font-bold py-1 px-3 rounded-lg inline-flex items-center text-xs"
                                title="Ver Detalle del Análisis">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
