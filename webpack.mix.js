const mix = require('laravel-mix');

mix
    .setPublicPath('public/build')
    .setResourceRoot('/build/')
    .js('resources/js/app.js', 'js')
    .postCss('resources/css/app.css', 'css', [
        require("tailwindcss"),
    ])
    .less('resources/css/rich-editor/default.less', 'css/rich-editor')
    .less('resources/css/rich-editor/defaultdark.less', 'css/rich-editor')
    .version();
