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
    return view('auth.login');
});

//Esto para personalizar las rutas manualmente
// Route::get('/empleados', 'EmpleadosController@index');
// Route::get('/empleados/create', 'EmpleadosController@create');


//Esto para generarlas a partir de los controladores
Route::resource('empleados','EmpleadosController')->middleware('auth');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
