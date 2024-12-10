import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Fotos
                'resources/imgs/favicon.ico',

                // CSS
                'resources/css/dialogs/error.css',
                'resources/css/dialogs/success.css',

                'resources/css/login/index.css',
                'resources/css/login/main/index.css',
                'resources/css/login/roses/index.css',

                'resources/css/register/index.css',
                'resources/css/register/main/index.css',
                'resources/css/register/starts/index.css',
                'resources/css/register/starts/index.css',

                'resources/css/main/index.css',
                'resources/css/main/header/dialogs.css',
                'resources/css/main/header/index.css',
                'resources/css/main/content/index.css',
                'resources/css/main/foot/index.css',

                'resources/css/errors/index.css',
                'resources/css/errors/main/index.css',

                'resources/css/shop/index.css',
                'resources/css/shop/main/index.css',
                'resources/css/shop/dialog/index.css',

                'resources/css/profile/index.css',
                'resources/css/profile/main/index.css',

                'resources/css/logout/index.css',
                'resources/css/logout/main/index.css',

                'resources/css/products/index.css',
                'resources/css/products/main/index.css',

                'resources/css/forums/index.css',
                'resources/css/forums/main/index.css',
                'resources/css/forums/main/like.css',

                'resources/css/calendar/index.css',
                'resources/css/calendar/main/index.css',
                'resources/css/calendar/main/full.css',

                'resources/css/adminUsers/index.css',
                'resources/css/adminUsers/main/index.css',
                'resources/css/adminUsers/dialogs/index.css',

                'resources/css/settings/index.css',
                'resources/css/settings/cycle/index.css',
                'resources/css/settings/cycle/checkbox.css',

                'resources/css/products/index.css',
                'resources/css/products/main/index.css',

                'resources/css/forums/index.css',
                'resources/css/forums/main/index.css',
                'resources/css/forums/main/like.css',
                'resources/css/privacy/index.css',
                'resources/css/privacy/main/index.css',

                // JS
                'resources/js/passView.js',

                'resources/js/login/rosesAnimation.js',
                'resources/js/login/remember.js',

                'resources/js/register/passSecurity.js',
                'resources/js/register/checkInputs.js',

                'resources/js/main/carruselStuff.js',
                'resources/js/main/carousel.js',
                'resources/js/main/buttons.js',

                'resources/js/shop/buttons.js',
                'resources/js/shop/filters.js',
                'resources/js/shop/adminStuff.js',

                'resources/js/errors/randomStuff.js',

                'resources/js/profile/btns.js',
                'resources/js/profile/cycleBtns.js',
                'resources/js/profile/database.js',

                'resources/js/shop/adminStuff.js',
                'resources/js/products/filters.js',

                'resources/js/calendar/initCalendar.js',
                'resources/js/calendar/fullCalendar.js',

                'resources/js/adminUsers/popups.js',
                'resources/js/adminUsers/filterInput.js',

                'resources/js/settings/cycle/updateDB.js',

                'resources/js/products/filters.js',
                'resources/js/products/dbEvents.js',

                'resources/js/forums/updateLikes.js',
                'resources/js/forums/orderBy.js',
                'resources/js/privacy/index.js',
            ],
            refresh: true,
        }),
    ],
});
