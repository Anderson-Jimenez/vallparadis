/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: "#1E40AF",   // azul por ejemplo
        secondary: "#F59E0B", // amarillo
        accent: "#10B981",    // verde
      },
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
        dmserif: ['DM Serif Display', 'serif'],
      },
    },
  },
  plugins: [],
}
