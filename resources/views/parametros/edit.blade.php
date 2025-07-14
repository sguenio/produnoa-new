@extends('layouts.app')
@section('title', 'Editar Parámetro')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('parametros.index') }}"
            class="text-slate-400 hover:text-red-500">Parámetros</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Editar</span></li>
@endsection
@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Editar Parámetro</h1>
        <form action="{{ route('parametros.update', $parametroAnalisis->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="nombre" class="block text-sm font-medium text-slate-300 mb-1">Nombre del Parámetro</label>
                    <input type="text" id="nombre" name="nombre"
                        value="{{ old('nombre', $parametroAnalisis->nombre) }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="unidad_id" class="block text-sm font-medium text-slate-300 mb-1">Unidad de Medida
                        (Opcional)</label>
                    <select id="unidad_id" name="unidad_id"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                        <option value="">Ninguna</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}"
                                {{ old('unidad_id', $parametroAnalisis->unidad_id) == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->nombre }} ({{ $unidad->abreviatura }})
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('parametros.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
