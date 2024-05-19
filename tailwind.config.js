/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js,php}",
    "./admin_area/**/*.{html,js,php}",
    "./customer/**/*.{html,js,php}",
    "./customer/includes/**/*.{html,js,php}",
    "./functions/**/*.{html,js,php}",
    "./includes/**/*.{html,js,php}"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

