const mix = require('laravel-mix');

mix
    .setPublicPath('public/build')
    .setResourceRoot('/build/')
    .js('resources/js/app.js', 'js')
    .postCss('resources/css/app.css', 'css', [
        require("tailwindcss"),
    ])
    .version();
