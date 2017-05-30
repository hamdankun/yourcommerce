const { mix } = require('laravel-mix');

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

mix.styles('resources/assets/css/font-awesome.css', 'public/css/font-awesome.css')
    .styles('resources/assets/css/bootstrap.min.css', 'public/css/bootstrap.min.css')
    .styles('resources/assets/css/animate.min.css', 'public/css/animate.min.css')
    .styles('resources/assets/css/owl.carousel.css', 'public/css/owl.carousel.css')
    .styles('resources/assets/css/owl.theme.css', 'public/css/owl.theme.css')
    .styles('resources/assets/css/style.default.css', 'public/css/style.default.css')
    .styles('resources/assets/css/custom.css', 'public/css/custom.css')
    .styles('resources/assets/css/custom.css', 'public/css/custom.css')
    .js('resources/assets/js/app.js', 'public/js/app.js')
    .js('resources/assets/js/init.js', 'public/js/init.js')
    .js('resources/assets/js/front.js', 'public/js/front.js')
    .js('resources/assets/js/frontend/home.js', 'public/js/frontend/home.js')
    .js('resources/assets/js/frontend/product/index.js', 'public/js/frontend/product/index.js')
    .js('resources/assets/js/frontend/product/show.js', 'public/js/frontend/product/show.js')
    .js('resources/assets/js/frontend/cart.js', 'public/js/frontend/cart.js')
    .js('resources/assets/js/frontend/shopping.cart.js', 'public/js/frontend/shopping.cart.js')
    .js('resources/assets/js/frontend/address.js', 'public/js/frontend/address.js')
    .js('resources/assets/js/frontend/delivery.method.js', 'public/js/frontend/delivery.method.js')
    .js('resources/assets/js/frontend/payment.method.js', 'public/js/frontend/payment.method.js')
    .js('resources/assets/js/frontend/order.preview.js', 'public/js/frontend/order.preview.js')
    .version();
