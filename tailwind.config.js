const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('daisyui')],
    daisyui: {
        themes: [{
            claro: {
                "primary": "#3376d0",
                "secondary": "#7390d5",
                "accent": "#eda1df",
                "neutral": "#181F2B",
                "base-100": "#48474D",
                "info": "#40A1CE",
                "success": "#28C89D",
                "warning": "#EBBA0A",
                "error": "#F4677C",
            },
        }, 'night'],
    },
};
