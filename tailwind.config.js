/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.jsx", // <-- Baris krusial biar class Tailwind di Home.jsx lo langsung dibaca instan!
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
