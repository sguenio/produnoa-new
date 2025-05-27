// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    // Añade esta sección 'server'
    server: { // o puedes poner '0.0.0.0'
        // Opcional: si tienes problemas con Hot Module Replacement (HMR) en la red
        // hmr: {
        //     host: 'tu.ip.de.red.local', // ej: '192.168.1.105'
        // }
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
