import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/images/**/*',
            ],
            refresh: true,
        }),
    ],

    // server: {
    //     host: '192.168.1.128',
    //     port: 3000,
    //   },
});
