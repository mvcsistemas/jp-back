<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'as'        => 'auth.',
    'namespace' => 'Auth',
], function () {
    // Login WEB
    Route::post('login', 'AuthenticateController@login');
    Route::post('logout', 'AuthenticateController@logout');

    //Login API
    Route::post('login-api', 'AuthenticateController@loginApi');
    Route::post('logout-api', 'AuthenticateController@logoutApi')->middleware('auth:sanctum');
});

Route::group([
    'as'        => 'password.',
    'namespace' => 'ResetPassword'
], function () {
    //Reset Password
    Route::post('forgot-password', 'ResetPasswordController@forgotPassword')->name('forgot');
    Route::post('reset-password', 'ResetPasswordController@resetPassword')->name('reset');
});

Route::group([
    'prefix'    => 'first-access',
    'as'        => 'first-acess.',
    'namespace' => 'FirstAccess'
], function () {
    Route::post('generate-otp', 'FirstAccessController@generate')->name('generate-otp');
    Route::post('check-otp', 'FirstAccessController@checkCodeForNewPassword')->name('check-otp');
    Route::post('create-password', 'FirstAccessController@createPassword')->name('create-password');
});


Route::group([
    'as'         => 'portal.',
    'prefix'    => 'portal',
    'middleware' => 'auth:sanctum'
], function () {
    Route::group([
        'prefix'    => 'user',
        'as'        => 'user.',
        'namespace' => 'User'
    ], function () {
        Route::apiResource('', 'UserController')->parameters(['' => 'uuid']);
    });
});
