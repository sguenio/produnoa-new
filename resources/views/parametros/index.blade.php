@extends('layouts.app')
@section('title', 'Parámetros de Análisis')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Parámetros de Análisis</span></li>
@endsection
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-100">Parámetros de Análisis</h1>
        <a href="{{ route('parametros.create') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Crear Parámetro
        </a>
    </div>
    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Parámetro</th>
                    <th>Unidad de Medida</th>
                    <th class="text-center no-sort">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parametros as $parametro)
                    <tr>
                        <td class="font-mono">{{ $parametro->id }}</td>
                        <td>{{ $parametro->nombre }}</td>
                        <td>
                            {{-- Gracias a la relación, podemos acceder al nombre de la unidad --}}
                            {{ $parametro->unidad->nombre ?? 'Ninguna' }}
                            @if ($parametro->unidad)
                                <span class="text-slate-400">({{ $parametro->unidad->abreviatura }})</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('parametros.edit', $parametro->id) }}"
                                    class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-amber-400 hover:bg-gray-700"
                                    title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('parametros.destroy', $parametro->id) }}" method="POST"
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
@endsection
