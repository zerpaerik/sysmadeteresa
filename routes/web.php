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
})->middleware('auth');

Route::get('roles', 'Users\RoleController@index')->name('role.index')->middleware('auth');
Route::get('role-create', 'Users\RoleController@createView')->name('role.create')->middleware('auth');
Route::post('role/create', 'Users\RoleController@create')->middleware('auth');
Route::get('role/{id}', 'Users\RoleController@delete')->middleware('auth');

Route::get('personal', 'Personal\PersonalController@index')->name('personal.index')->middleware('auth');
Route::get('personal-create', 'Personal\PersonalController@createView')->name('personal.create')->middleware('auth');
Route::post('personal/create', 'Personal\PersonalController@create')->middleware('auth');
Route::get('personal/{id}', 'Personal\PersonalController@delete')->middleware('auth');

Route::get('user', 'Users\UserController@index')->name('users.index')->middleware('auth');

Route::post('user/create', 'Users\UserController@create')->middleware('auth');
Route::get('user/{id}', 'Users\UserController@delete')->middleware('auth');

Route::get('/ui', function () { return view('layouts.admin'); })->name('ui');
Route::get('login', 'Users\UserController@loginView')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('user-create', 'Users\UserController@createView')->name('user.create')->middleware('auth');

Route::get('sedes', 'Config\SedeController@index')->name('sedes.index')->middleware('auth');

Route::get('sedes-create', 'Config\SedeController@createView')->name('sedes.create');
Route::post('sede/create', 'Config\SedeController@create')->middleware('auth');

//Medidas
Route::get('medidas', 'Config\MedidaController@index')->name('medidas.index');

//Proveedores
Route::get('proveedores', 'Config\ProveedorController@index')->name('proveedores.index');

//Categorias
Route::get('categorias', 'Config\CategoriaController@index')->name('categorias.index');