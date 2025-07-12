@extends('layouts.app')
@section('title', 'Editar Proveedor')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('proveedores.index') }}"
            class="text-slate-400 hover:text-red-500">Proveedores</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span class="font-medium text-slate-200"
            aria-current="page">Editar</span></li>
@endsection
@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Editar Proveedor</h1>
        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-slate-300 mb-1">Nombre (Obligatorio)</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}"
                        required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="telefono" class="block text-sm font-medium text-slate-300 mb-1">Teléfono
                        (Obligatorio)</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}"
                        required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('telefono')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Email (Opcional)</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $proveedor->email) }}"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="direccion" class="block text-sm font-medium text-slate-300 mb-1">Dirección
                        (Opcional)</label>
                    <input type="text" id="direccion" name="direccion"
                        value="{{ old('direccion', $proveedor->direccion) }}"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('direccion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('proveedores.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
