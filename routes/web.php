<?php

use App\Http\Controllers\Shop;
use App\Http\Controllers\Login;
use App\Http\Controllers\Forums;
use App\Http\Controllers\Privacy;
use App\Http\Controllers\Profile;
use App\Http\Controllers\MainPage;
use App\Http\Controllers\Payments;
use App\Http\Controllers\UserData;
use App\Http\Controllers\AdminUser;
use App\Http\Controllers\Calendars;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUser;
use App\Http\Controllers\NotificationSetting;

/* Pagina Principal */
Route::get('/', [MainPage::class, 'index'])->name('mainPage.index');


/* Pagina de Login */
Route::controller(Login::class)->group(function () {
    Route::get("/pre-login", "index")->name('login.index');
    Route::post("/login", "login")->name('login.getData');

    // Cerrar sesion
    Route::get('/logout', 'logout')->name('profilePage.logout');
});


/* Pagina de Register */
Route::controller(RegisterUser::class)->group(function () {
    Route::get("/register", "index")->name('register.index');
    Route::post("/register", "store")->name("register.getData");
});


/* Pagina de la tienda */
Route::controller(Shop::class)->group(function () {
    Route::get('/shop', 'index')->name('shop.index');
    Route::get('/shop/view/{id}', 'viewProduct')->name('shop.viewProduct');

    Route::post('/shop/itemAdded', 'additem')->name('shop.getData');
    Route::post('/shop/itemRemoved/{id}', 'removeItem')->name('shop.removeItem');
    Route::post('/shop/itemEdited/{id}', 'editItem')->name('shop.editItem');

    Route::post('/shop/addToCart/product/{id}', 'addToCart')->name('shop.addItemCart');
    Route::post('/shop/removeToCart/product/{id}', 'removeToCart')->name('shop.removeItemCart');
});

/* Paginas para administrar el pago de las tiendas */
Route::group(['controller' => Payments::class], function () {
    Route::post('/shop/startPayment/oneItem/{id}', 'buyOne')->name('shop.startPaymentOne');
    Route::post('/shop/startPayment/manyItems', 'buyMany')->name('shop.startPaymentMany');

    Route::get('/shop/createReceipt/{productId}{userId}{creatorId}', 'createReceipt')->name('shop.createReceipt');
    Route::get('/shop/createReceiptMany', 'createReceiptMany')->name('shop.createReceiptMany');

    Route::get('/shop/viewReceipt', 'viewReceipt')->name('shop.viewReceipt');
});


/* Pagina de los foros  */
Route::controller(Forums::class)->group(function () {
    Route::get("/forums", 'index')->name('forum.index');
    Route::post("/forum/store", 'addForum')->name('forum.addForum');
    Route::post("/forum/{id}/newlike", 'updateLikes')->name('forum.updateLikes');
    Route::post("/forum/{id}/delete", [Forums::class, 'deletedPost'])->name('forum.deletedPost');

    // Comentarios
    Route::get("/forums/{id}/comments", 'viewComments')->name('forum.viewComments');
    Route::post('/forums/{id}/createComment', 'createComment')->name('forum.createComment');
    Route::post('/forums/{id}/delComment/{comment}', 'deletedComment')->name('forum.deleteComment');

    Route::post('/forums/{id}/updatelikes/{comment}', 'updateCommentLikes')->name('forum.updateLikeComment');
    Route::post('/forums/{id}/updateReports/{comment}', 'updateReports')->name('forum.updateReports');
});


/* Pagina del calendario */
Route::group(['controller' => Calendars::class], function () {
    Route::get("/calendar", 'index')->name('calendar.index');
    Route::post('/calendar/updateData', 'updateData')->name('calendar.changeData');
});


// Pagina Ajustes de privacidad
Route::controller(Privacy::class)->group(function () {
    Route::get("/privacy", 'index')->name('privacy.index');
});


// pagina datos de usuario
Route::controller(UserData::class)->group(function () {
    Route::get("/userData", 'index')->name('userData.index');
});


// pagina notificacion
Route::controller(NotificationSetting::class)->group(function () {
    Route::get("/notification", 'index')->name('notification.index');
});


/* Pagina del Perfil */
Route::group(['middleware' => 'auth.user', 'controller' => Profile::class], function () {
    Route::get('/profile', 'redirect')->name('profilePage.redirect');
    Route::get('/profile/{id}', 'index')->name('profilePage');
    Route::post('/profile/{id}', 'index')->name('profilePage.noperms');
    Route::post('/profile/{id}/changedImage', 'newImage')->name('profilePage.newImage');

    // Pagina del Ciclo
    Route::get("/profile/settings/{id}/cycle", 'cycleSettings')->name('profilePage.cycleSettings');
    Route::post("/profile/settings/{id}/cycle/update", 'changeCicle')->name('cycleSettings.update');
});


/* Pagina para administrar usuarios */
Route::group(['middleware' => ['auth.user', 'auth.admin'], 'controller' => AdminUser::class], function () {
    Route::get("/manageUsers", "index")->name('manageUsers.index');
    Route::post('/manageUsers/{id}/changeRole', 'changeRole')->name('manageUsers.changeRol');
    Route::post('/manageUsers/{id}/removedUser', 'removeUser')->name('manageUsers.removeUser');
});
