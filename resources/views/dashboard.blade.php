{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <li class="inline-flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-red-500">Inicio</a>
    </li>
    <li class="inline-flex items-center">
        <span class="mx-2 text-slate-500">/</span>
        <span class="font-medium text-slate-200" aria-current="page">Dashboard</span>
    </li>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mt-6 md:mt-2">Bienvenido al Dashboard</h1>
    <p class="mt-2 text-slate-400">Este es tu panel principal en modo oscuro permanente.</p>

    <div class="mt-8 p-6 bg-gray-800 shadow-lg rounded-lg">
        <h2 class="text-xl font-semibold text-slate-200 mb-3">Sección de Ejemplo</h2>
        <p class="text-slate-400">
            Contenido dentro de una tarjeta. El rojo <span class="text-red-500 font-semibold">Produnoa</span> se usa para
            acentos.
        </p>
    </div>
@endsection
