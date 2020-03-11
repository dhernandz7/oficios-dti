<?php

Auth::routes([
	'verify' => true
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('index', 'HomeController@index')->name('index');

Route::prefix('api')->middleware(['auth', 'verified', 'only.ajax'])->group(function() {
	Route::get('usuarios', 'AdminController@index')->name('api.admin.usuarios.index');
	Route::get('usuarios/{id}', 'AdminController@update')->name('api.admin.usuarios.update');
	Route::delete('usuarios/{id}', 'AdminController@destroy')->name('api.admin.usuarios.destroy');
	Route::put('usuarios/{id}/rol', 'AdminController@role')->name('api.admin.usuarios.rol.update');

	Route::get('roles', 'RoleController@index')->name('api.admin.roles.index');
	Route::put('roles/{id}', 'RoleController@update')->name('api.admin.roles.update');
	Route::delete('roles/{id}', 'RoleController@delete')->name('api.admin.roles.delete');

	Route::get('permisos', 'PermissionController@index')->name('api.admin.permisos.index');
	Route::put('permisos/{id}', 'PermissionController@update')->name('api.admin.permisos.update');
	Route::delete('permisos/{id}', 'PermissionController@delete')->name('api.admin.permisos.delete');
});

Route::prefix('api/user')->middleware(['auth', 'verified', 'only.ajax'])->group(function() {
	Route::get('/{id}', 'UserController@show')->name('api.user.show');
});
Route::prefix('api/oficio')->middleware(['auth', 'verified', 'only.ajax'])->group(function(){
	Route::get('/', 'OficioController@index')->name('api.oficio.index')->middleware('permission:api.oficio.index');
	Route::post('/', 'OficioController@reservarAutomaticamente')->name('api.oficio.asignar-automaticamente')->middleware('permission:api.oficio.asignar-automaticamente');
	Route::post('/reservar', 'OficioController@reservar')->name('api.oficio.reservar')->middleware('permission:api.oficio.reservar');
	Route::post('{id}/pdf', 'OficioController@pdf')->name('api.oficio.pdf.store')->middleware('permission:api.oficio.pdf.store');
	Route::get('get/pendientes', 'OficioController@oficiosPendientes')->name('api.oficio.pendientes');
});
Route::prefix('api/dictamen')->middleware(['auth', 'verified', 'only.ajax'])->group(function(){
	Route::get('/', 'DictamenController@index')->name('api.dictamen.index')->middleware('permission:api.dictamen.index');
	Route::post('/', 'DictamenController@reservarAutomaticamente')->name('api.dictamen.asignar-automaticamente')->middleware('permission:api.dictamen.asignar-automaticamente');
	Route::post('/reservar', 'DictamenController@reservar')->name('api.dictamen.reservar')->middleware('permission:api.dictamen.reservar');
	Route::post('{id}/pdf', 'DictamenController@pdf')->name('api.dictamen.pdf.store')->middleware('permission:api.dictamen.pdf.store');
	Route::get('get/pendientes', 'DictamenController@dictamenesPendientes')->name('api.dictamen.pendientes');
});
Route::prefix('api/memorandum')->middleware(['auth', 'verified', 'only.ajax'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('api.memorandum.index')->middleware('permission:api.memorandum.index');
	Route::post('/', 'MemorandumController@reservarAutomaticamente')->name('api.memorandum.asignar-automaticamente')->middleware('permission:api.memorandum.asignar-automaticamente');
	Route::post('/reservar', 'MemorandumController@reservar')->name('api.memorandum.reservar')->middleware('permission:api.memorandum.reservar');
	Route::post('{id}/pdf', 'MemorandumController@pdf')->name('api.memorandum.pdf.store')->middleware('permission:api.memorandum.pdf.store');
	Route::get('get/pendientes', 'MemorandumController@memorandumsPendientes')->name('api.memorandum.pendientes');
});

Route::prefix('api/providencia')->middleware(['auth', 'verified', 'only.ajax'])->group(function(){
	Route::get('/', 'ProvidenciaController@index')->name('api.providencia.index')->middleware('permission:api.providencia.index');
	Route::post('/', 'ProvidenciaController@reservarAutomaticamente')->name('api.providencia.asignar-automaticamente')->middleware('permission:api.providencia.asignar-automaticamente');
	Route::post('/reservar', 'ProvidenciaController@reservar')->name('api.providencia.reservar')->middleware('permission:api.providencia.reservar');
	Route::post('{id}/pdf', 'ProvidenciaController@pdf')->name('api.providencia.pdf.store')->middleware('permission:api.providencia.pdf.store');
	Route::get('get/pendientes', 'ProvidenciaController@providenciasPendientes')->name('api.providencia.pendientes');
});

Route::prefix('api/memorial')->middleware(['auth', 'verified', 'only.ajax'])->group(function() {
	Route::get('/', 'MemorialController@index')->name('api.memorial.index')->middleware('permission:api.memorial.index');
	Route::post('/', 'MemorialController@store')->name('api.memorial.store')->middleware('permission:api.memorial.store');
	Route::put('/{id}', 'MemorialController@update')->name('api.memorial.update')->middleware('permission:api.memorial.update');
});

Route::prefix('api/procesos-contenciosos-administrativos')->middleware(['auth', 'verified', 'only.ajax'])->group(function() {
	Route::get('/', 'ProcesoContenciosoAdministrativoController@index')->name('api.procesos.contenciosos.administrativos.index');
	Route::post('/', 'ProcesoContenciosoAdministrativoController@store')->name('api.procesos.contenciosos.administrativos.store');
	Route::put('/{id}', 'ProcesoContenciosoAdministrativoController@update')->name('api.procesos.contenciosos.administrativos.update');
});

Route::prefix('api/catalogos')->middleware(['auth', 'verified'])->group(function() {
	Route::get('/tipos-de-procesos', 'CatalogosController@tiposDeProcesos');
	Route::get('/plazos-de-audiencias', 'CatalogosController@plazosDeAudiencias');
});


Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
//Route::get('/{any}', 'AppController@any')->where('any', '.*');
