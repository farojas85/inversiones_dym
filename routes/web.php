<?php

Route::get('/', function () {
    return view('bienvenido');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/perfil','UserController@perfil')->name('perfil');
Route::get('roleTable', 'RoleController@table'); 
Route::get('permissionTable','PermissionController@table'); 
Route::get('permissionroleTable','PermissionRoleController@table');    
Route::get('permisosRol','PermissionRoleController@mostrarPermisosRol')->name('permisosRol');
Route::put('permisosRol/{role}','PermissionRoleController@updatePermissionRol')->name('permissionrole.updatePermissions');
Route::post('sueldoPersonal','PersonalSalarioController@sueldoPersonal');
Route::post('adelantosPersonal','PersonalSalarioController@adelantosPersonal');
Route::get('tableAdelantos','PersonalSalarioController@tableAdelantosPersonal');
Route::get('pdfPagos', 'PersonalSalarioController@pdf');
Route::get('editarMontos/{id}','PersonalMontoController@editarMontos');
Route::put('actualizarMonto/{id}','PersonalMontoController@updateMonto')->name('personalmontos.updateMonto');
Route::get('mostrarCobranza/{id}','PrestamoController@mostrarCobranza');
Route::get('nuevaCobranza/{id}/{minsaldo}/{cuota}','CobranzaController@nuevaCobranza');
Route::get('cobranzasTable/{prestamo_id}','CobranzaController@tabla');
Route::get('pdfCobranza/{cobranza}','CobranzaController@generaPdf')->name('cobranzas.pdf');

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
    Route::resource('permissionroles', 'PermissionRoleController');    
    Route::resource('modulos', 'ModuloController');
    Route::resource('cobranzas', 'CobranzaController');       
});