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

Route::get('/helloworld', function () {
    return 'Hello World';
});

Route::get('/helloworld/{param}', function ($param) {
    return 'Hello ' . $param;
});

Route::post('/hellopost', function (\Illuminate\Http\Request $request) {
    return 'Hello new ' . $request->input('name');
});

Route::put('/users/{id}', function ($value) {
    return 'Updated ' . $value;
});

Route::delete('/users/{id}', function ($value) {
    return 'Bye put ' . $value;
});

Route::get('/photos', 'Hello@index');