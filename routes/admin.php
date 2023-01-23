<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Route::group([
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {
    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::view('/dashboard', 'adminDashboard.dashboard');
    });
});
