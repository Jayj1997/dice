<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'todo',
    'prefix' => 'todo',
    'middleware' => ['CheckClientCredentials', 'auth:api']],
    function () {
        Route::resource('todos', 'TodoController');


        Route::resource('todo_items', 'TodoItemsController');

        Route::prefix('todo_items')->group(function () {
            Route::post('add_common', 'TodoItemsController@addCommon');
            Route::post('delete_common', 'TodoItemsController@deleteCommon');
            Route::post('add_schedule', 'TodoItemsController@addSchedule');
            Route::post('delete_schedule', 'TodoItemsController@deleteSchedule');
            Route::patch('update_order/{id}', 'TodoItemsController@updateOrder');
            Route::patch('update_item_name/{id}', 'TodoItemsController@updateItemName');
            Route::patch('move_to/{id}', 'TodoItemsController@moveTo');
        });
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
