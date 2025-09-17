import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                // CSS
                'resources/css/app.css',
                'resources/css/filament/admin/theme.css',

                // JS
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
