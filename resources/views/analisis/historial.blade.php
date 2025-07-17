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
        <table id="historialAnalisisTable" class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID Análisis</th>
                    <th>Fecha</th>
                    <th>Lote ID</th>
                    <th>Producto</th>
                    <th>Analista</th>
                    <th>Versión</th>
                    <th>Resultado</th>
                    <th class="no-sort"></th> {{-- Columna vacía para que DataTables no dé error con el colspan --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($analisisHistorial as $analisis)
                    <tr>
                        <td class="font-mono">{{ $analisis->id }}</td>
                        <td>{{ $analisis->fecha_analisis->format('d/m/Y H:i') }}</td>
                        <td>{{ $analisis->lote->id }}</td>
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
                        <td></td> {{-- Celda vacía correspondiente a la cabecera de Acciones --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
