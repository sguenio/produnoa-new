@extends('layouts.app')

@section('title', 'Crear Nueva Marca')

@section('breadcrumbs')
    <li class="inline-flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-red-500">Inicio</a>
    </li>
    <li class="inline-flex items-center">
        <span class="mx-1 text-slate-500">/</span>
        <a href="{{ route('marcas.index') }}" class="text-slate-400 hover:text-red-500">Marcas</a>
    </li>
    <li class="inline-flex items-center">
        <span class="mx-1 text-slate-500">/</span>
        <span class="font-medium text-slate-200" aria-current="page">Crear</span>
    </li>
@endsection

@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Crear Nueva Marca</h1>

        <form action="{{ route('marcas.store') }}" method="POST">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-slate-300 mb-1">Nombre de la Marca</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                    class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500"
                    placeholder="Ej: GIVAUDAN">
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones de Acción --}}
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('marcas.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-slate-200 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancelar
                </a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Guardar Marca
                </button>
            </div>
        </form>
    </div>
@endsection
