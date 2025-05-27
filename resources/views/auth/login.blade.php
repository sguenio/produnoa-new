{{-- resources/views/auth/login.blade.php (o la ruta donde tengas tu login) --}}
@extends('layouts.guest')

@section('title', 'Iniciar Sesión')

@section('content')
    {{-- El contenido que antes estaba directamente dentro de <body> ahora va aquí --}}

    <div class="hidden md:flex w-1/2 relative bg-cover bg-center flex-col justify-between p-10"
        style="background-image: url('{{ asset('img/login.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-20">
            {{-- El estilo de la fuente para el logo aquí puede ser redundante si ya se aplica al body, --}}
            {{-- pero lo mantenemos por si quieres un control más específico o es diferente. --}}
            <a href="{{ url('/') }}" class="text-white font-bold text-4xl tracking-wide"
                style="font-family: 'Nunito Sans', sans-serif; transform: scaleY(1.0);">
                Produn<span class="text-red-600 font-bold">o</span>a
            </a>
        </div>

        <div class="relative z-20 text-xl font-semibold text-gray-300">
            <p>Unidad de registro documental de laboratorio central</p>
            <p>División ingrediente</p>
        </div>
    </div>

    {{-- Añadido py-8 y overflow-y-auto para mejor manejo en pantallas pequeñas si el contenido crece --}}
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-10 py-8 overflow-y-auto">
        <h1 class="text-5xl font-bold mb-6 text-white" {{-- text-white añadido por si acaso --}}
            style="font-family: 'Nunito Sans', sans-serif; transform: scaleY(1.0);">
            Produn<span class="text-red-600 font-bold">o</span>a
        </h1>

        <h2 class="text-2xl font-semibold mb-1 text-gray-100">Inicia sesión con tu cuenta</h2>
        <p class="text-gray-400 mb-6 text-sm">Ingresa tu mail y contraseña para iniciar sesión.</p>

        <form action="{{ route('autenticar') }}" method="POST" class="w-full max-w-sm">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" name="email" placeholder="email@ejemplo.com"
                    class="w-full p-3 border border-gray-700 bg-gray-800 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-600 focus:border-red-600 text-white"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña"
                    class="w-full p-3 border border-gray-700 bg-gray-800 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-600 focus:border-red-600 text-white"
                    required>
                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-6 flex items-center">
                <input type="checkbox" id="remember_me_login" name="remember"
                    class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-red-600 focus:ring-red-500 focus:ring-offset-gray-900 mr-2">
                <label for="remember_me_login" class="text-gray-400 text-sm">Recordarme</label>
            </div>

            <button type="submit"
                class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 transition duration-150 ease-in-out">
                Iniciar sesión
            </button>

            <p class="mt-6 text-gray-400 text-sm text-center">
                ¿No tienes una cuenta? <a href="#" {{-- Considera cambiar # por {{ route('register') }} si tienes una ruta de registro --}}
                    class="text-red-500 font-semibold underline hover:text-red-400">Regístrate
                    aquí</a>
            </p>
        </form>
    </div>
@endsection
