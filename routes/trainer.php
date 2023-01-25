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
    Route::get('/login/trainer', 'Auth\LoginController@showtrainerLoginForm');
    Route::post('/login/trainer', 'Auth\LoginController@trainerLogin');
    Route::get('/register/trainer', 'Auth\RegisterController@showtrainerRegisterForm');
    Route::post('/register/trainer', 'Auth\RegisterController@createtrainer');
    Route::middleware(['auth:trainer'])->prefix('trainer')->group(function () {
        Route::view('/home', 'trainer.home');
    });
});
