@extends('layouts.app')
@section('title', 'Productos')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Productos</span></li>
@endsection

@section('content')
    {{-- 1. Definimos el mapa de colores UNA SOLA VEZ aquí arriba --}}
    @php
        $colors = [
            'SABORIZANTES' => 'bg-blue-200 text-blue-800 hover:bg-blue-300',
            'ACIDULANTES' => 'bg-green-200 text-green-800 hover:bg-green-300',
            'COLORANTES' => 'bg-amber-200 text-amber-800 hover:bg-amber-300',
            'EDULCORANTES' => 'bg-purple-200 text-purple-800 hover:bg-purple-300',
            'JUGOS' => 'bg-orange-200 text-orange-800 hover:bg-orange-300',
            'OTROS' => 'bg-gray-200 text-gray-800 hover:bg-gray-300',
        ];
    @endphp

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-100">Gestión de Productos</h1>
        <a href="{{ route('productos.create') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Crear Producto
        </a>
    </div>

    {{-- Filtros por Categoría --}}
    <div class="mb-4">
        <span class="text-sm font-semibold text-slate-300 mr-3">Filtrar por categoría:</span>
        <div class="inline-flex flex-wrap gap-2 mt-2 sm:mt-0">
            <button
                class="category-filter-btn px-3 py-1 text-xs font-medium rounded-full bg-slate-600 text-white hover:bg-slate-500 transition-colors">
                Todos
            </button>
            @foreach ($categorias as $categoria)
                <button data-category="{{ $categoria->nombre }}"
                    class="category-filter-btn px-3 py-1 text-xs font-medium rounded-full transition-colors {{ $colors[$categoria->nombre] ?? 'bg-gray-200 text-gray-800' }}">
                    {{ $categoria->nombre }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table id="productsDataTable" class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cód. Interno</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th class="text-center no-sort">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td class="font-mono">{{ $producto->id }}</td>
                        <td>{{ $producto->codigo_interno }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>
                            {{-- Ahora podemos usar la variable $colors aquí sin problemas --}}
                            <span
                                class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $colors[$producto->categoria->nombre] ?? 'bg-gray-500 text-gray-100' }}">
                                {{ $producto->categoria->nombre }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('productos.edit', $producto->id) }}"
                                    class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-amber-400 hover:bg-gray-700"
                                    title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
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
