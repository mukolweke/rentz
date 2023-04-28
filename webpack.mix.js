const mix = require('laravel-mix');
let path = require('path');

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


mix.version()
    .js('resources/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/src'),
                '@assets': path.resolve(__dirname, 'resources/assets')
            }
        }
    })
    .css('resources/css/app.css', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images')
    .vue({
        version: 3
    });
