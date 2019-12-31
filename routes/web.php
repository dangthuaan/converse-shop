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
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', function() {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'verified'])
    ->name('client.')
    ->namespace('Client')
    ->group(function () {
    Route::resource('user', 'UserController');
    Route::get('user/{user}/password', 'UserController@editPassword')->name('user.editPassword');
    Route::get('user/{user}/delete', 'UserController@confirmDestroy')->name('user.confirmDestroy');
    Route::put('user/{user}/password', 'UserController@updatePassword')->name('user.updatePassword');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::get('categories/{category}/delete', 'CategoryController@confirmDestroy')->name('categories.confirmDestroy');

    Route::resource('products', 'ProductController');
    Route::get('products/{product}/delete', 'ProductController@confirmDestroy')->name('products.confirmDestroy');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
