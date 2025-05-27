// tailwind.config.js (en la raíz de tu proyecto)
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class", // Esencial
    content: [
        "./resources/views/**/*.blade.php", // Escanea todas las vistas Blade
        "./resources/js/**/*.js", // Escanea tus archivos JS
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php", // Para la paginación de Laravel
        // Añade aquí otras rutas si tienes clases de Tailwind en otros lugares
    ],
    theme: {
        extend: {
            // Aquí puedes volver a añadir tus colores personalizados 'slate', 'red', etc.
            // que definimos para el tema claro/oscuro si los necesitas explícitamente.
            // Por ejemplo:
            // colors: {
            //   slate: {
            //     50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1',
            //     400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155',
            //     800: '#1e293b', 900: '#0f172a',
            //   },
            //   // etc. para 'red' y 'gray'
            // }
        },
    },
    plugins: [],
};
