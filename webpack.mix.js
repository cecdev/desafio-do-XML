const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');

mix.sass('resources/sass/app.scss', '../resources/css/');
mix.sass('resources/sass/screen-login.scss', '../resources/css/');


mix.styles([
    'resources/css/app.css',
    'resources/css/screen-login.css'
], 'public/css/all.css');
