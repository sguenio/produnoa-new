<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-900 text-white">
    <h1 class="text-4xl font-bold">Bienvenido al Dashboard</h1>
    <p class="text-gray-400 mt-4">Esta es tu vista privada después de iniciar sesión.</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="mt-6 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Cerrar sesión</button>
    </form>
</body>
</html>