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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){	
    Route::resource('roles', 'RoleController');    
    Route::resource('users', 'UserController');     
    Route::resource('personals', 'PersonalController');
    Route::resource('clientes', 'ClienteController');
    Route::resource('personalmontos', 'PersonalMontoController');
    Route::resource('prestamos', 'PrestamoController');    
    Route::resource('personaladelantos', 'PersonalAdelantoController');    

    Route::get('roleTable', 'RoleController@table');   
});
