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
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                display: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // champagne → primary RED accent
                champagne: {
                    100: '#FEE2E2',
                    200: '#FECACA',
                    300: '#FCA5A5',
                    400: '#EF4444',
                    500: '#DC2626',
                    600: '#B91C1C',
                },
                // cream → clean white / light gray
                cream: {
                    50:  '#FFFFFF',
                    100: '#F9FAFB',
                    200: '#F3F4F6',
                    300: '#E5E7EB',
                },
                // taupe → near-black text palette
                taupe: {
                    50:  '#F9FAFB',
                    100: '#F3F4F6',
                    200: '#E5E7EB',
                    300: '#D1D5DB',
                    400: '#9CA3AF',
                    500: '#6B7280',
                    600: '#4B5563',
                    700: '#374151',
                    800: '#1F2937',
                    900: '#111827',
                },
                // olive → very dark (admin sidebar, dark CTA sections)
                olive: {
                    500: '#1F2937',
                    600: '#111827',
                    700: '#0D1117',
                    800: '#09090B',
                    900: '#050507',
                },
                // blush → light red tints (decorative backgrounds)
                blush: {
                    50:  '#FFF7F7',
                    100: '#FEE2E2',
                    200: '#FECACA',
                    300: '#FCA5A5',
                    400: '#F87171',
                    500: '#EF4444',
                },
                // gold → amber for admin badges
                gold: {
                    50:  '#FFFBF5',
                    100: '#FFF8ED',
                    200: '#FFEFD5',
                    300: '#FFD89B',
                    400: '#F59E0B',
                    500: '#D97706',
                    600: '#B45309',
                    800: '#78350F',
                },
            },
            animation: {
                'fade-in': 'fadeIn 0.6s ease-out',
                'slide-up': 'slideUp 0.7s ease-out',
                float: 'float 6s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%':   { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-8px)' },
                },
            },
        },
    },

    plugins: [forms],
};
