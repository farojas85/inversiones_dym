<?php

Route::get('/', function () {
    return view('bienvenido');
});

Route::get('/noacceso', function () {
    return view('noacceso');
});

Auth::routes();


Route::get('/perfil','UserController@perfil')->name('perfil');
Route::get('/perfilEdit','UserController@perfilEdit')->name('perfiledit');
Route::post('updatePerfil/{user}','UserController@updatePerfil')->name('perfil.update');
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
Route::get('userTable','UserController@table');
Route::get('userReset/{user}','UserController@resetPassword')->name('users.reset');
Route::post('saveReset/{user}','UserController@saveReset')->name('users.savereset');

Route::group(['middleware' => 'checkRole:cobrador'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});


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
    
    Route::get('/clientes/gmap/{cliente}','ClienteController@gmap')->name('clientes.gmap');
    Route::get('/prestamoReporte','PrestamoController@reporte')->name('prestamos.reporte');
    Route::get('/cobranzaReporte','PrestamoController@reporteCobranza')->name('cobranzas.reporte');
    Route::get('/rangofechasPrestamo/{tipo_busqueda}','PrestamoController@rangoFechas');
    Route::get('/prestamodia','PrestamoController@prestamoDia')->name('prestamos.reportedia');
    Route::get('/prestamomes','PrestamoController@prestamoMes')->name('prestamos.reportemes');
    Route::get('/cobranzadia','PrestamoController@cobranzaDia')->name('cobranzas.reportdia');
    Route::get('/cobranzames','PrestamoController@cobranzaMes')->name('cobranzas.reportemes');
});