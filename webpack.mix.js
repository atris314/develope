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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');




mix.styles([
        'resources/front/assets/vendor/bootstrap/css/bootstrap.rtl.css',
        'resources/front/assets/vendor/bootstrap/css/bootstrap.rtl.min.css',
        'resources/front/assets/vendor/bootstrap/css/bootstrap.min.css',
        // 'resources/front/assets/vendor/icofont/icofont.min.css',
        // 'resources/front/assets/vendor/boxicons/css/boxicons.min.css',
        'resources/front/assets/vendor/venobox/venobox.css',
        'resources/front/assets/vendor/owl.carousel/assets/owl.carousel.min.css',
        'resources/front/assets/vendor/aos/aos.css',
        'resources/front/assets/css/style.css',
        // 'resources/front/assets/css/dropzone.min.css',
    ],
    'public/front/css/app.css');

mix.scripts([
        'resources/front/assets/vendor/jquery/jquery.min.js',
        'resources/front/assets/vendor/isotope-layout/isotope.pkgd.min.js',
        'resources/front/assets/vendor/venobox/venobox.min.js',
        'resources/front/assets/vendor/owl.carousel/owl.carousel.min.js',
        'resources/front/assets/vendor/aos/aos.js',
        'resources/front/assets/js/main.js',
        'resources/front/assets/js/typed.js',

    ],
    'public/front/js/app.js');



