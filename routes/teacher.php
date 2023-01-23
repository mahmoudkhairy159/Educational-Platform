<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "teacher" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {
    Route::get('/login/teacher', 'Auth\LoginController@showTeacherLoginForm');
    Route::post('/login/teacher', 'Auth\LoginController@teacherLogin');
    Route::get('/register/teacher', 'Auth\RegisterController@showTeacherRegisterForm');
    Route::post('/register/teacher', 'Auth\RegisterController@createTeacher');
    Route::middleware(['auth:teacher'])->prefix('teacher')->group(function () {
        Route::view('/home', 'teacherHome');
    });
});
