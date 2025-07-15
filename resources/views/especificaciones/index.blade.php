@extends('layouts.app')
@section('title', 'Especificaciones de ' . $categoria->nombre)

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('categorias.index') }}"
            class="text-slate-400 hover:text-red-500">Categorías</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Especificaciones</span></li>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mb-2">Plantilla de Análisis</h1>
    <p class="text-xl text-red-500 font-semibold mb-6">Categoría: {{ $categoria->nombre }}</p>

    {{-- INICIO: Sección Instructiva con Ejemplos --}}
    <div class="mb-8 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 flex flex-col">
                <div class="flex items-center">
                    <div class="p-2 bg-sky-500/20 rounded-full">
                        <svg class="w-6 h-6 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-md font-semibold text-slate-100">1. Seleccionar Parámetro</h3>
                </div>
                <p class="mt-2 text-sm text-slate-400 flex-grow">Elige la prueba de laboratorio a añadir en la plantilla de
                    esta categoría. La lista solo muestra los parámetros que aún no has asignado.</p>
                {{-- Ejemplo añadido --}}
                <div class="mt-3 bg-gray-900 rounded p-2 text-xs">
                    <span class="font-semibold text-sky-300">Ejemplo:</span>
                    <span class="text-slate-300">Eliges `pH` de la lista para añadirlo a la plantilla de los
                        'ACIDULANTES'.</span>
                </div>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 flex flex-col">
                <div class="flex items-center">
                    <div class="p-2 bg-green-500/20 rounded-full">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-md font-semibold text-slate-100">2. Valores Numéricos</h3>
                </div>
                <p class="mt-2 text-sm text-slate-400 flex-grow">Usa "Valor Mínimo" y "Valor Máximo" para pruebas
                    cuantitativas. Puedes usar ambos para un rango, o solo uno.</p>
                {{-- Ejemplo añadido --}}
                <div class="mt-3 bg-gray-900 rounded p-2 text-xs">
                    <span class="font-semibold text-green-300">Ejemplo:</span>
                    <span class="text-slate-300">Para `Pureza`, pones `99.5` en "Valor Mínimo" y dejas el máximo en
                        blanco.</span>
                </div>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 flex flex-col">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-500/20 rounded-full">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-md font-semibold text-slate-100">3. Valor de Texto</h3>
                </div>
                <p class="mt-2 text-sm text-slate-400 flex-grow">Usa este campo para pruebas cualitativas o de apariencia.
                    El resultado debe coincidir con lo que escribas aquí.</p>
                {{-- Ejemplo añadido --}}
                <div class="mt-3 bg-gray-900 rounded p-2 text-xs">
                    <span class="font-semibold text-purple-300">Ejemplo:</span>
                    <span class="text-slate-300">Para `Apariencia`, escribes `Polvo blanco cristalino`.</span>
                </div>
            </div>
        </div>
        <div class="bg-amber-500/10 border border-amber-500/30 rounded-lg p-4 flex items-center">
            <div class="p-1 bg-amber-500/20 rounded-full mr-3 shrink-0">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-xs text-amber-300">
                <strong>Regla de Oro:</strong> Para cada parámetro, define un rango numérico o un valor de texto, pero
                no ambos.
            </p>
        </div>
    </div>
    {{-- FIN: Sección Instructiva --}}

    {{-- Formulario para añadir nuevos parámetros a la plantilla --}}
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg mb-8">
        <h2 class="text-xl font-semibold text-slate-200 mb-4">Añadir Parámetro a la Plantilla</h2>
        <form action="{{ route('categorias.especificaciones.store', $categoria->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                <div class="sm:col-span-2">
                    <label for="parametro_id" class="block text-sm font-medium text-slate-300 mb-1">Parámetro</label>
                    <select id="parametro_id" name="parametro_id" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                        <option value="">Seleccionar...</option>
                        @foreach ($parametrosDisponibles as $parametro)
                            <option value="{{ $parametro->id }}">{{ $parametro->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="valor_minimo" class="block text-sm font-medium text-slate-300 mb-1">Valor Mínimo</label>
                    <input type="number" step="any" name="valor_minimo" id="valor_minimo"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                        placeholder="Ej: 2.5">
                </div>
                <div>
                    <label for="valor_maximo" class="block text-sm font-medium text-slate-300 mb-1">Valor Máximo</label>
                    <input type="number" step="any" name="valor_maximo" id="valor_maximo"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                        placeholder="Ej: 5.0">
                </div>
                <div class="sm:col-span-2 md:col-span-3">
                    <label for="valor_texto" class="block text-sm font-medium text-slate-300 mb-1">Valor de Texto
                        Esperado</label>
                    <input type="text" name="valor_texto" id="valor_texto"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500"
                        placeholder="Ej: Polvo cristalino, Incoloro, etc.">
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center justify-center">Añadir</button>
                </div>
            </div>
            @if ($errors->any())
                <div class="mt-3 text-red-400 text-sm">
                    <p class="font-medium">Por favor, corrige los siguientes errores:</p>
                    <ul class="list-disc list-inside mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    {{-- Tabla con los parámetros ya asignados a esta categoría --}}
    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <h2 class="text-xl font-semibold text-slate-200 mb-4">Especificaciones Actuales</h2>
        <table class="w-full text-sm">
            <thead class="bg-gray-900">
                <tr>
                    <th class="p-3 text-left font-semibold">Parámetro</th>
                    <th class="p-3 text-left font-semibold">Unidad</th>
                    <th class="p-3 text-left font-semibold">Valor Mínimo</th>
                    <th class="p-3 text-left font-semibold">Valor Máximo</th>
                    <th class="p-3 text-left font-semibold">Valor de Texto</th>
                    <th class="p-3 text-center no-sort font-semibold">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($especificacionesActuales as $especificacion)
                    <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                        <td class="p-3">{{ $especificacion->parametro->nombre }}</td>
                        <td class="p-3 text-slate-400">{{ $especificacion->parametro->unidad->abreviatura ?? 'N/A' }}</td>
                        <td class="p-3">{{ $especificacion->valor_minimo ?? 'N/A' }}</td>
                        <td class="p-3">{{ $especificacion->valor_maximo ?? 'N/A' }}</td>
                        <td class="p-3">{{ $especificacion->valor_texto ?? 'N/A' }}</td>
                        <td class="p-3 text-center">
                            <form
                                action="{{ route('categorias.especificaciones.destroy', ['categoria' => $categoria->id, 'especificacion' => $especificacion->id]) }}"
                                method="POST" onsubmit="return confirm('¿Quitar este parámetro de la plantilla?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400" title="Quitar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-slate-500">Esta categoría aún no tiene parámetros
                            de
                            análisis definidos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
