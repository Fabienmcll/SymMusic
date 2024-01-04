/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./src/**/*.html.twig,.php",

    
  ],
  theme: {
    extend: {
      colors: {
        primary: '#111827',
      },
    },
  },
  plugins: [],
};
