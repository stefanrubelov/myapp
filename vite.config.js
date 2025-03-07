import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import livewire from '@defstudio/vite-livewire-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: false,
        }),
        livewire({
            refresh: ['resources/scss/app.scss'],
        }),
    ],
    css: {
        postcss: {
            plugins: [tailwindcss()],
        },
    }
});
