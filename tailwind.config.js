/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',

  ],
  theme: {
    screens: {
        xs: '320px',
        sm: '480px',
        md: '768px',
        lg: '976px',
        xl: '1440px',
      },
    extend: {},
  },
  plugins: [],
}

