const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/front/css/all.min.css',
    'resources/front/css/buttons.bootstrap4.min.css',
    'resources/front/css/dataTables.bootstrap4.min.css',
    'resources/front/css/responsive.bootstrap4.min.css',
], 'public/assets/admin/css/button.css');

mix.scripts([
    'resources/front/js/buttons.bootstrap4.min.js',
    'resources/front/js/buttons.colVis.min.js',
    'resources/front/js/buttons.html5.min.js',
    'resources/front/js/buttons.print.min.js',
    'resources/front/js/dataTables.bootstrap4.min.js',
    'resources/front/js/dataTables.buttons.min.js',
    'resources/front/js/dataTables.responsive.min.js',
    'resources/front/js/jquery.dataTables.min.js',
    'resources/front/js/jszip.min.js',
    'resources/front/js/pdfmake.min.js',
    'resources/front/js/responsive.bootstrap4.min.js',
    'resources/front/js/vfs_fonts.min.js',
    'resources/front/js/jquery.min.js',
    'resources/front/js/bootstrap.bundle.min.js',
    'resources/front/js/adminlte.min.js',
    'resources/front/js/demo.min.js',
], 'public/assets/admin/js/button.js');