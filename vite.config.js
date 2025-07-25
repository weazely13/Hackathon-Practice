import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fullReload from 'vite-plugin-full-reload';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/dashboard.css',
                'resources/css/feedbacks.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        fullReload([
            'resources/views/**/*.blade.php',
            'app/Http/Controllers/**/*.php',
            'routes/**/*.php',
        ]),
        tailwindcss(),
    ],
});
