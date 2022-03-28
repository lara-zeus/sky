const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'resources/assets')
   .postCss('resources/css/app.css', 'resources/assets', [
       require('postcss-import'),
       require('tailwindcss'),
   ])
;

if (mix.inProduction()) {
    mix.version();
}
