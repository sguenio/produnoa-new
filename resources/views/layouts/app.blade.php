{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación Produnoa')</title>

    {{-- Script CDN de Tailwind ELIMINADO. Ya se carga con Vite --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('styles')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-900 text-slate-300 min-h-screen" x-data="{
    sidebarOpen: window.innerWidth >= 768,
    isMobile() { return window.innerWidth < 768 }
}"
    @resize.window="if (!isMobile()) sidebarOpen = true">

    <div x-show="sidebarOpen && isMobile()" @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-45" x-cloak></div>

    <x-sidebar />
    <x-header />

    <main class="transition-all duration-300 ease-in-out px-6 pt-20 pb-8"
        :class="{ 'md:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
