<?php

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

Route::get('/alumni', 'AlumniController@index');

Route::get('/alumni/add', 'AlumniController@create');
Route::post('/alumni', 'AlumniController@store');

Route::get('/alumni/{id}/edit', 'AlumniController@edit');
Route::post('/alumni/{id}', 'AlumniController@update');

Route::post('/alumni/{id}/delete', 'AlumniController@destroy');