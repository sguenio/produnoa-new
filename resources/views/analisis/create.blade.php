@extends('layouts.app')
@section('title', 'Realizar Análisis')

@push('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printable-analysis,
            #printable-analysis * {
                visibility: visible;
            }

            #printable-analysis {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
            }

            .no-print {
                display: none !important;
            }

            #printable-analysis * {
                color: black !important;
                background-color: white !important;
            }
        }
    </style>
@endpush

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('analisis.index') }}"
            class="text-slate-400 hover:text-red-500">Control de Calidad</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Analizar Lote</span></li>
@endsection

@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-4xl mx-auto" x-data="{ showModal: false, capturedResults: [] }">

        {{-- Información del Lote --}}
        <div class="border-b border-gray-700 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-slate-100">Análisis de Calidad</h1>
            <div class="mt-2 text-sm text-slate-400 grid grid-cols-2 md:grid-cols-3 gap-2">
                <p><strong>Lote ID:</strong> <span class="font-mono text-slate-200">{{ $lote->id }}</span></p>
                <p><strong>Producto:</strong> <span class="text-slate-200">{{ $lote->producto->nombre }}</span></p>
                <p><strong>Categoría:</strong> <span class="text-slate-200">{{ $lote->producto->categoria->nombre }}</span>
                </p>
            </div>
        </div>

        @if ($especificaciones->isEmpty())
            <div class="text-center py-8">
                <p class="text-amber-400"><strong>Advertencia:</strong> No se han definido especificaciones de análisis para
                    la categoría '{{ $lote->producto->categoria->nombre }}'.</p>
                <p class="text-slate-400 mt-2 text-sm">Por favor, pida a un administrador que configure la plantilla de
                    análisis para esta categoría.</p>
                <a href="{{ route('categorias.index') }}"
                    class="mt-4 inline-block py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Ir
                    a Categorías</a>
            </div>
        @else
            <form x-ref="analysisForm" action="{{ route('analisis.store', $lote->id) }}" method="POST"
                @submit.prevent="
                capturedResults = [];
                $refs.analysisForm.querySelectorAll('.analysis-input').forEach(input => {
                    let value = input.value;
                    // Para los select, obtenemos el texto de la opción seleccionada
                    if (input.tagName.toLowerCase() === 'select') {
                        value = input.options[input.selectedIndex].text;
                    }
                    capturedResults.push({
                        name: input.dataset.paramName,
                        value: value,
                        unit: input.dataset.paramUnit || ''
                    });
                });
                showModal = true;
              ">
                @csrf
                <div class="space-y-6">
                    {{-- Bucle para generar el formulario dinámico --}}
                    @foreach ($especificaciones as $spec)
                        <div class="bg-gray-900/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                {{ $spec->parametro->nombre }}
                                @if ($spec->parametro->unidad)
                                    <span
                                        class="text-xs text-slate-500">({{ $spec->parametro->unidad->abreviatura }})</span>
                                @endif
                            </label>

                            {{-- SI ES UNA PRUEBA DE TEXTO (CUALITATIVA) --}}
                            @if ($spec->valor_texto)
                                <div class="flex items-center gap-4">
                                    <p class="text-sm text-slate-500 flex-grow">Especificación: <span
                                            class="font-semibold text-slate-300 italic">"{{ $spec->valor_texto }}"</span>
                                    </p>
                                    <select name="resultados[{{ $spec->parametro_id }}]" required
                                        class="analysis-input w-48 px-3 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                                        data-param-name="{{ $spec->parametro->nombre }}">
                                        <option value="Cumple">Cumple</option>
                                        <option value="No Cumple">No Cumple</option>
                                    </select>
                                </div>
                                {{-- SI ES UNA PRUEBA NUMÉRICA --}}
                            @else
                                <input type="text" name="resultados[{{ $spec->parametro_id }}]"
                                    value="{{ old('resultados.' . $spec->parametro_id) }}" required
                                    class="analysis-input w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                                    placeholder="Ingrese valor numérico..."
                                    data-param-name="{{ $spec->parametro->nombre }}"
                                    data-param-unit="{{ $spec->parametro->unidad->abreviatura ?? '' }}">
                                <p class="text-xs text-slate-500 mt-1">
                                    Especificación: Min: {{ $spec->valor_minimo ?? 'N/A' }} / Max:
                                    {{ $spec->valor_maximo ?? 'N/A' }}
                                </p>
                            @endif
                        </div>
                    @endforeach

                    <div>
                        <label for="observaciones" class="block text-sm font-medium text-slate-300 mb-1">Observaciones del
                            Análisis (Opcional)</label>
                        <textarea id="observaciones" name="observaciones" rows="3"
                            class="analysis-input w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                            data-param-name="Observaciones">{{ old('observaciones') }}</textarea>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('analisis.index') }}"
                        class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                    <button type="submit"
                        class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Revisar y Guardar Análisis
                    </button>
                </div>
            </form>
        @endif

        {{-- MODAL DE CONFIRMACIÓN --}}
        <div x-show="showModal"
            class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 overflow-y-auto" x-cloak>
            <div @click.outside="showModal = false" class="bg-white rounded-lg shadow-xl w-full max-w-lg text-gray-800">
                <div class="p-8" id="printable-analysis">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Confirmar Resultados</h3>
                    <p class="text-sm text-gray-600 mb-1">Por favor, revisa los valores ingresados antes de guardar.</p>
                    <p class="text-sm text-gray-600 mb-4">Lote: <span
                            class="font-semibold text-gray-800">{{ $lote->lote_proveedor_codigo }}</span></p>

                    <div class="border-t border-b border-gray-200 py-2 space-y-2">
                        <template x-for="result in capturedResults" :key="result.name">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600" x-text="result.name + ':'"></span>
                                <span class="font-bold text-gray-900" x-text="result.value + ' ' + result.unit"></span>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="text-right p-4 bg-gray-100 rounded-b-lg no-print">
                    <button @click="showModal = false"
                        class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200">
                        Cancelar y Editar
                    </button>
                    <button @click="$refs.analysisForm.submit()"
                        class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 ml-2">
                        Confirmar y Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
