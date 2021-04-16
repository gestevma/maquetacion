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


 mix.js('resources/js/admin/desktop/app.js', 'public/js/admin/desktop').version()
 .js('resources/js/admin/mobile/app.js', 'public/js/admin/mobile').version()
 .js('resources/js/front/desktop/app.js', 'public/js/front/desktop').version()
 .js('resources/js/front/mobile/app.js', 'public/js/front/mobile').version()
 .sass('resources/sass/admin/desktop/app.scss', 'public/css/admin/desktop').version()
 .sass('resources/sass/admin/mobile/app.scss', 'public/css/admin/mobile').version()
 .sass('resources/sass/front/desktop/app.scss', 'public/css/front/desktop').version()
 .sass('resources/sass/front/mobile/app.scss', 'public/css/front/mobile').version();
   
