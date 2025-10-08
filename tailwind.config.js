/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#1e40af', // Un blau personalitzat
                secondary: '#f59e0b', // Un taronja
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            backgroundImage:{
                'orange-gradient': 'linear-gradient(45deg, rgba(255, 255, 255, 1) 0%, rgba(255, 116, 0, 1) 100%)',
            }
        },
    },
    plugins: [],
}