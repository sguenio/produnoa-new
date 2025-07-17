<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación Produnoa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-900 text-slate-300 min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 768 }"
    @resize.window="if (!isMobile()) sidebarOpen = true">
    <div x-show="sidebarOpen && isMobile()" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40" x-cloak></div>
    <x-sidebar />
    <x-header />
    <main class="transition-all duration-300 ease-in-out px-6 pt-20 pb-8"
        :class="{ 'md:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded-lg relative mb-4"
                role="alert">
                <strong class="font-bold">¡Éxito!</strong><span class="block sm:inline"> {{ session('success') }}</span>
                <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3"><svg
                        class="fill-current h-6 w-6 text-green-400" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Cerrar</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg></button>
            </div>
        @endif
        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg relative mb-4"
                role="alert">
                <strong class="font-bold">¡Error!</strong><span class="block sm:inline"> {{ session('error') }}</span>
                <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3"><svg
                        class="fill-current h-6 w-6 text-red-400" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Cerrar</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg></button>
            </div>
        @endif
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
