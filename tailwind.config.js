/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#1E40AF",   // azul por ejemplo
        secondary: "#F59E0B", // amarillo
        accent: "#10B981",    // verde
      },
    },
  },
  plugins: [],
}
