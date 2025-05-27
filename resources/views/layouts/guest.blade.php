{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="dark"> {{-- Mantenemos la clase 'dark' si tus páginas de autenticación también son oscuras por defecto --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Produnoa')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @stack('styles') {{-- Para estilos adicionales específicos de una página si los necesitas --}}
</head>

<body class="flex h-screen bg-gray-900 text-white font-['Nunito_Sans']">
    {{-- El contenido de la página de login (las dos columnas) se insertará aquí --}}
    @yield('content')

    @stack('scripts') {{-- Para scripts adicionales específicos de una página si los necesitas --}}
</body>

</html>
