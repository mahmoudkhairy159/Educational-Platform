<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

define('paginationCount', 5);




Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:web');
    Route::view('/about', 'student.about')->name('about')->middleware('auth:web');

    Route::middleware(['auth:web'])->prefix('user')->group(function () {
        Route::resource('courses', 'CourseController')->only([
            'index', 'show'
        ]);
        Route::resource('lessons', 'LessonController')->only([
            'index', 'show'
        ]);
        Route::resource('trainers', 'TrainerController')->only([
            'index',
        ]);
        Route::resource('users', 'UserController')->only([
            'show', 'update',
        ]);
        Route::put('/changePassword/{id}', 'UserController@changePassword')->name('users.changePassword');

        Route::get('/trainers/{trainerId}', 'TrainerController@showTrainerProfileToUser')->name('trainers.showTrainerProfileToUser');
        Route::get('/myCourses', 'CourseController@indexStudentCourses')->name('courses.indexStudentCourses');

        Route::get('/course/{courseId}', 'CourseController@askToEnrollCourse')->name('courses.askToEnrollCourse');
    });
});
