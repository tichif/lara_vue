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

Route::get('/tasksList', 'TasksController@index');
Route::post('/tasksList', 'TasksController@store');
Route::get('/tasksList/{task}', 'TasksController@show');
Route::patch('/tasksList/{task}', 'TasksController@update');
Route::delete('/tasksList/{task}', 'TasksController@destroy');
