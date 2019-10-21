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

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
	Route::resource('evacuados', 'EvacuadoController');
	//EXCEL
	Route::get('descargar-evacuados-pdf', 'EvacuadoController@pdf')->name('evacuados.pdf');
	//PDF
	Route::get('descargar-evacuados-excel', 'EvacuadoController@excel')->name('evacuados.xls');
	//CHARTS
	Route::get('charts', 'ChartsController@chart');
	Route::get('test', 'ChartsController@test');
	
});




Route::group(['middleware' => 'admin'], function() {
	Route::resource('repartos', 'RepartoController');
	Route::resource('areas', 'AreaController');
	Route::resource('eventos-ocurridos', 'EventoController');
	Route::resource('grupos-mando', 'GrupomandoController');
	Route::resource('usuarios', 'UsuarioController');
});

