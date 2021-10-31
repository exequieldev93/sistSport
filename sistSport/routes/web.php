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


//Modulo Invetario
Route::resource('almacen/prenda','PrendaController');
Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/color','ColorController');
Route::resource('almacen/talle','TalleController');
Route::resource('almacen/material','MaterialController');
Route::resource('compra/ingreso','IngresoController');

Route::resource('configuracion/tienda','EmpresaController');
Route::resource('acceso/rol','RolController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
