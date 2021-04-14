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


  //admin
 mix.js('resources/js/admin/app.js', 'public/js/admin').version()
    .sass('resources/sass/admin/desktop/app.scss', 'public/css/admin/desktop').version()


    //front
   mix.js('resources/js/front/faqs/app.js', 'public/js/front/faqs').version()
      .js('resources/js/front/login/app.js', 'public/js/front/login').version()
   

      .sass('resources/sass/front/desktop/faqs/app.scss', 'public/css/front/desktop/faqs').version()
      .sass('resources/sass/front/mobile/faqs/app.scss',  'public/css/front/mobile/faqs').version()
      .sass('resources/sass/front/desktop/login/app.scss','public/css/front/desktop/login').version()
      .sass('resources/sass/front/mobile/login/app.scss', 'public/css/front/mobile/login').version();
   
