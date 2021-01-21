let mix = require('laravel-mix');
require('laravel-mix-purgecss');

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
mix.autoload({
	jquery: ['$', 'window.jQuery', 'jQuery']
});

mix.js('resources/assets/js/app.js', 'public/js')
   .extract(['jquery', 'lodash', 'bootstrap', 'bootstrap-datepicker', 'datatables', 'popper.js', 'moment', 'dropzone', 'axios', 'select2', 'onepage-scroll', 'imagesloaded', 'imagefill'])
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/backend.scss', 'public/css');