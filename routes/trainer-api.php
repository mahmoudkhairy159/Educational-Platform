<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['api', 'checkPassword', 'switchLanguage'], 'prefix' => 'trainer'], function () {
    Route::post('login', 'Api\Trainer\AuthController@login');
    Route::post('register', 'Api\Trainer\AuthController@register');


    Route::group(['middleware' => ['assignGuard:trainer-api'], 'namespace' => 'Api'], function () {
        Route::post('logout', 'Trainer\AuthController@logout');
        Route::get('me', 'Trainer\AuthController@trainer');
        Route::apiResource('courses', 'CourseController')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/courses/', 'CourseController@indexTrainer');
        Route::get('/courses/{course}/', 'CourseController@showTrainer');
        Route::apiResource('lessons', 'LessonController')->only([
            'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/lessons/create/{courseId}', 'LessonController@create');
        Route::get('/lessons', 'LessonController@indexTrainer');
        Route::get('/lessons/{lesson}/', 'LessonController@showTrainer');
        Route::apiResource('trainers', 'TrainerController')->only([
            'show', 'update',
        ]);

        Route::put('/changePassword/{id}', 'TrainerController@changePassword');
        Route::get('/users', 'UserController@index');
        Route::get('/courses/{courseId}/users', 'CourseController@showCourseStudents');
        Route::get('/courses/{courseId}/users/{userId}/', 'UserController@showUserForTrainer');
        Route::delete('/courses/{courseId}/users/{userId}/', 'UserController@destroy');
        Route::get('/courses/{courseId}/EnrollmentRequests/', 'CourseController@showCourseEnrollmentRequests');
        Route::get('/courses/{courseId}/acceptEnrollmentRequest/{userId}/', 'CourseController@acceptCourseEnrollmentRequests');
        Route::get('/courses/{courseId}/refuseEnrollmentRequest/{userId}', 'CourseController@refuseCourseEnrollmentRequests');
    });
});
