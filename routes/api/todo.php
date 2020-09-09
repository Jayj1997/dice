<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'todo',
    'prefix' => 'todo',
    'middleware' => ['CheckClientCredentials', 'auth:api']],
    function () {
        Route::resource('todos', 'TodoController');


        Route::resource('todo_items', 'TodoItemsController');
        Route::post('todo_items/add_common', 'TodoItemsController@addCommon');
        Route::post('todo_items/delete_common', 'TodoItemsController@deleteCommon');
        Route::post('todo_items/add_schedule', 'TodoItemsController@addSchedule');
        Route::post('todo_items/delete_schedule', 'TodoItemsController@deleteSchedule');
});

/*
 * Route::resource('users', 'UserController')
 * ==========================================
 * Route::get('/users', 'UsersController@index')->name('users.index');
 * Route::get('/users/{user}', 'UsersController@show')->name('users.show');
 * Route::get('/users/create', 'UsersController@create')->name('users.create');
 * Route::post('/users', 'UsersController@store')->name('users.store');
 * Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
 * Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
 * Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
 */
