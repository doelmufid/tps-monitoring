import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'jungle-green': {
                    50:  '#effaf5',
                    100: '#d9f2e6',
                    200: '#b5e5d0',
                    300: '#85d0b4',
                    400: '#52b594',
                    500: '#34a885',
                    600: '#207b62',
                    700: '#1a6250',
                    800: '#174e41',
                    900: '#134136',
                    950: '#0a241f',
                },
            },
        },
    },

    plugins: [forms],
};
