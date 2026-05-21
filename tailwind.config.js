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
                // Admin UI palette — hardcoded, independent of public theme
                olive: {
                    50:  '#f5f6f0',
                    100: '#e8ead8',
                    200: '#cfd3b2',
                    300: '#b0b786',
                    400: '#8f9a5d',
                    500: '#717c42',
                    600: '#576031',
                    700: '#434c27',
                    800: '#363d20',
                    900: '#2d321b',
                    950: '#161910',
                },
                cream: {
                    50:  '#fefef9',
                    100: '#fdf8ec',
                    200: '#f9edca',
                    300: '#f3db97',
                    400: '#ebbd56',
                    500: '#e0a020',
                    600: '#c07d14',
                    700: '#9a5f12',
                    800: '#7d4b14',
                    900: '#663c14',
                    950: '#3a1f08',
                },
                gold: {
                    300: '#f0d278',
                    400: '#e8bc4a',
                    500: '#d4a020',
                    600: '#b08018',
                },
                // All theme colors are dynamic and come from CSS custom properties
                // defined at runtime by ThemeSetting (public.blade.php)
                'tc-primary':    'var(--color-primary)',
                'tc-secondary':  'var(--color-secondary)',
                'tc-accent':     'var(--color-accent)',
                'tc-bg':         'var(--color-bg-main)',
                'tc-section':    'var(--color-bg-section)',
                'tc-btn':              'var(--color-btn)',
                'tc-btn-hover':        'var(--color-btn-hover)',
                'tc-btn-text':         'var(--color-btn-text)',
                'tc-btn-inv':          'var(--color-btn-inverse)',
                'tc-btn-inv-hover':    'var(--color-btn-inverse-hover)',
                'tc-btn-inv-text':     'var(--color-btn-inverse-text)',
                'tc-title':      'var(--color-title)',
                'tc-text':       'var(--color-text)',
                'tc-link':       'var(--color-link)',
                'tc-link-hover': 'var(--color-link-hover)',
                'tc-card':       'var(--color-card)',
                'tc-border':     'var(--color-border)',
                'tc-badge':      'var(--color-badge)',
                'tc-footer':     'var(--color-footer)',
                'tc-header':     'var(--color-header)',
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
