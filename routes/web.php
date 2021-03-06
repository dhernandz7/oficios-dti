<?php

Auth::routes([
	'verify' => true
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('index', 'HomeController@index')->name('index');

Route::prefix('api')->middleware(['auth', 'verified'])->group(function() {
	Route::get('usuarios', 'AdminController@index')->name('api.admin.usuarios.index');
	Route::get('usuarios/{id}', 'AdminController@update')->name('api.admin.usuarios.update');
	Route::delete('usuarios/{id}', 'AdminController@destroy')->name('api.admin.usuarios.destroy');
	Route::put('usuarios/{id}/rol', 'AdminController@role')->name('api.admin.usuarios.rol.update');

	/*
	Route::get('roles', 'RoleController@index')->name('api.admin.roles.index');
	Route::put('roles/{id}', 'RoleController@update')->name('api.admin.roles.update');
	Route::delete('roles/{id}', 'RoleController@delete')->name('api.admin.roles.delete');

	Route::get('permisos', 'PermissionController@index')->name('api.admin.permisos.index');
	Route::put('permisos/{id}', 'PermissionController@update')->name('api.admin.permisos.update');
	Route::delete('permisos/{id}', 'PermissionController@delete')->name('api.admin.permisos.delete');
	*/
});

Route::prefix('api/user')->middleware(['auth', 'verified'])->group(function() {
	Route::get('/{id}', 'UserController@show')->name('api.user.show');
});
Route::prefix('api/oficio')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'OficioController@index')->name('api.oficio.index')->middleware('permission:api.oficio.index');
	Route::post('/', 'OficioController@reservarAutomaticamente')->name('api.oficio.asignar-automaticamente')->middleware('permission:api.oficio.asignar-automaticamente');
	Route::post('/reservar', 'OficioController@reservar')->name('api.oficio.reservar')->middleware('permission:api.oficio.reservar');
	Route::post('{id}/pdf', 'OficioController@pdf')->name('api.oficio.pdf.store')->middleware('permission:api.oficio.pdf.store');
	Route::get('get/pendientes', 'OficioController@oficiosPendientes')->name('api.oficio.pendientes');
});
Route::prefix('api/dictamen')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'DictamenController@index')->name('api.dictamen.index')->middleware('permission:api.dictamen.index');
	Route::post('/', 'DictamenController@reservarAutomaticamente')->name('api.dictamen.asignar-automaticamente')->middleware('permission:api.dictamen.asignar-automaticamente');
	Route::post('/reservar', 'DictamenController@reservar')->name('api.dictamen.reservar')->middleware('permission:api.dictamen.reservar');
	Route::post('{id}/pdf', 'DictamenController@pdf')->name('api.dictamen.pdf.store')->middleware('permission:api.dictamen.pdf.store');
	Route::get('get/pendientes', 'DictamenController@dictamenesPendientes')->name('api.dictamen.pendientes');
});

Route::prefix('api/memorandum')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('api.memorandum.index')->middleware('permission:api.memorandum.index');
	Route::post('/', 'MemorandumController@reservarAutomaticamente')->name('api.memorandum.asignar-automaticamente')->middleware('permission:api.memorandum.asignar-automaticamente');
	Route::post('/reservar', 'MemorandumController@reservar')->name('api.memorandum.reservar')->middleware('permission:api.memorandum.reservar');
	Route::post('{id}/pdf', 'MemorandumController@pdf')->name('api.memorandum.pdf.store')->middleware('permission:api.memorandum.pdf.store');
	Route::get('get/pendientes', 'MemorandumController@memorandumsPendientes')->name('api.memorandum.pendientes');
});

Route::prefix('api/providencias')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'ProvidenciaController@index')->name('api.providencias.index')->middleware('permission:api.providencias.index');
	Route::post('/', 'ProvidenciaController@reservarAutomaticamente')->name('api.providencias.asignar-automaticamente')->middleware('permission:api.providencias.asignar-automaticamente');
	Route::post('/reservar', 'ProvidenciaController@reservar')->name('api.providencias.reservar')->middleware('permission:api.providencias.reservar');
	Route::post('{id}/pdf', 'ProvidenciaController@pdf')->name('api.providencias.pdf.store')->middleware('permission:api.providencias.pdf.store');
	Route::get('get/pendientes', 'ProvidenciaController@providenciasPendientes')->name('api.providencias.pendientes');
});

Route::get('/api/providencias/conteo', 'ReporteController@counteoDelAnio')->middleware(['auth', 'verified','permission:api.providencias.reporte']);

Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
