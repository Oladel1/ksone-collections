import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#fdfaf0',
                    100: '#faf3dc',
                    200: '#f5e5b8',
                    300: '#efd28a',
                    400: '#e5b94e',
                    500: '#B8860B',
                    600: '#a07509',
                    700: '#7d5c08',
                    800: '#5e4508',
                    900: '#3d2d06',
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
