<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('client.index');
});
Route::get('/home', function () {
    return view('client.index');
})->name('client.index');
Route::get('/contact', function () {
    return view('client.contact');
})->name('client.contact');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified', 'is-ban'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::name('client.')
    ->namespace('Client')
    ->group(function () {
        Route::resource('products', 'ProductController');
        Route::get('orders', 'OrderController@index')->name('orders.index');
        Route::post('orders/remove', 'OrderController@removeProductInCart')->name('orders.product.remove');
        Route::post('orders', 'OrderController@addToCart')->name('orders.addToCart');
        Route::post('orders/single', 'OrderController@addToCartSingle')->name('orders.addToCartSingle');
        Route::post('orders/increase-product-quantity', 'OrderController@increaseQuantity')->name('orders.increase-product-quantity');
        Route::post('orders/decrease-product-quantity', 'OrderController@decreaseQuantity')->name('orders.decrease-product-quantity');

        Route::get('contact', 'ContactController@index')->name('contact.index');
        Route::get('contact/send', 'ContactController@sendContactEmail')->name('contact.send');
    });

Route::middleware(['auth', 'verified', 'is-ban'])
    ->name('client.')
    ->namespace('Client')
    ->group(function () {
        Route::resource('user', 'UserController');
        Route::get('user/{user}/password', 'UserController@editPassword')->name('user.editPassword');
        Route::get('user/{user}/delete', 'UserController@confirmDestroy')->name('user.confirmDestroy');
        Route::put('user/{user}/password', 'UserController@updatePassword')->name('user.updatePassword');

        Route::get('orders/confirmation', 'OrderController@confirmation')->name('orders.confirmation');
        Route::get('orders/confirmation/checkout', 'OrderController@checkout')->name('orders.checkout');

        Route::resource('favorites', 'FavoriteController');
    });

Route::middleware(['auth', 'verified', 'is-ban'])
    ->prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {
        Route::resource('users', 'UserController');
        Route::get('users/{user}/confirmBan', 'UserController@confirmBan')->name('users.confirmBan');
        Route::put('users/{user}/ban', 'UserController@banUser')->name('users.ban');
        Route::get('users/{user}/confirmUnBan', 'UserController@confirmUnBan')->name('users.confirmUnBan');
        Route::put('users/{user}/unBan', 'UserController@unBanUser')->name('users.unBan');

        Route::resource('categories', 'CategoryController');
        Route::get('categories/{category}/delete', 'CategoryController@confirmDestroy')->name('categories.confirmDestroy');

        Route::resource('products', 'ProductController');
        Route::get('products/{product}/confirmDelete', 'ProductController@confirmDelete')->name('products.confirmDelete');

        Route::resource('orders', 'OrderController');
        Route::put('orders/{order}/deliver', 'OrderController@deliverOrder')->name('orders.deliver');
        Route::put('orders/{order}/confirmDeliver', 'OrderController@confirmDeliver')->name('orders.confirmDeliver');
        Route::get('orders/{order}/confirmClose', 'OrderController@confirmClose')->name('orders.confirmClose');
        Route::put('orders/{order}/close', 'OrderController@closeOrder')->name('orders.close');
    });

Auth::routes();
