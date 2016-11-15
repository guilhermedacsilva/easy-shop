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

Auth::routes();

Route::get('/', function () {
    return redirect('login');
});

Route::get('home', function() {
    return redirect('sessions');
});

Route::group(['middleware' => 'auth'], function(){
  Route::resource('users', 'UserController');
  Route::get('users/{user}/password', 'UserController@editPassword')->name('users.password.edit');
  Route::patch('users/{user}/password', 'UserController@updatePassword')->name('users.password.update');
  Route::patch('users/{user}/disable', 'UserController@disable')->name('users.disable');
  Route::resource('sessions', 'SessionController');
});
