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
*/Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:web');

    Route::middleware(['auth:web'])->prefix('user')->group(function () {
        Route::resource('courses', 'CourseController')->only([
            'index', 'show'
        ]);
        Route::resource('lessons', 'LessonController')->only([
            'index', 'show'
        ]);


    });
});
