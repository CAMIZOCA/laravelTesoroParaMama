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
                serif: ['Marcellus', ...defaultTheme.fontFamily.serif],
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
                display: ['Marcellus', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                cream: {
                    50: '#fcfcfd',
                    100: '#f6f7fa',
                    200: '#ebeef4',
                    300: '#d9dfeb',
                },
                gold: {
                    50: '#fff5f8',
                    100: '#fdeaf0',
                    200: '#f8d3df',
                    300: '#efb8cb',
                    400: '#e39ab3',
                    500: '#cf7897',
                    600: '#b45f7f',
                    800: '#7b4159',
                },
                olive: {
                    500: '#5f6678',
                    600: '#4b5265',
                    700: '#383f52',
                    800: '#272d3e',
                    900: '#171d2d',
                },
                taupe: {
                    50: '#fbfbfd',
                    100: '#f4f6f9',
                    200: '#e7ebf1',
                    300: '#d2d9e4',
                    400: '#9ba5b6',
                    500: '#707c8f',
                    600: '#596275',
                    700: '#424b5e',
                    800: '#2d3547',
                    900: '#1c2334',
                },
                blush: {
                    50: '#fff6f8',
                    100: '#ffe9ef',
                    200: '#f8ceda',
                    300: '#edabc0',
                    400: '#de88a7',
                    500: '#c76789',
                },
                champagne: {
                    100: '#fff4f8',
                    200: '#ffdfe9',
                    300: '#f7c4d5',
                    400: '#ea9fb8',
                    500: '#d87c9b',
                },
            },
            animation: {
                'fade-in': 'fadeIn 0.6s ease-out',
                'slide-up': 'slideUp 0.7s ease-out',
                float: 'float 6s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-8px)' },
                },
            },
        },
    },

    plugins: [forms],
};
