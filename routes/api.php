<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['api', 'checkPassword', 'switchLanguage'], 'prefix' => 'student'], function () {
    Route::post('login', 'Api\User\AuthController@login');
    Route::post('register', 'Api\user\AuthController@register');


    Route::group(['middleware' => ['assignGuard:api'], 'namespace' => 'Api'], function () {
        Route::post('logout', 'User\AuthController@logout');
        Route::get('me', 'User\AuthController@user');
        Route::get('/home', 'HomeController@index');
        Route::apiResource('courses', 'CourseController')->only([
            'index', 'show'
        ]);
        Route::apiResource('lessons', 'LessonController')->only([
            'index', 'show'
        ]);
        Route::apiResource('trainers', 'TrainerController')->only([
            'index',
        ]);
        Route::get('/trainers/{trainerId}', 'TrainerController@showTrainerProfileToUser');
        Route::apiResource('users', 'UserController')->only([
            'show', 'update',
        ]);


        Route::put('/changePassword/{id}', 'UserController@changePassword');

        Route::get('/myCourses', 'CourseController@indexStudentCourses');

        Route::post('/askToEnrollcourse', 'CourseController@askToEnrollCourse');
    });
});
