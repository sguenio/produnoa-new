@extends('layouts.app')
@section('title', 'Crear Usuario')
@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><a href="{{ route('usuarios.index') }}"
            class="text-slate-400 hover:text-red-500">Usuarios</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Crear</span></li>
@endsection
@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Crear Nuevo Usuario</h1>
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="nombre" class="block text-sm font-medium text-slate-300 mb-1">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="rol" class="block text-sm font-medium text-slate-300 mb-1">Rol</label>
                    <select id="rol" name="rol" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                        <option value="Operario" @if (old('rol') == 'Operario') selected @endif>Operario</option>
                        <option value="Administrador" @if (old('rol') == 'Administrador') selected @endif>Administrador
                        </option>
                    </select>
                    @error('rol')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1">Contraseña</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1">Confirmar
                        Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-md focus:ring-1 focus:ring-red-500 focus:border-red-500">
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('usuarios.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md text-sm font-medium text-slate-200 hover:bg-gray-700">Cancelar</a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">Guardar
                    Usuario</button>
            </div>
        </form>
    </div>
@endsection
