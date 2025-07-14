@props([
    'user' => Auth::user(),
])

<header x-data="{ profileDropdownOpen: false, notificationsOpen: false }"
    class="bg-gray-800 text-slate-200 border-b border-gray-700 h-16 flex items-center justify-between px-4 fixed top-0 right-0 z-40 transition-all duration-300"
    :class="sidebarOpen ? 'left-0 md:left-64' : 'left-0'">

    {{-- Lado Izquierdo: Hamburguesa y Breadcrumbs --}}
    <div class="flex items-center">
        {{-- Botón Hamburguesa --}}
        <button @click="sidebarOpen = !sidebarOpen"
            class="md:hidden mr-3 text-slate-400 hover:text-red-500 focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        {{-- Breadcrumbs --}}
        <nav class="text-sm hidden md:block" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                @yield('breadcrumbs', '<li><span class="font-medium text-slate-200">Dashboard</span></li>')
            </ol>
        </nav>
    </div>

    {{-- Lado Derecho: Notificaciones y Perfil --}}
    <div class="flex items-center space-x-2 md:space-x-4">
        {{-- Sección de Notificaciones --}}
        <div class="relative">
            <button @click="notificationsOpen = !notificationsOpen"
                class="relative text-slate-400 hover:text-red-500 p-2 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors duration-150">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <div x-show="notificationsOpen" @click.outside="notificationsOpen = false" x-transition
                class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-gray-700 ring-1 ring-black ring-opacity-5 z-50"
                style="display: none;" x-cloak>
                <div class="px-4 py-3 border-b border-gray-600">
                    <h3 class="text-sm font-medium text-slate-100">Notificaciones</h3>
                </div>
                <div class="py-1">
                    <div class="px-4 py-6 text-center"><svg class="mx-auto h-10 w-10 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        <p class="mt-3 text-sm text-slate-400">No tienes notificaciones nuevas.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección de Perfil --}}
        @if ($user)
            <div class="relative">
                <button @click="profileDropdownOpen = !profileDropdownOpen"
                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-red-600">
                    {{-- Avatar/Inicial (siempre visible) --}}
                    <span
                        class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-700 text-gray-300">
                        <span
                            class="text-sm font-medium leading-none">{{ strtoupper(substr($user->nombre, 0, 1)) }}</span>
                    </span>

                    {{-- Nombre (se oculta en pantallas pequeñas) --}}
                    <span
                        class="hidden md:inline-block ml-2 text-slate-300 hover:text-red-500">{{ explode(' ', $user->nombre)[0] }}</span>

                    {{-- Flecha (se oculta en pantallas pequeñas) --}}
                    <svg class="hidden md:inline-block ml-1 h-5 w-5 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Dropdown de Perfil --}}
                <div x-show="profileDropdownOpen" @click.outside="profileDropdownOpen = false" x-transition
                    class="origin-top-right absolute right-0 mt-2 w-60 rounded-md shadow-lg py-1 bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                    style="display: none;" x-cloak>
                    <div class="px-4 py-3 border-b border-gray-600">
                        <div class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-600 text-gray-300 mr-3">
                                <span
                                    class="text-md font-medium leading-none">{{ strtoupper(substr($user->nombre, 0, 1)) }}</span>
                            </span>
                            <div class="truncate">
                                <p class="text-sm font-medium text-slate-100 truncate">{{ $user->nombre }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-1">
                        <a href="#"
                            class="group flex items-center px-4 py-2 text-sm text-slate-200 hover:bg-gray-600 hover:text-red-500">
                            <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-red-400"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Perfil
                        </a>
                        <a href="#"
                            class="group flex items-center px-4 py-2 text-sm text-slate-200 hover:bg-gray-600 hover:text-red-500">
                            <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-red-400"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Configuración
                        </a>
                    </div>
                    <div class="py-1 border-t border-gray-600">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left group flex items-center px-4 py-2 text-sm text-slate-200 hover:bg-gray-600 hover:text-red-500">
                                <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-red-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="space-x-2"><a href="{{ route('login') }}" class="text-slate-300 hover:text-red-500">Iniciar
                    Sesión</a></div>
        @endif
    </div>
</header>
