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
    return view('layouts.app');
});

Route::get('personal', 'Users\UserController@index')->name('personal.index');
Route::get('personal/create', function() {return view('archivos.personal.create');})->name('personal.create');

Auth::routes();
Route::get('/ui', function () { return view('layouts.admin'); })->name('ui');
Route::get('/register', function () { return view('register'); })->name('register');
