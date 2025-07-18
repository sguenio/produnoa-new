@extends('layouts.app')
@section('title', 'Registro de Actividad')

@section('breadcrumbs')
    <li class="inline-flex items-center"><a href="{{ route('dashboard') }}"
            class="text-slate-400 hover:text-red-500">Inicio</a></li>
    <li class="inline-flex items-center"><span class="mx-1 text-slate-500">/</span><span
            class="font-medium text-slate-200">Registro de Actividad</span></li>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-slate-100 mb-6">Registro de Actividad del Sistema</h1>

    <div class="overflow-x-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
        <table class="datatable w-full text-sm">
            <thead class="bg-gray-900/50">
                <tr>
                    <th>Fecha y Hora</th>
                    <th>Usuario</th>
                    <th>Tipo de Acción</th>
                    <th>Descripción</th>
                    <th>Dirección IP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actividades as $actividad)
                    <tr>
                        <td>{{ $actividad->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $actividad->usuario->nombre ?? 'Sistema' }}</td>
                        <td>
                            @php
                                $colorClasses =
                                    [
                                        'CREACIÓN' => 'bg-sky-500/20 text-sky-300',
                                        'ACTUALIZACIÓN' => 'bg-amber-500/20 text-amber-300',
                                        'ELIMINACIÓN' => 'bg-red-500/20 text-red-300',
                                        'LOGIN' => 'bg-green-500/20 text-green-300',
                                    ][$actividad->tipo_accion] ?? 'bg-gray-500/20 text-gray-300';
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClasses }}">
                                {{ $actividad->tipo_accion }}
                            </span>
                        </td>
                        <td>{{ $actividad->descripcion }}</td>
                        <td class="font-mono">{{ $actividad->ip_address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
