<?php

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


Route::get('/profile', 'UserController@index')->name('profile.index');
Route::post('/profile/update', 'UserController@updateProfile')->name('profile.update');

Route::name('user.')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::resource('post','PostController');
    });

});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
