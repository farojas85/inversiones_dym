<?php

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
    Route::resource('personalsalarios', 'PersonalSalarioController');    
    Route::resource('permissions', 'PermissionController');        

    Route::get('roleTable', 'RoleController@table'); 
    Route::get('permissionTable','PermissionController@table'); 
});
