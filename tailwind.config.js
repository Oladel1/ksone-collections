/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                gold: {
                    50: '#fdf9ef',
                    100: '#faf0d4',
                    200: '#f4dfa8',
                    300: '#edc972',
                    400: '#e5ad3e',
                    500: '#d4952b',
                    600: '#c07521',
                    700: '#9f571e',
                    800: '#82461f',
                    900: '#6b3a1d',
                },
                charcoal: {
                    50: '#f6f6f6',
                    100: '#e7e7e7',
                    200: '#d1d1d1',
                    300: '#b0b0b0',
                    400: '#888888',
                    500: '#6d6d6d',
                    600: '#5d5d5d',
                    700: '#4f4f4f',
                    800: '#454545',
                    900: '#1a1a1a',
                    950: '#0d0d0d',
                },
            },
            fontFamily: {
                serif: ['Playfair Display', 'Georgia', 'serif'],
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
