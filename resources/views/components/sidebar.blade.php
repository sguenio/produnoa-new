<aside x-show="sidebarOpen" @click.outside="if (window.innerWidth < 768 && sidebarOpen) sidebarOpen = false"
    x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
    class="bg-gray-800 text-slate-200 border-r border-gray-700 h-screen w-64 flex flex-col fixed left-0 top-0 shadow-lg z-50"
    x-cloak>

    {{-- Encabezado del Sidebar --}}
    <div class="flex items-center justify-between h-16 px-5 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <h1 class="text-2xl font-semibold text-slate-100"
                style="font-family: 'Nunito Sans', sans-serif; transform: scaleY(1.0);">
                Produn<span class="text-red-500 font-bold">o</span>a
            </h1>
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-red-500 focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Menú de Navegación --}}
    <nav class="flex-grow px-2 pt-2 pb-4 overflow-y-auto space-y-4">

        {{-- Sección General --}}
        <div>
            <p class="px-2 pt-2 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">General</p>
            <a href="{{ route('dashboard') }}"
                class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150
                      {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">

                <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="9" x="3" y="3" rx="1" />
                    <rect width="7" height="5" x="14" y="3" rx="1" />
                    <rect width="7" height="9" x="14" y="12" rx="1" />
                    <rect width="7" height="5" x="3" y="16" rx="1" />
                </svg>
                Dashboard
            </a>
        </div>

        <div>
            <p class="px-2 pt-2 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Recepción y Calidad
            </p>
            <a href="{{ route('remitos.index') }}"
                class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150
                      {{ request()->routeIs('remitos.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('remitos.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                    <path d="M12 11h4" />
                    <path d="M12 16h4" />
                    <path d="M8 11h.01" />
                    <path d="M8 16h.01" />
                </svg>
                Remitos
            </a>
        </div>

        {{-- Sección de Datos Maestros (Visible para ambos roles) --}}
        <div>
            <p class="px-2 pt-2 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Datos Maestros</p>
            {{-- ENLACE A CATEGORÍAS CORREGIDO --}}
            <a href="{{ route('categorias.index') }}"
                class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150
                      {{ request()->routeIs('categorias.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('categorias.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="7" x="3" y="3" rx="1" />
                    <rect width="7" height="7" x="3" y="14" rx="1" />
                    <path d="M14 4h7" />
                    <path d="M14 9h7" />
                    <path d="M14 15h7" />
                    <path d="M14 20h7" />
                </svg>
                Categorías
            </a>
            <a href="{{ route('productos.index') }}"
                class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150
                      {{ request()->routeIs('productos.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('productos.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                    <path d="m3.3 7 8.7 5 8.7-5" />
                    <path d="M12 22V12" />
                </svg>
                Productos
            </a>
        </div>


        {{-- Sección de Administración (Solo para Admins) --}}
        @if (Auth::check() && Auth::user()->rol === 'Administrador')
            <div>
                <p class="px-2 pt-2 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Administración
                </p>
                <a href="{{ route('usuarios.index') }}"
                    class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150 
                          {{ request()->routeIs('usuarios.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                    <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('usuarios.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <circle cx="9" cy="7" r="4" />
                    </svg>
                    Usuarios
                </a>
                <a href="{{ route('proveedores.index') }}"
                    class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150
                          {{ request()->routeIs('proveedores.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                    <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('proveedores.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                        <path d="M15 18H9" />
                        <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                        <circle cx="17" cy="18" r="2" />
                        <circle cx="7" cy="18" r="2" />
                    </svg>
                    Proveedores
                </a>
                <a href="{{ route('unidades.index') }}"
                    class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150 
                          {{ request()->routeIs('unidades.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                    <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('unidades.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z" />
                        <path d="m14.5 12.5 2-2" />
                        <path d="m11.5 9.5 2-2" />
                        <path d="m8.5 6.5 2-2" />
                        <path d="m17.5 15.5 2-2" />
                    </svg>
                    Unidades de Medida
                </a>
                <a href="{{ route('parametros.index') }}"
                    class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150
                      {{ request()->routeIs('parametros.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
                    <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('parametros.*') ? 'text-red-400' : 'text-slate-500 group-hover:text-red-400' }}"
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M14 2v6a2 2 0 0 0 .245.96l5.51 10.08A2 2 0 0 1 18 22H6a2 2 0 0 1-1.755-2.96l5.51-10.08A2 2 0 0 0 10 8V2" />
                        <path d="M6.453 15h11.094" />
                        <path d="M8.5 2h7" />
                    </svg>
                    Parámetros de Análisis
                </a>
            </div>
        @endif
    </nav>
</aside>
