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

//Route admin
Route::get('admin', function() {
    return view('admin');
});

//Route index
Route::get('index', function() {
    return view('index');
});

//Route login
Route::get('login', function() {
    return view('login');
});

//Route to get static register
// Route::get('register', function() {
//     return view('register');
// });

//Route to get dynamic register
Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');
