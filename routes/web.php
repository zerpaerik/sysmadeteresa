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

Route::get('centros', 'Archivos\CentrosController@index')->name('centros.index')->middleware('auth');
Route::get('centros-create', 'Archivos\CentrosController@createView')->name('centros.create')->middleware('auth');
Route::post('centros/create', 'Archivos\CentrosController@create')->middleware('auth');
Route::get('centros-edit/{id}', 'Archivos\CentrosController@edit')->middleware('auth');
Route::post('centros/update', 'Archivos\CentrosController@update')->middleware('auth');
Route::get('centros/{id}', 'Archivos\CentrosController@delete')->middleware('auth');

Route::get('profesionales', 'Archivos\ProfesionalesController@index')->name('profesionales.index')->middleware('auth');
Route::get('profesionales-create', 'Archivos\ProfesionalesController@createView')->name('profesionales.create')->middleware('auth');
Route::post('profesionales/create', 'Archivos\ProfesionalesController@create')->middleware('auth');
Route::get('profesionales-edit/{id}', 'Archivos\ProfesionalesController@edit')->middleware('auth');
Route::post('profesionales/update', 'Archivos\ProfesionalesController@update')->middleware('auth');
Route::get('profesionales/{id}', 'Archivos\ProfesionalesController@delete')->middleware('auth');

Route::get('laboratorios', 'Archivos\LaboratoriosController@index')->name('laboratorios.index')->middleware('auth');
Route::get('laboratorios-create', 'Archivos\LaboratoriosController@createView')->name('laboratorios.create')->middleware('auth');
Route::post('laboratorios/create', 'Archivos\LaboratoriosController@create')->middleware('auth');
Route::get('laboratorios-edit/{id}', 'Archivos\LaboratoriosController@edit')->middleware('auth');
Route::post('laboratorios/update', 'Archivos\LaboratoriosController@update')->middleware('auth');
Route::get('laboratorios/{id}', 'Archivos\LaboratoriosController@delete')->middleware('auth');

Route::get('analisis', 'Archivos\AnalisisController@index')->name('analisis.index')->middleware('auth');
Route::get('analisis-create', 'Archivos\AnalisisController@createView')->name('analisis.create')->middleware('auth');
Route::post('analisis/create', 'Archivos\AnalisisController@create')->middleware('auth');
Route::get('analisis-edit/{id}', 'Archivos\AnalisisController@edit')->middleware('auth');
Route::post('analisis/update', 'Archivos\AnalisisController@update')->middleware('auth');
Route::get('analisis/{id}', 'Archivos\AnalisisController@delete')->middleware('auth');

Route::get('servicios', 'Archivos\ServiciosController@index')->name('servicios.index')->middleware('auth');
Route::get('servicios-create', 'Archivos\ServiciosController@createView')->name('servicios.create')->middleware('auth');
Route::post('servicios/create', 'Archivos\ServiciosController@create')->middleware('auth');
Route::get('servicios-edit/{id}', 'Archivos\ServiciosController@edit')->middleware('auth');
Route::post('servicios/update', 'Archivos\ServiciosController@update')->middleware('auth');
Route::get('servicios/{id}', 'Archivos\ServiciosController@delete')->middleware('auth');

Route::get('paquetes', 'Archivos\PaquetesController@index')->name('paquetes.index')->middleware('auth');
Route::get('paquetes-create', 'Archivos\PaquetesController@createView')->name('paquetes.create')->middleware('auth');
Route::post('paquetes/create', 'Archivos\PaquetesController@create')->middleware('auth');
Route::get('paquetes-edit/{id}', 'Archivos\PaquetesController@edit')->middleware('auth');
Route::post('paquetes/update', 'Archivos\PaquetesController@update')->middleware('auth');
Route::get('paquetes/{id}', 'Archivos\PaquetesController@delete')->middleware('auth');

Route::get('pacientes', 'Archivos\PacientesController@index')->name('pacientes.index')->middleware('auth');
Route::get('pacientes-create', 'Archivos\PacientesController@createView')->name('pacientes.create')->middleware('auth');
Route::post('pacientes/create', 'Archivos\PacientesController@create')->middleware('auth');
Route::get('pacientes-edit/{id}', 'Archivos\PacientesController@edit')->middleware('auth');
Route::post('pacientes/update', 'Archivos\PacientesController@update')->middleware('auth');
Route::get('pacientes/{id}', 'Archivos\PacientesController@delete')->middleware('auth');

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

//Productos
Route::get('productos', 'Existencias\ProductoController@index')->name('productos.index');
Route::post('producto/create', 'Existencias\ProductoController@create')->name('producto.create');
Route::get('productos-create', 'Existencias\ProductoController@createView')->name('existencias.create');
Route::get('existencias-edit-{id}', 'Existencias\ProductoController@editView')->name('existencias.edit');
Route::post('producto/edit', 'Existencias\ProductoController@edit');
Route::delete('existencias-delete-{id}', 'Existencias\ProductoController@delete');
Route::get('existencias-in', 'Existencias\ProductoController@productInView')->name('productos.in');
Route::get('existencias-out', 'Existencias\ProductoController@productOutView')->name('productos.out');
Route::get('existencias-trans', 'Existencias\ProductoController@productTransView')->name('productos.trans');
Route::get('producto/{id}', 'Existencias\ProductoController@getProduct');
Route::post('transfer', 'Existencias\ProductoController@transfer');
Route::patch('producto', 'Existencias\ProductoController@addCant');

//Medidas
Route::get('medidas', 'Config\MedidaController@index')->name('medidas.index');
Route::get('medidas-create', 'Config\MedidaController@createView')->name('medidas.create');
Route::get('medidas-edit-{id}', 'Config\MedidaController@editView')->name('medidas.edit');


//Proveedores
Route::get('proveedores', 'Config\ProveedorController@index')->name('proveedores.index');
Route::get('proveedores-create', 'Config\ProveedorController@createView')->name('proveedores.create');
Route::get('proveedores-edit-{id}', 'Config\ProveedorController@editView')->name('proveedores.edit');

//Categorias
Route::get('categorias', 'Config\CategoriaController@index')->name('categorias.index');
Route::get('categorias-create', 'Config\CategoriaController@createView')->name('categorias.create');
Route::get('categorias-edit-{id}', 'Config\CategoriaController@editView')->name('categorias.edit');