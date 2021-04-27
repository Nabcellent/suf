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

/*mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();*/

mix.styles([
    'public/css/app.css',
    'public/css/responsive.css',
    'public/css/about.css',
    'public/css/invoice.css'
], 'public/css/all.css')
    .js([
        'public/js/main.js',
        'public/js/Global.js',
        'public/js/swiper.js',
        'public/js/fetch.js',
        'public/js/JqueryValidation.js',
        'public/js/sweetAlert.js',
        'public/js/search.js',
        'public/js/jquery.nice-number.js'
    ], 'public/js/all.js')

