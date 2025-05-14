<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body class="flex h-screen bg-gray-900 text-white">
    <!-- Sección izquierda con imagen y capa oscura -->
    <div class="hidden md:flex w-1/2 relative bg-cover bg-center flex flex-col justify-between p-10"
        style="background-image: url('{{ asset('img/login.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-20">
            <a href="#" class="text-white font-bold text-4xl tracking-wide"
                style="font-family: 'Nunito Sans', sans-serif; transform: scaleY(1.0);">
                Produn<span class="text-red-600 font-bold">o</span>a
            </a>
        </div>

        <!-- Texto añadido en la parte inferior izquierda -->
        <div class="relative z-20 text-xl font-semibold text-gray-300">
            <p>Unidad de registro documental de laboratorio central</p>
            <p>División ingrediente</p>
        </div>

    </div>

    <!-- Sección derecha con formulario -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-10">
        <!-- Logo Produnoa -->
        <h1 class="text-5xl font-bold mb-6" style="font-family: 'Nunito Sans', sans-serif; transform: scaleY(1.0);">
            Produn<span class="text-red-600 font-bold">o</span>a
        </h1>

        <!-- Encabezado -->
        <h2 class="text-2xl font-semibold mb-1">Inicia sesión con tu cuenta</h2>
        <p class="text-gray-400 mb-6 text-sm">Ingresa tu mail y contraseña para iniciar sesión.</p>

        <form action="{{ route('autenticar') }}" method="POST" class="w-full max-w-sm">
            @csrf

            <!-- Campo de correo electrónico -->
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" name="email" placeholder="email@ejemplo.com"
                    class="w-full p-3 border border-gray-700 bg-gray-800 rounded-lg focus:outline-none focus:ring focus:ring-red-600"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo de contraseña -->
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña"
                    class="w-full p-3 border border-gray-700 bg-gray-800 rounded-lg focus:outline-none focus:ring focus:ring-red-600"
                    required>
                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-6 flex items-center">
                <input type="checkbox" class="mr-2 bg-gray-700 border-none text-red-600">
                <label class="text-gray-400 text-sm">Recordarme</label>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 transition">
                Iniciar sesión
            </button>

            <p class="mt-6 text-gray-400 text-sm text-center">
                ¿No tienes una cuenta? <a href="#"
                    class="text-red-500 font-semibold underline hover:text-red-400">Regístrate
                    aquí</a>
            </p>
        </form>
    </div>
</body>

</html>
