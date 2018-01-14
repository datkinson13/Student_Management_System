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

// Dashboard routing
Route::get('/', 'PageController@index');

// Auth routing
Auth::routes(); // Laravel built in Auth routes. /login /register /password/forgot /password/reset

// User routing
Route::resource('users', 'UserController')->middleware('auth');
Route::post('/users/{user}/upload', 'UserController@upload')->name('user.upload')->middleware('auth');
Route::post('/users/{user}/deletefile', 'UserController@deletefile')->name('user.deletefile')->middleware('auth');
// Route::get('/users/{user}/updatePassword', 'UserController@updatePassword');

// Routing for help tickets
Route::resource('tickets', 'TicketController');
Route::post('/tickets/{ticket}/comments', 'CommentController@store');

// Business role Routing
// Route::delete('businessroles/removeuser', 'BusinessRoleController@removeUser');
// Route::delete('businessroles/removecourse', 'BusinessRoleController@removeCourse');
Route::resource('businessroles', 'BusinessRoleController')->middleware('auth');

// Report routing
Route::resource('reports', 'ReportController')->middleware('auth');

// Competency monitor routing
Route::get('/competencies/monitor', 'CompetencyMonitorController@index')->middleware('auth');

// Training Liability Calculator routing
Route::get('/trainingliability/calculate', 'TrainingLiabilityController@index')->middleware('auth');

// Calendar routing
Route::resource('calendar', 'CalendarController');
Route::match(['get','post'], 'calendarEvents', 'CalendarController@events')->name('calendar.events');

// Enrollment routing
Route::resource('enrollment', 'EnrollmentController')->middleware('auth');
Route::post('/enrollment/withdraw', 'EnrollmentController@withdraw')->name('enrollment.withdraw')->middleware('auth');

// Employer/Business routing
Route::resource('business', 'EmployerController');

// Course routing
Route::resource('/course', 'CourseController');
Route::get('course/{course}/email', 'CourseController@compose');
