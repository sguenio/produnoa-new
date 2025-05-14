<div class="h-screen w-64 bg-gray-900 text-white flex flex-col fixed left-0 top-0 shadow-lg">

    <!-- Logo Produnoa -->
    <div class="p-5 flex items-start">
        <h1 class="mt-3 text-2xl font-semibold" style="font-family: 'Nunito Sans', sans-serif; transform: scaleY(1.0);">
            Produn<span class="text-red-600 font-bold">o</span>a
        </h1>
    </div>

    <!-- Menú de navegación -->
    <nav class="flex-grow px-4">

        <!-- General -->
        <p class="text-gray-400 text-sm font-semibold mt-4">General</p>

        <a href="{{ route('dashboard') }}"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard mr-2">
                <rect width="7" height="9" x="3" y="3" rx="1" />
                <rect width="7" height="5" x="14" y="3" rx="1" />
                <rect width="7" height="9" x="14" y="12" rx="1" />
                <rect width="7" height="5" x="3" y="16" rx="1" />
            </svg>
            Dashboard
        </a>
        <!-- Gestión de Productos -->
        <p class="text-gray-400 text-sm font-semibold mt-4">Gestión de Productos</p>
        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-box-icon lucide-box mr-2">
                <path
                    d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                <path d="m3.3 7 8.7 5 8.7-5" />
                <path d="M12 22V12" />
            </svg>

            Productos
        </a>

        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-layout-list-icon lucide-layout-list mr-2">
                <rect width="7" height="7" x="3" y="3" rx="1" />
                <rect width="7" height="7" x="3" y="14" rx="1" />
                <path d="M14 4h7" />
                <path d="M14 9h7" />
                <path d="M14 15h7" />
                <path d="M14 20h7" />
            </svg>
            Categorías
        </a>


        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-tag-icon lucide-tag mr-2">
                <path
                    d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z" />
                <circle cx="7.5" cy="7.5" r=".5" fill="currentColor" />
            </svg>
            Marcas
        </a>
        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-ruler-icon lucide-ruler mr-2">
                <path
                    d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z" />
                <path d="m14.5 12.5 2-2" />
                <path d="m11.5 9.5 2-2" />
                <path d="m8.5 6.5 2-2" />
                <path d="m17.5 15.5 2-2" />
            </svg>
            Unidades de Medida
        </a>

        <!-- Proveedores y Remitos -->
        <p class="text-gray-400 text-sm font-semibold mt-4">Proveedores y Remitos</p>
        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-truck-icon lucide-truck mr-2">
                <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                <path d="M15 18H9" />
                <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                <circle cx="17" cy="18" r="2" />
                <circle cx="7" cy="18" r="2" />
            </svg>
            Proveedores
        </a>
        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-clipboard-list-icon lucide-clipboard-list mr-2">
                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                <path d="M12 11h4" />
                <path d="M12 16h4" />
                <path d="M8 11h.01" />
                <path d="M8 16h.01" />
            </svg>
            Remitos
        </a>

        <!-- Control de Calidad -->
        <p class="text-gray-400 text-sm font-semibold mt-4">Control de Calidad</p>
        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-boxes-icon lucide-boxes mr-2">
                <path
                    d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z" />
                <path d="m7 16.5-4.74-2.85" />
                <path d="m7 16.5 5-3" />
                <path d="M7 16.5v5.17" />
                <path
                    d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z" />
                <path d="m17 16.5-5-3" />
                <path d="m17 16.5 4.74-2.85" />
                <path d="M17 16.5v5.17" />
                <path
                    d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z" />
                <path d="M12 8 7.26 5.15" />
                <path d="m12 8 4.74-2.85" />
                <path d="M12 13.5V8" />
            </svg>
            Lotes
        </a>

        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-flask-conical-icon lucide-flask-conical mr-2">
                <path
                    d="M14 2v6a2 2 0 0 0 .245.96l5.51 10.08A2 2 0 0 1 18 22H6a2 2 0 0 1-1.755-2.96l5.51-10.08A2 2 0 0 0 10 8V2" />
                <path d="M6.453 15h11.094" />
                <path d="M8.5 2h7" />
            </svg>

            Análisis
        </a>

        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-refresh-cw-icon lucide-refresh-cw mr-2">
                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                <path d="M21 3v5h-5" />
                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                <path d="M8 16H3v5" />
            </svg>
            Reanálisis
        </a>

        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-package-x-icon lucide-package-x mr-2">
                <path
                    d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                <path d="m7.5 4.27 9 5.15" />
                <polyline points="3.29 7 12 12 20.71 7" />
                <line x1="12" x2="12" y1="22" y2="12" />
                <path d="m17 13 5 5m-5 0 5-5" />
            </svg>
            Decomisos
        </a>

        <!-- Administración -->
        <p class="text-gray-400 text-sm font-semibold mt-4">Administración</p>
        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-users-icon lucide-users mr-2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <circle cx="9" cy="7" r="4" />
            </svg>
            Usuarios
        </a>

        <a href="#"
            class="mt-2 flex items-center py-1 text-base text-white hover:bg-gray-700 hover:text-red-500 rounded-md px-2">

            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-history-icon lucide-history mr-2">
                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                <path d="M3 3v5h5" />
                <path d="M12 7v5l4 2" />
            </svg>
            Historial de Cambios
        </a>
    </nav>

    <!-- Perfil del usuario -->
    <div class="p-4 flex flex-col items-center relative">
        @if (auth()->check() && auth()->user())
            <!-- Botón de perfil con hover -->
            <button id="profileDropdown"
                class="w-full flex items-center justify-between rounded-md py-2 px-3 hover:bg-gray-600 transition relative">
                <!-- Foto de perfil centrada -->
                <div class="h-10 w-10 rounded-full bg-gray-700 text-white flex items-center justify-center text-lg">
                    {{ substr(auth()->user()->Nombre, 0, 1) }}
                </div>

                <!-- Nombre y Apellido -->
                <div class="flex flex-col text-left">
                    <p class="text-sm font-semibold text-white">{{ auth()->user()->Nombre }}
                        {{ auth()->user()->Apellido }}</p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->Email }}</p>
                </div>

                <!-- Ícono del dropdown -->
                <svg id="dropdownIcon" class="w-4 h-4 transition-transform duration-200"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
                </svg>
            </button>

            <!-- Opciones del menú (Dropdown con mismo ancho que el botón de perfil) -->
            <div id="profileMenu"
                class="absolute right-0 bottom-full mb-2 w-31 bg-gray-800 rounded-md shadow-lg hidden">
                <a href="#" class="block py-2 px-3 text-sm text-white hover:bg-gray-700">Configuración</a>
                <hr class="border-gray-600">
                <a href="{{ route('logout') }}" class="block py-2 px-3 text-sm text-red-500 hover:bg-gray-700">Cerrar
                    sesión</a>
            </div>
        @else
            <p class="text-gray-400 text-sm">No hay usuario autenticado</p>
        @endif
    </div>
</div>

<script>
    document.getElementById("profileDropdown").addEventListener("click", function() {
        let menu = document.getElementById("profileMenu");
        let icon = document.getElementById("dropdownIcon");

        // Alternar visibilidad del menú
        menu.classList.toggle("hidden");

        // Rotar el ícono cuando el menú esté abierto
        icon.classList.toggle("rotate-180");
    });
</script>
