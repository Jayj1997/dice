<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('refreshtoken', 'UserController@refreshToken');

    Route::get('/unauthorized', 'UserController@unauthorized');
    Route::group(['middleware' => ['CheckClientCredentials', 'auth:api']], function () {
        Route::post('logout', 'UserController@logout');
        Route::post('details', 'UserController@details');
    });
});
