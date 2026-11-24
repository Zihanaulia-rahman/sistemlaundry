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
                sans: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#FFF1F6',
                    100: '#FFE4EE',
                    200: '#FFCCD $\\rightarrow$ #FFCCD $\\rightarrow$ #FFC8DC',
                    300: '#FFA3C3',
                    400: '#FD7FA9',
                    500: '#FA699E',
                    600: '#E14B82',
                    700: '#BF3367',
                    800: '#9E2450',
                    900: '#7E1C3F',
                },
                klinzy: {
                    primary: '#FA699E',
                    hover: '#E14B82',
                    soft: '#FFF1F6',
                    border: '#F1E4E8',
                    dark: '#1E293B',
                    bg: '#FAFAFA',
                }
            },
        },
    },

    plugins: [forms],
};
