<!DOCTYPE html>
<html lang="es" class="dark"> {{-- Clase 'dark' permanente --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>@yield('title', 'Mi Aplicación Produnoa')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-900 text-slate-300 min-h-screen" {{-- Estilos base del tema oscuro --}} x-data="{
    sidebarOpen: window.innerWidth >= 768,
    isMobile() { return window.innerWidth < 768 }
}"
    @resize.window="if (!isMobile()) sidebarOpen = true">
    {{-- Capa de superposición para el sidebar en móvil --}}
    <div x-show="sidebarOpen && isMobile()" @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-45" x-cloak></div>

    <x-sidebar />
    <x-header />

    <main class="pt-16 transition-all duration-300 ease-in-out px-6 pt-20 pb-8" {{-- Cambiado py-X a pt-32 (8rem) --}}
        :class="{ 'md:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
        @yield('content')
    </main>

    {{-- Script de Alpine.js ya no necesita manejar darkMode --}}
    {{-- Si Alpine.store('alpineGlobal') solo se usaba para darkMode, se puede eliminar el script o simplificar --}}
    {{-- Por ahora, lo dejamos por si se usa para otras cosas globales en el futuro, pero sin la parte de darkMode --}}
    <script>
        document.addEventListener('alpine:init', () => {
            // Alpine.store('alpineGlobal', {
            //    // otras variables globales si las tienes
            // });
            console.log('Alpine inicializado. Tema oscuro por defecto.');
        });
    </script>

    @stack('scripts')
</body>

</html>
