@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-slate-100">Bienvenido, {{ explode(' ', Auth::user()->nombre)[0] }}</h1>
    <p class="mt-2 text-slate-400">Este es tu resumen de estado del sistema de trazabilidad.</p>

    {{-- Contenedor de Tarjetas de Estadísticas --}}
    <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {{-- Tarjeta: Lotes en Cuarentena --}}
        <a href="{{ route('analisis.index') }}"
            class="bg-gray-800 p-6 rounded-2xl shadow-lg hover:bg-gray-700/50 transition-colors border border-gray-700/50">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-slate-400">Lotes en Cuarentena</p>
                    <p class="text-4xl font-bold text-slate-100">{{ $stats['lotesEnCuarentena'] }}</p>
                </div>
                <div class="p-3 bg-yellow-500/20 rounded-xl"><svg class="w-6 h-6 text-yellow-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg></div>
            </div>
            <p class="text-xs text-slate-500 mt-2">Lotes esperando primer análisis.</p>
        </a>
        @if (Auth::user()->rol === 'Administrador')
            {{-- Tarjeta: Pendientes de Aprobación --}}
            <a href="{{ route('aprobaciones.index') }}"
                class="bg-gray-800 p-6 rounded-2xl shadow-lg hover:bg-gray-700/50 transition-colors border border-gray-700/50">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-400">Pendientes de Aprobación</p>
                        <p class="text-4xl font-bold text-slate-100">{{ $stats['lotesPendientesAprobacion'] }}</p>
                    </div>
                    <div class="p-3 bg-sky-500/20 rounded-xl"><svg class="w-6 h-6 text-sky-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg></div>
                </div>
                <p class="text-xs text-slate-500 mt-2">Lotes analizados esperando decisión.</p>
            </a>
            {{-- Tarjeta: Lotes para Disposición --}}
            <a href="{{ route('disposiciones.index') }}"
                class="bg-gray-800 p-6 rounded-2xl shadow-lg hover:bg-gray-700/50 transition-colors border border-gray-700/50">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-400">Lotes para Disposición</p>
                        <p class="text-4xl font-bold text-slate-100">{{ $stats['lotesParaDisposicion'] }}</p>
                    </div>
                    <div class="p-3 bg-red-500/20 rounded-xl"><svg class="w-6 h-6 text-red-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                            </path>
                        </svg></div>
                </div>
                <p class="text-xs text-slate-500 mt-2">Lotes rechazados esperando acción.</p>
            </a>
        @endif
    </div>

    {{-- Contenedor para Gráficos y Widgets de Información --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Gráfico de Dona --}}
        <div class="lg:col-span-2 bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-700/50">
            <h3 class="text-lg font-semibold text-slate-200">Distribución de Lotes por Estado</h3>
            <div class="mt-4 h-80 flex items-center justify-center">
                <canvas id="lotesPorEstadoChart" data-chart-data="{{ json_encode($stats['chartData']) }}"></canvas>
            </div>
        </div>

        {{-- Widget de Últimas Decisiones --}}
        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-700/50">
            <h3 class="text-lg font-semibold text-slate-200 mb-4">Últimas Decisiones de Calidad</h3>
            <div class="space-y-4 h-80 overflow-y-auto pr-2">
                @forelse($stats['ultimasDecisiones'] as $lote)
                    <div class="flex items-center">
                        @if ($lote->estado === 'Listo para Producción')
                            <div class="p-2 bg-green-500/20 rounded-full mr-3"><svg class="w-5 h-5 text-green-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg></div>
                        @else
                            <div class="p-2 bg-red-500/20 rounded-full mr-3"><svg class="w-5 h-5 text-red-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg></div>
                        @endif
                        <div>
                            <p class="text-sm font-medium text-slate-300">Lote #{{ $lote->id }}
                                ({{ Str::limit($lote->producto->nombre, 20) }})</p>
                            <p class="text-xs text-slate-500">{{ $lote->estado }} -
                                {{ $lote->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-center text-slate-500 pt-16">Aún no se han tomado decisiones.</p>
                @endforelse
            </div>
        </div>

        {{-- Widget Top 5 Proveedores --}}
        <div class="lg:col-span-2 bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-700/50">
            <h3 class="text-lg font-semibold text-slate-200 mb-4">Top 5 Proveedores (por N° de Remitos)</h3>
            <div class="space-y-3">
                @forelse($stats['topProveedores'] as $proveedor)
                    <div class="flex items-center justify-between text-sm">
                        <p class="text-slate-300">{{ $loop->iteration }}. {{ $proveedor->nombre }}</p>
                        <p class="font-bold text-slate-200 bg-gray-700/50 px-2 py-0.5 rounded">
                            {{ $proveedor->remitos_count }} <span class="font-normal text-slate-400">remitos</span></p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No hay datos de proveedores.</p>
                @endforelse
            </div>
        </div>

        {{-- Widget Top 5 Productos --}}
        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-700/50">
            <h3 class="text-lg font-semibold text-slate-200 mb-4">Top 5 Productos (por N° de Lotes)</h3>
            <div class="space-y-3">
                @forelse($stats['topProductos'] as $producto)
                    <div class="flex items-center justify-between text-sm">
                        <p class="text-slate-300 truncate pr-4">{{ $loop->iteration }}. {{ $producto->nombre }}</p>
                        <p class="font-bold text-slate-200 bg-gray-700/50 px-2 py-0.5 rounded shrink-0">
                            {{ $producto->lotes_count }} <span class="font-normal text-slate-400">lotes</span></p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No hay datos de productos.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
