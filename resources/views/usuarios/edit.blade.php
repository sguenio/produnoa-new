@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('breadcrumbs')
    <li class="inline-flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-red-500">Inicio</a>
    </li>
    <li class="inline-flex items-center">
        <span class="mx-1 text-slate-500">/</span>
        <a href="{{ route('usuarios.index') }}" class="text-slate-400 hover:text-red-500">Usuarios</a>
    </li>
    <li class="inline-flex items-center">
        <span class="mx-1 text-slate-500">/</span>
        <span class="font-medium text-slate-200" aria-current="page">Editar</span>
    </li>
@endsection

@section('content')
    <div class="p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-slate-100 mb-6">Editar Usuario: {{ $usuario->Nombre }} {{ $usuario->Apellido }}
        </h1>

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Directiva para indicar que es una petición de actualización --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Campo Nombre --}}
                <div>
                    <label for="Nombre" class="block text-sm font-medium text-slate-300 mb-1">Nombre</label>
                    <input type="text" id="Nombre" name="Nombre" value="{{ old('Nombre', $usuario->Nombre) }}"
                        required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('Nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Campo Apellido --}}
                <div>
                    <label for="Apellido" class="block text-sm font-medium text-slate-300 mb-1">Apellido</label>
                    <input type="text" id="Apellido" name="Apellido" value="{{ old('Apellido', $usuario->Apellido) }}"
                        required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('Apellido')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Campo Email --}}
                <div class="md:col-span-2">
                    <label for="Email" class="block text-sm font-medium text-slate-300 mb-1">Correo Electrónico</label>
                    <input type="email" id="Email" name="Email" value="{{ old('Email', $usuario->Email) }}" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    @error('Email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Campo Rol --}}
                <div>
                    <label for="Rol" class="block text-sm font-medium text-slate-300 mb-1">Rol</label>
                    <select id="Rol" name="Rol" required
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                        <option value="Operario" @if (old('Rol', $usuario->Rol) == 'Operario') selected @endif>Operario</option>
                        <option value="Administrador" @if (old('Rol', $usuario->Rol) == 'Administrador') selected @endif>Administrador
                        </option>
                    </select>
                    @error('Rol')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Campo Contraseña (Opcional) --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1">Nueva Contraseña
                        (Opcional)</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500"
                        placeholder="Dejar en blanco para no cambiar">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Campo Confirmar Contraseña (Opcional) --}}
                <div class="md:col-span-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1">Confirmar Nueva
                        Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-slate-200 rounded-md shadow-sm focus:ring-1 focus:ring-red-500 focus:border-red-500">
                </div>
            </div>
            {{-- Botones de Acción --}}
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('usuarios.index') }}"
                    class="py-2 px-4 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-slate-200 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancelar
                </a>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
@endsection
