<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('/feeds', 'FeedController@index');
    // Route::get('/feeds/create', 'FeedController@create');
    Route::resource('feeds', 'FeedController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
