const defaultTheme = require('tailwindcss/defaultTheme');
const colors       = require('tailwindcss/colors')

module.exports = {
    content:       [
        './resources/views/**/*.blade.php',
    ],
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
};