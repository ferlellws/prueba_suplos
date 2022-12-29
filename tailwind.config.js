/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    "./src/**/*.{html,js,php}",
    "./public/**/*.{html,js,php}",
    "./node_modules/flowbite/**/*.js"
  ],
  darkMode: 'class',
  theme: {
    extend: {},
    colors: {
      gray: colors.gray,
      'indigo': {
        light: '#3F51B5',
        'light-600': '#303F9F',
        'light-hover': '#3949AB',
        'light-hover-600': '#283593'
      },
      red: colors.rose,
      pink: colors.fuchsia,
      green: colors.green
    }
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
