const defaultTheme = require('tailwindcss/defaultTheme');
const colors       = require('tailwindcss/colors')

module.exports = {
    content:       [
        './resources/views/**/*.blade.php',
        './src/SkyServiceProvider.php',
    ],
    theme: {
        extend: {
            colors: {
                gray: colors.zinc,
                primary: colors.green,
                secondary: colors.yellow,
                danger: colors.rose,
                success: colors.green,
                warning: colors.yellow,
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
