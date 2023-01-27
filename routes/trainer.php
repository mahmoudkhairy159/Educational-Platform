<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| trainer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "trainer" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {
    Route::get('/login/trainer', 'Auth\LoginController@showTrainerLoginForm');
    Route::post('/login/trainer', 'Auth\LoginController@trainerLogin');
    Route::get('/register/trainer', 'Auth\RegisterController@showTrainerRegisterForm');
    Route::post('/register/trainer', 'Auth\RegisterController@createTrainer');

    Route::middleware(['auth:trainer'])->prefix('trainer')->group(function () {
        Route::view('/home', 'trainer.home');
        Route::resource('courses', 'CourseController')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/courses/', 'CourseController@indexTrainer')->name('courses.indexTrainer');
        Route::get('/courses/{course}/', 'CourseController@showTrainer')->name('courses.showTrainer');
        Route::resource('lessons', 'LessonController')->only([
            'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/lessons/create/{courseId}', 'LessonController@create')->name('lessons.create');
        Route::get('/lessons/', 'LessonController@indexTrainer')->name('lessons.indexTrainer');
        Route::get('/lessons/{lesson}/', 'LessonController@showTrainer')->name('lessons.showTrainer');
        Route::resource('trainers','TrainerController')->only([
            'index','show','update',
        ]);

        Route::put('/changePassword/{id}', 'TrainerController@changePassword')->name('trainers.changePassword');
    });
});
