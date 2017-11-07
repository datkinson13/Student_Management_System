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

Route::get('/', 'PageController@index');

Auth::routes(); // Laravel built in Auth routes. /login /register /password/forgot /password/reset

// User routing
Route::resource('users', 'UserController')->middleware('auth');

// Course routing
Route::resource('/course', 'CourseController');
Route::get('course/{course}/email', 'CourseController@compose');

