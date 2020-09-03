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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('todo-items', 'TodoItemController@all');
Route::get('todo-items/{item}', 'TodoItemController@find');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('todo-items', 'TodoItemController@create');
    Route::put('todo-items/{item}', 'TodoItemController@update');
    Route::delete('todo-items/{item}', 'TodoItemController@delete');
});
