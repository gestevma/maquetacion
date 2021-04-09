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


  //faqs
 mix.js('resources/js/admin/faqs/app.js', 'public/js/admin/faqs').version()
    .js('resources/js/front/faqs/app.js', 'public/js/front/faqs').version()

    .sass('resources/sass/admin/desktop/faqs/app.scss', 'public/css/admin/desktop/faqs').version()
    .sass('resources/sass/admin/mobile/faqs/app.scss', 'public/css/admin/mobile/faqs').version()
    .sass('resources/sass/front/desktop/faqs/app.scss', 'public/css/front/desktop/faqs').version()
    .sass('resources/sass/front/mobile/faqs/app.scss', 'public/css/front/mobile/faqs').version();
