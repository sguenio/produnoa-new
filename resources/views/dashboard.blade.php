@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <li class="inline-flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-red-500">Inicio</a>
    </li>
    <li class="inline-flex items-center">
        <span class="mx-1 text-slate-500">/</span>
        <span class="font-medium text-slate-200" aria-current="page">Dashboard</span>
    </li>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-slate-100">Bienvenido al Dashboard</h1>
    <p class="mt-2 text-slate-400">Este es tu panel principal en modo oscuro permanente.</p>

    <div class="mt-8 p-4 sm:p-6 bg-gray-800 shadow-lg rounded-lg">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
            <h2 class="text-xl font-semibold text-slate-200">Lista de Productos</h2>
            <button
                class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center justify-center transition-colors duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Añadir Producto
            </button>
        </div>

        {{-- Añadimos la clase 'datatable' para que nuestro app.js la detecte --}}
        <table id="productsDataTable" class="datatable w-full text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th class="text-center no-sort">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $categorias = ['Harinas', 'Aceites', 'Granos', 'Aditivos', 'Mezclas'];
                    $nombres = [
                        'Harina de Soja',
                        'Expeller de Girasol',
                        'Maíz Molido',
                        'Afrechillo de Trigo',
                        'Vitamina A-D-E',
                    ];
                @endphp
                @for ($i = 1; $i <= 40; $i++)
                    <tr>
                        <td class="font-mono">{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $nombres[array_rand($nombres)] }} (Lote {{ rand(100, 999) }})</td>
                        <td>{{ $categorias[array_rand($categorias)] }}</td>
                        <td>{{ rand(0, 150) }}</td>
                        <td>${{ number_format(rand(500, 99999) / 100, 2) }}</td>
                        <td class="text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <button
                                    class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-amber-400 hover:bg-gray-700 transition-colors"
                                    title="Editar Producto">
                                    <span class="sr-only">Editar</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </button>
                                <button
                                    class="h-8 w-8 rounded-full flex items-center justify-center bg-gray-700/50 text-red-500 hover:bg-gray-700 transition-colors"
                                    title="Eliminar Producto">
                                    <span class="sr-only">Eliminar</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection


