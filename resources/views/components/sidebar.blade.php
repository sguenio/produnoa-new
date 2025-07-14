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
            <span class="sr-only">Cerrar menú</span>
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
                class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
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

        {{-- Sección de Administración (Solo para Admins) --}}
        @if (Auth::check() && Auth::user()->rol === 'Administrador')
            <div>
                <p class="px-2 pt-2 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Administración
                </p>
                <a href="{{ route('usuarios.index') }}"
                    class="group flex items-center py-2 px-2 text-sm font-medium rounded-md transition-colors duration-150 {{ request()->routeIs('usuarios.*') ? 'bg-gray-700 text-red-500' : 'text-slate-300 hover:bg-gray-700 hover:text-red-500' }}">
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
                {{-- Aquí añadiremos los enlaces a Proveedores, etc. --}}
            </div>
        @endif

        {{-- Aquí añadiremos los enlaces para Operarios (y Admins), como Categorías, etc. --}}

    </nav>
</aside>
