@extends('layouts.app')
@section('title', 'Timeline del Lote #' . $analisis->lote->id)

@section('breadcrumbs')
    <li class="inline-flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-red-500">Inicio</a>
    </li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('analisis.historial') }}"
            class="text-slate-400 hover:text-red-500">Historial</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Timeline Lote #{{ $analisis->lote->id }}</span></li>
@endsection

@section('content')
    {{-- Encabezado con info del lote --}}
    <div class="p-6 bg-gray-800 shadow-lg rounded-lg mb-6">
        <h1 class="text-3xl font-bold text-slate-100">{{ $analisis->lote->producto->nombre }}</h1>
        <div class="mt-2 text-sm text-slate-400 grid grid-cols-2 md:grid-cols-4 gap-4">
            <p><strong>ID Lote:</strong> <span class="font-mono text-slate-200">{{ $analisis->lote->id }}</span></p>
            <p><strong>Cód. Proveedor:</strong> <span
                    class="font-mono text-slate-200">{{ $analisis->lote->lote_proveedor_codigo }}</span></p>
            <p><strong>Proveedor:</strong> <span
                    class="text-slate-200">{{ $analisis->lote->remito->proveedor->nombre }}</span></p>
            <p><strong>Remito:</strong> <span class="text-slate-200">{{ $analisis->lote->remito->codigo_remito }}</span></p>
        </div>
    </div>

    {{-- Contenedor de la Timeline con Alpine.js --}}
    <div x-data="{ openSections: ['evento_final'] }">

        <div class="flex items-center gap-2 mb-8">
            <button
                @click="openSections = ['recepcion', 'evento_final', {{ $analisis->lote->analisis->pluck('id')->map(fn($id) => "'analisis_{$id}'")->join(',') }}]"
                class="bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold py-1.5 px-3 rounded-lg flex items-center transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                Expandir Todo
            </button>
            <button @click="openSections = []"
                class="bg-gray-600 hover:bg-gray-700 text-slate-200 text-xs font-bold py-1.5 px-3 rounded-lg flex items-center transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
                Contraer Todo
            </button>
        </div>

        {{-- Línea de Tiempo --}}
        <div class="relative pl-8">
            {{-- Línea vertical de la timeline --}}
            <div class="absolute left-0 top-0 h-full w-0.5 bg-gray-700 ml-4"></div>

            {{-- Evento 1: Recepción del Lote (con más detalles) --}}
            <div class="relative mb-8">
                <div
                    class="absolute -left-1 top-0 w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center ring-8 ring-gray-900">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                </div>
                <div class="ml-12">
                    <button
                        @click="openSections.includes('recepcion') ? openSections = openSections.filter(id => id !== 'recepcion') : openSections.push('recepcion')"
                        class="w-full text-left p-2 rounded-lg hover:bg-gray-800/50 transition-colors duration-150">
                        <p class="font-semibold text-slate-200">Lote Recibido y puesto "En Cuarentena"</p>
                        <time class="text-xs text-slate-400">{{ $analisis->lote->created_at->format('d/m/Y H:i') }}</time>
                    </button>
                    {{-- CORRECCIÓN: Contenido del dropdown con más información --}}
                    <div x-show="openSections.includes('recepcion')" x-transition
                        class="mt-2 text-sm text-slate-400 pl-4 border-l-2 border-sky-500/30 space-y-1">
                        <p><strong>Proveedor:</strong> <span
                                class="text-slate-200">{{ $analisis->lote->remito->proveedor->nombre }}</span></p>
                        <p><strong>Remito N°:</strong> <span
                                class="font-mono text-slate-200">{{ $analisis->lote->remito->codigo_remito }}</span></p>
                        <p><strong>Fecha de Recepción:</strong> <span
                                class="text-slate-200">{{ $analisis->lote->remito->fecha_recepcion->format('d/m/Y') }}</span>
                        </p>
                        <p><strong>Cantidad Recibida:</strong> <span
                                class="text-slate-200">{{ $analisis->lote->cantidad_recibida }}
                                {{ $analisis->lote->unidad->abreviatura }}</span></p>
                        @if ($analisis->lote->remito->observaciones)
                            <p class="pt-1 mt-1 border-t border-gray-700"><strong>Observaciones del Remito:</strong> <em
                                    class="text-slate-300">{{ $analisis->lote->remito->observaciones }}</em></p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Bucle para todos los análisis de este lote --}}
            @foreach ($analisis->lote->analisis->sortBy('version') as $analisisHistorial)
                <div class="relative mb-8">
                    @php
                        $isPasa = $analisisHistorial->resultado_general == 'Pasa';
                        $colorClass = $isPasa ? 'bg-green-500' : 'bg-red-500';
                        $borderColorClass = $isPasa ? 'border-green-500/30' : 'border-red-500/30';
                    @endphp
                    <div
                        class="absolute -left-1 top-0 w-8 h-8 {{ $colorClass }} rounded-full flex items-center justify-center ring-8 ring-gray-900">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-12">
                        <button
                            @click="openSections.includes('analisis_{{ $analisisHistorial->id }}') ? openSections = openSections.filter(id => id !== 'analisis_{{ $analisisHistorial->id }}') : openSections.push('analisis_{{ $analisisHistorial->id }}')"
                            class="w-full text-left p-2 rounded-lg hover:bg-gray-800/50 transition-colors duration-150">
                            <p class="font-semibold text-slate-200">Análisis v{{ $analisisHistorial->version }} <span
                                    class="font-normal text-slate-400">(por
                                    {{ $analisisHistorial->usuario->nombre }})</span></p>
                            <time
                                class="text-xs text-slate-400">{{ $analisisHistorial->fecha_analisis->format('d/m/Y H:i') }}</time>
                        </button>
                        <div x-show="openSections.includes('analisis_{{ $analisisHistorial->id }}')" x-transition
                            class="mt-2 pl-4 border-l-2 {{ $borderColorClass }}">
                            <table class="w-full text-xs mt-2">
                                @foreach ($analisisHistorial->resultados as $resultado)
                                    <tr class="border-t border-gray-700/50">
                                        <td class="py-1 pr-2 text-slate-400">{{ $resultado->parametro->nombre }}</td>
                                        <td class="py-1 px-2 font-mono text-slate-200">{{ $resultado->valor_resultado }}
                                        </td>
                                        <td class="py-1 pl-2 text-right">
                                            @if ($resultado->aprueba)
                                                <span class="text-green-400">Pasa</span>
                                            @else
                                                <span class="text-red-400">No Pasa</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if ($analisisHistorial->observaciones)
                                <div class="mt-2 pt-2 border-t border-gray-700/50">
                                    <p class="text-xs text-slate-400 italic">Observaciones:
                                        {{ $analisisHistorial->observaciones }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Evento Final: Decisión --}}
            <div class="relative">
                @php
                    $isApproved = $analisis->lote->estado === 'Listo para Producción';
                    $isRejected = $analisis->lote->estado === 'Rechazado';
                    $finalColorClass = $isApproved ? 'bg-green-500' : ($isRejected ? 'bg-red-500' : 'bg-gray-500');
                    $finalBorderClass = $isApproved
                        ? 'border-green-500/50'
                        : ($isRejected
                            ? 'border-red-500/50'
                            : 'border-gray-500/50');
                    $finalTextColorClass = $isApproved
                        ? 'text-green-300'
                        : ($isRejected
                            ? 'text-red-300'
                            : 'text-gray-300');
                @endphp
                <div
                    class="absolute -left-1 top-0 w-8 h-8 {{ $finalColorClass }} rounded-full flex items-center justify-center ring-8 ring-gray-900">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-12">
                    <p class="font-semibold text-slate-200 pt-1">Decisión Final</p>
                    <div class="mt-2 p-4 rounded-lg border {{ $finalBorderClass }} bg-gray-900/50">
                        <div class="flex items-center">
                            @if ($isApproved)
                                <svg class="w-8 h-8 text-green-400 mr-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($isRejected)
                                <svg class="w-8 h-8 text-red-400 mr-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-yellow-400 mr-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            @endif
                            <div>
                                <p class="text-xl font-bold {{ $finalTextColorClass }}">{{ $analisis->lote->estado }}</p>
                                <p class="text-xs text-slate-400">Decisión tomada el:
                                    {{ $analisis->lote->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
