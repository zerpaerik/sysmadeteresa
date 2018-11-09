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
Route::get('personal-edit-{id}', 'Personal\PersonalController@editView')->name('personal.edit');
Route::post('personal/edit', 'Personal\PersonalController@edit');

Route::get('centros', 'Archivos\CentrosController@index')->name('centros.index')->middleware('auth');
Route::get('centros-create', 'Archivos\CentrosController@createView')->name('centros.create')->middleware('auth');
Route::post('centros/create', 'Archivos\CentrosController@create')->middleware('auth');
Route::get('centros/{id}', 'Archivos\CentrosController@delete')->middleware('auth');
Route::get('centros-edit-{id}', 'Archivos\CentrosController@editView')->name('centros.edit');
Route::post('centros/edit', 'Archivos\CentrosController@edit');

Route::get('profesionales', 'Archivos\ProfesionalesController@index')->name('profesionales.index')->middleware('auth');
Route::get('profesionales-create', 'Archivos\ProfesionalesController@createView')->name('profesionales.create')->middleware('auth');
Route::post('profesionales/create', 'Archivos\ProfesionalesController@create')->middleware('auth');
Route::get('profesionales/{id}', 'Archivos\ProfesionalesController@delete')->middleware('auth');
Route::get('profesionales-edit-{id}', 'Archivos\ProfesionalesController@editView')->name('profesionales.edit');
Route::post('profesionales/edit', 'Archivos\ProfesionalesController@edit');

Route::get('laboratorios', 'Archivos\LaboratoriosController@index')->name('laboratorios.index')->middleware('auth');
Route::get('laboratorios-create', 'Archivos\LaboratoriosController@createView')->name('laboratorios.create')->middleware('auth');
Route::post('laboratorios/create', 'Archivos\LaboratoriosController@create')->middleware('auth');
Route::get('laboratorios/{id}', 'Archivos\LaboratoriosController@delete')->middleware('auth');
Route::get('laboratorios-edit-{id}', 'Archivos\LaboratoriosController@editView')->name('laboratorios.edit');
Route::post('laboratorios/edit', 'Archivos\LaboratoriosController@edit');

Route::get('analisis', 'Archivos\AnalisisController@index')->name('analisis.index')->middleware('auth');
Route::get('analisis-create', 'Archivos\AnalisisController@createView')->name('analisis.create')->middleware('auth');
Route::post('analisis/create', 'Archivos\AnalisisController@create')->middleware('auth');
Route::get('analisis/{id}', 'Archivos\AnalisisController@delete')->middleware('auth');
Route::get('analisis-edit-{id}', 'Archivos\AnalisisController@editView')->name('analisis.edit');
Route::post('analisis/edit', 'Archivos\AnalisisController@edit');

Route::get('analisis/getAnalisi/{id}', 'Archivos\AnalisisController@getAnalisi');

Route::get('servicios', 'Archivos\ServiciosController@index')->name('servicios.index')->middleware('auth');
Route::get('servicios-create', 'Archivos\ServiciosController@createView')->name('servicios.create')->middleware('auth');
Route::post('servicios/create', 'Archivos\ServiciosController@create')->middleware('auth');
Route::get('servicios/{id}', 'Archivos\ServiciosController@delete')->middleware('auth');
Route::get('servicios-edit-{id}', 'Archivos\ServiciosController@editView')->name('servicios.edit');
Route::post('servicios/edit', 'Archivos\ServiciosController@edit');

Route::get('servicios/getServicio/{id}', 'Archivos\ServiciosController@getServicio');

Route::get('pacientes', 'Archivos\PacientesController@index')->name('pacientes.index')->middleware('auth');
Route::get('pacientes-create', 'Archivos\PacientesController@createView')->name('pacientes.create')->middleware('auth');
Route::post('pacientes/create', 'Archivos\PacientesController@create')->middleware('auth');
Route::get('pacientes/{id}', 'Archivos\PacientesController@delete')->middleware('auth');
Route::get('pacientes-edit-{id}', 'Archivos\PacientesController@editView')->name('pacientes.edit');
Route::post('pacientes/edit', 'Archivos\PacientesController@edit');
/**
 * Paquetes
 */
Route::get('paquetes', 'Archivos\PaquetesController@index')->name('paquetes.index')->middleware('auth');
Route::get('paquetes-create', 'Archivos\PaquetesController@createView')->name('paquetes.create')->middleware('auth');
Route::post('paquetes/create', 'Archivos\PaquetesController@create')->middleware('auth');
Route::get('paquetes-edit-{id}', 'Archivos\PaquetesController@edit')->middleware('auth');
Route::post('paquetes/edit/{id}', 'Archivos\PaquetesController@update')->middleware('auth');
Route::get('paquetes/{id}', 'Archivos\PaquetesController@delete')->middleware('auth');
Route::get('paquete/view/{id}', 'Archivos\PaquetesController@show')->middleware('auth');
Route::get('paquete/getPaquete/{id}', 'Archivos\PaquetesController@getPaquete');

/**
 * Atenciones
 */
Route::get('atenciones', 'AtencionesController@index')->name('atenciones.index')->middleware('auth');
Route::get('atenciones-search', 'AtencionesController@search')->name('atenciones.search')->middleware('auth');
Route::get('atenciones-create', 'AtencionesController@createView')->name('atenciones.create')->middleware('auth');
Route::post('atenciones/create', 'AtencionesController@create')->middleware('auth');
Route::get('atenciones/{id}', 'AtencionesController@delete')->middleware('auth');
Route::get('atenciones-edit-{id}', 'AtencionesController@editView')->name('atenciones.edit');
Route::post('atenciones/edit/{id}', 'AtencionesController@edit');

Route::get('gastos', 'GastosController@index')->name('gastos.index')->middleware('auth');
Route::get('gastos-search', 'GastosController@search')->name('gastos.search')->middleware('auth');
Route::get('gastos-create', 'GastosController@createView')->name('gastos.create')->middleware('auth');
Route::post('gastos/create', 'GastosController@create')->middleware('auth');
Route::get('gastos/{id}', 'GastosController@delete')->middleware('auth');
Route::get('gastos-edit-{id}', 'GastosController@editView')->name('gastos.edit');
Route::post('gastos/edit', 'GastosController@edit');

Route::get('labporpagar', 'LabporPagarController@index')->name('labporpagar.index')->middleware('auth');
Route::get('labporpagar-search', 'LabporPagarController@search')->name('labporpagar.search')->middleware('auth');
Route::get('labporpagar-create', 'LabporPagarController@createView')->name('labporpagar.create')->middleware('auth');
Route::post('labporpagar/create', 'LabporPagarController@create')->middleware('auth');
Route::get('labporpagar/{id}', 'LabporPagarController@delete')->middleware('auth');
Route::get('labporpagar-edit-{id}', 'LabporPagarController@editView')->name('labporpagar.edit');
Route::post('labporpagar/edit', 'LabporPagarController@edit');
Route::get('pagar/{id}', 'LabporPagarController@pagar')->middleware('auth');

Route::get('comporpagar', 'ComporPagarController@index')->name('comporpagar.index')->middleware('auth');
Route::get('comporpagar-search', 'ComporPagarController@search')->name('comporpagar.search')->middleware('auth');
Route::get('comporpagar-create', 'ComporPagarController@createView')->name('comporpagar.create')->middleware('auth');
Route::post('comporpagar/create', 'ComporPagarController@create')->middleware('auth');
Route::get('comporpagar/{id}', 'ComporPagarController@delete')->middleware('auth');
Route::get('comporpagar-edit-{id}', 'ComporPagarController@editView')->name('comporpagar.edit');
Route::post('comporpagar/edit', 'ComporPagarController@edit');
Route::get('pagarcom/{id}', 'ComporPagarController@pagarcom')->middleware('auth');


Route::get('ingresos', 'OtrosIngresosController@index')->name('ingresos.index')->middleware('auth');
Route::get('ingresos-search', 'OtrosIngresosController@search')->name('ingresos.search')->middleware('auth');
Route::get('ingresos-create', 'OtrosIngresosController@createView')->name('ingresos.create')->middleware('auth');
Route::post('ingresos/create', 'OtrosIngresosController@create')->middleware('auth');
Route::get('ingresos/{id}', 'OtrosIngresosController@delete')->middleware('auth');
Route::get('ingresos-edit-{id}', 'OtrosIngresosController@editView')->name('ingresos.edit');
Route::post('ingresos/edit', 'OtrosIngresosController@edit');

Route::get('cuentasporcobrar', 'CuentasporCobrarController@index')->name('cuentasporcobrar.index')->middleware('auth');
Route::get('cuentasporcobrar-search', 'CuentasporCobrarController@search')->name('cuentasporcobrar.search')->middleware('auth');
Route::get('cuentasporcobrar-create', 'CuentasporCobrarController@createView')->name('cuentasporcobrar.create')->middleware('auth');
Route::post('cuentasporcobrar/create', 'CuentasporCobrarController@create')->middleware('auth');
Route::get('cuentasporcobrar/{id}', 'CuentasporCobrarController@delete')->middleware('auth');
Route::get('cuentasporcobrar-edit-{id}', 'CuentasporCobrarController@editView')->name('cuentasporcobrar.edit');
Route::post('cuentasporcobrar/edit', 'CuentasporCobrarController@edit');

Route::get('movimientos/atencion/personal','AtencionesController@personal');
Route::get('movimientos/atencion/profesional','AtencionesController@profesional');

Route::get('resultados', 'ResultadosController@index')->name('resultados.index')->middleware('auth');
Route::get('resultados-create', 'ResultadosController@createView')->name('resultados.create')->middleware('auth');
Route::post('resultados/create', 'ResultadosController@create')->middleware('auth');
Route::get('resultados/{id}', 'ResultadosController@delete')->middleware('auth');
Route::get('resultados-edit-{id}', 'ResultadosController@editView')->name('resultados.edit');
Route::post('resultados/edit/{id}', 'ResultadosController@edit');

Route::get('resultadosguardados-ver-{id}', 'ReportesController@resultados_ver')->name('resultados.ver');


Route::get('resultadosguardados', 'ResultadosGuardadosController@index')->name('resultadosguardados.index')->middleware('auth');


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
Route::get('existencia/{prod}/{sede}', 'Existencias\ProductoController@getExist');
Route::get('producto/{id}', 'Existencias\ProductoController@getProduct');
Route::post('transfer', 'Existencias\ProductoController@transfer');
Route::patch('producto', 'Existencias\ProductoController@addCant');
Route::get('historico', 'Existencias\ProductoController@historicoView')->name('historico');
Route::get('transferencia-{code}', 'Existencias\ProductoController@transView')->name('transferencia');


Route::get('requerimientos', 'Existencias\RequerimientosController@index')->name('requerimientos.index')->middleware('auth');
Route::get('requerimientos1', 'Existencias\RequerimientosController@index2')->name('requerimientos.index2')->middleware('auth');
Route::get('requerimientos-search', 'Existencias\RequerimientosController@search')->name('requerimientos.search')->middleware('auth');
Route::get('requerimientos-create', 'Existencias\RequerimientosController@createView')->name('requerimientos.create')->middleware('auth');
Route::post('requerimientos/create', 'Existencias\RequerimientosController@create')->middleware('auth');
Route::get('requerimientos-edit-{id}', 'Existencias\RequerimientosController@editView')->name('requerimientos.edit');
Route::get('procesar/{id}', 'Existencias\RequerimientosController@procesar')->middleware('auth');
Route::get('requerimientos-edit-{id}', 'Existencias\RequerimientosController@editView')->name('requerimientos.edit');
Route::post('requerimientos/edit', 'Existencias\RequerimientosController@edit');



//Medidas
Route::get('medidas', 'Config\MedidaController@index')->name('medidas.index');
Route::get('medidas-create', 'Config\MedidaController@createView')->name('medidas.create');
Route::get('medidas-edit-{id}', 'Config\MedidaController@editView')->name('medidas.edit');

//Proveedores
Route::get('proveedores', 'Config\ProveedorController@index')->name('proveedores.index');
Route::get('proveedores-create', 'Config\ProveedorController@createView')->name('proveedores.create');
Route::get('proveedores-edit-{id}', 'Config\ProveedorController@editView')->name('proveedores.edit');
Route::post('proveedor/create', 'Config\ProveedorController@create');

//Categorias
Route::get('categorias', 'Config\CategoriaController@index')->name('categorias.index');
Route::get('categorias-create', 'Config\CategoriaController@createView')->name('categorias.create');
Route::get('categorias-edit-{id}', 'Config\CategoriaController@editView')->name('categorias.edit');

//Consultas
Route::get('event-{id}','Events\EventController@show');
Route::match(['get', 'post'], 'events', 'Events\EventController@index')->name('consultas.index');
Route::get('available-time/{e}/{d}/{m}/{y}', 'Events\EventController@availableTime');
Route::get('consulta-create', 'Events\EventController@createView')->name('consultas.create');
Route::post('consulta/create', 'Events\EventController@create');
Route::post('historial/create','HistorialController@create')->name('historials.create');
Route::post('observacion/create','ConsultaController@create')->name('observacions.create');

/**
 * Reportes
 */
Route::get('diario', 'ReportesController@relacion_ingreso_egreso');