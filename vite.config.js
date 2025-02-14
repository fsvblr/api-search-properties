import { defineConfig } from 'vite'
import vue from "@vitejs/plugin-vue"
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/css/properties.css',
                'resources/js/properties.js'
            ],
            refresh: true,
        }),
    ],
});
