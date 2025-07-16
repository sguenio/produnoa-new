@extends('layouts.app')
@section('title', 'Aprobaciones Pendientes')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Aprobaciones Pendientes</span></li>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mb-6">Lotes Pendientes de Aprobación</h1>

    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID Lote</th>
                    <th>Producto</th>
                    <th>Cód. Lote Proveedor</th>
                    <th>Resultado Análisis</th>
                    <th>Fecha Análisis</th>
                    <th class="text-center no-sort">Acción</th>
                </tr>
            </thead>
            <tbody>
                {{-- CAMBIO: Usamos @foreach en lugar de @forelse --}}
                @foreach ($lotesPendientes as $lote)
                    <tr>
                        <td class="font-mono">{{ $lote->id }}</td>
                        <td>
                            <div class="font-medium text-slate-200">{{ $lote->producto->nombre }}</div>
                            <div class="text-xs text-slate-500">{{ $lote->producto->categoria->nombre }}</div>
                        </td>
                        <td>{{ $lote->lote_proveedor_codigo }}</td>
                        <td>
                            @php
                                $ultimoAnalisis = $lote->analisis->first();
                                $resultadoClasses =
                                    $ultimoAnalisis->resultado_general == 'Pasa'
                                        ? 'bg-green-500/20 text-green-300'
                                        : 'bg-red-500/20 text-red-300';
                            @endphp
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $resultadoClasses }}">
                                {{ $ultimoAnalisis->resultado_general }} (v{{ $ultimoAnalisis->version }})
                            </span>
                        </td>
                        <td>{{ $ultimoAnalisis->fecha_analisis->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('analisis.decision', $lote->analisis->first()->id) }}"
                                class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2 px-3 rounded-lg inline-flex items-center text-xs">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Revisar y Decidir
                            </a>
                        </td>
                    </tr>
                @endforeach
                {{-- Ya no hay bloque @empty. Si no hay lotes, este bucle no imprime nada. --}}
            </tbody>
        </table>
    </div>
@endsection
