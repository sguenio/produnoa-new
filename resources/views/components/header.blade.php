@props(['user' => Auth::user()])
<header x-data="{ profileDropdownOpen: false, notificationsOpen: false }"
    class="bg-gray-800 text-slate-200 border-b border-gray-700 h-16 flex items-center justify-between px-4 fixed top-0 right-0 z-30 transition-all duration-300"
    :class="sidebarOpen ? 'left-0 md:left-64' : 'left-0'">
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen"
            class="md:hidden mr-3 text-slate-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg></button>
        <nav class="text-sm hidden md:block" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">@yield('breadcrumbs')</ol>
        </nav>
    </div>
    <div class="flex items-center space-x-2 md:space-x-4">
        
        @if ($user)
            <div class="relative">
                <button @click="profileDropdownOpen = !profileDropdownOpen"
                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-red-600">
                    <span
                        class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-700 text-gray-300"><span
                            class="text-sm font-medium leading-none">{{ strtoupper(substr($user->nombre, 0, 1)) }}</span></span>
                    <span
                        class="hidden md:inline-block ml-2 text-slate-300 hover:text-red-500">{{ explode(' ', $user->nombre)[0] }}</span>
                    <svg class="hidden md:inline-block ml-1 h-5 w-5 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="profileDropdownOpen" @click.outside="profileDropdownOpen = false" x-transition
                    class="origin-top-right absolute right-0 mt-2 w-60 rounded-md shadow-lg py-1 bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                    style="display: none;" x-cloak>
                    <div class="px-4 py-3 border-b border-gray-600">
                        <div class="flex items-center"><span
                                class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-600 text-gray-300 mr-3"><span
                                    class="text-md font-medium leading-none">{{ strtoupper(substr($user->nombre, 0, 1)) }}</span></span>
                            <div class="truncate">
                                <p class="text-sm font-medium text-slate-100 truncate">{{ $user->nombre }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="py-1 border-t border-gray-600">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left group flex items-center px-4 py-2 text-sm text-slate-200 hover:bg-gray-600 hover:text-red-500"><svg
                                    class="mr-3 h-5 w-5 text-slate-400 group-hover:text-red-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>Cerrar sesión</button>
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
