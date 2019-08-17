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
//Route welcome Laravel
Route::get('/', function () {
    return view('welcome');
});

//Route index
Route::get('index', function() {
    return view('index');
});

//Route to get dynamic register
Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');

//Route to get dynimic login + logout
Route::get('/login', 'SessionsController@create') -> middleware('checklogout');

Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

//Route index
Route::get('/index', 'IndexController@index');
Route::post('/index/search', 'IndexController@search');

//Route CRUD admin
Route::post('/admin/search', 'AdminController@search');

//Route CRUD post
Route::post('/post/search', 'PostController@search');

//Route access + CRUD admin
Route::group(['middleware' => 'checklogin'], function () {
    Route::resource('/admin', 'AdminController');
});

//Route access + CRUD post
Route::group(['middleware' => 'checklogin'], function () {
    Route::resource('/post', 'PostController');
});


