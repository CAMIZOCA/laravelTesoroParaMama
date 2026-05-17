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
