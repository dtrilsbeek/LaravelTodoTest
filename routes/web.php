<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('api/auth', 'ApiTokenController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('api/todo-items', 'TodoItemController@all');
    Route::get('api/todo-items/{item}', 'TodoItemController@find');
    Route::post('api/todo-items', 'TodoItemController@create');
    Route::put('api/todo-items/{item}', 'TodoItemController@update');
    Route::delete('api/todo-items/{item}', 'TodoItemController@delete');
});
