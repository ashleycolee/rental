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
                'plus-jakarta': ['Plus Jakarta Sans', 'sans-serif'],
                'headline': ['Plus Jakarta Sans', 'sans-serif'],
                'body': ['Inter', 'sans-serif'],
                'label': ['Inter', 'sans-serif'],
            },
            colors: {
                primary: 'rgb(70 72 212 / <alpha-value>)',
                secondary: 'rgb(129 39 207 / <alpha-value>)',
                tertiary: 'rgb(0 99 135 / <alpha-value>)',
                error: 'rgb(186 26 26 / <alpha-value>)',
                background: 'rgb(247 249 251 / <alpha-value>)',
                surface: 'rgb(247 249 251 / <alpha-value>)',
                'surface-bright': 'rgb(247 249 251 / <alpha-value>)',
                'surface-dim': 'rgb(216 218 220 / <alpha-value>)',
                'surface-container-lowest': 'rgb(255 255 255 / <alpha-value>)',
                'surface-container-low': 'rgb(242 244 246 / <alpha-value>)',
                'surface-container': 'rgb(236 238 240 / <alpha-value>)',
                'surface-container-high': 'rgb(230 232 234 / <alpha-value>)',
                'surface-container-highest': 'rgb(224 227 229 / <alpha-value>)',
                'on-surface': 'rgb(25 28 30 / <alpha-value>)',
                'on-surface-variant': 'rgb(70 69 84 / <alpha-value>)',
                'on-primary': 'rgb(255 255 255 / <alpha-value>)',
                'on-secondary': 'rgb(255 255 255 / <alpha-value>)',
                'on-tertiary': 'rgb(255 255 255 / <alpha-value>)',
                'on-error': 'rgb(255 255 255 / <alpha-value>)',
                'outline-variant': 'rgb(199 196 215 / <alpha-value>)',
                'surface-variant': 'rgb(224 227 229 / <alpha-value>)',
            },
            borderRadius: {
                'DEFAULT': '0.25rem',
                'lg': '0.5rem',
                'xl': '0.75rem',
                'full': '9999px',
            },
        },
    },

    plugins: [forms],
};
