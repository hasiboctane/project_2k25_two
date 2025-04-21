import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/assets/css/adminlte.min.css', 'resources/js/app.js', 'resources/assets/js/adminlte.min.js'],
            refresh: true,
        }),
    ],
});
