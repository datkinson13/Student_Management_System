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
// Route::get('/users/{user}/updatePassword', 'UserController@updatePassword');

// Routing for help tickets
Route::resource('tickets', 'TicketController');
Route::post('/tickets/{ticket}/comments', 'CommentController@store');

// Business role Routing
Route::resource('businessroles', 'BusinessRoleController');

// Report routing
Route::resource('reports', 'ReportController');

// Competency monitor routing
Route::get('/competencies/monitor', 'CompetencyMonitorController@index');

// Training Liability Calculator routing
Route::get('/trainingliability/calculate', 'TrainingLiabilityController@index');

// Calendar routing
Route::get('calendar', function () {
    return view('calendar.index');
});

// Enrollment routing
Route::resource('enrollment', 'EnrollmentController');
Route::post('/enrollment/withdraw', 'EnrollmentController@withdraw')->name('enrollment.withdraw');

// Employer/Business routing
Route::resource('business', 'EmployerController');

// Course routing
Route::resource('/course', 'CourseController');
Route::get('course/{course}/email', 'CourseController@compose');
