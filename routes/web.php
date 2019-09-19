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

	Route::get('roles', 'RoleController@index')->name('api.admin.roles.index');
	Route::put('roles/{id}', 'RoleController@update')->name('api.admin.roles.update');
	Route::delete('roles/{id}', 'RoleController@delete')->name('api.admin.roles.delete');

	Route::get('permisos', 'PermissionController@index')->name('api.admin.permisos.index');
	Route::put('permisos/{id}', 'PermissionController@update')->name('api.admin.permisos.update');
	Route::delete('permisos/{id}', 'PermissionController@delete')->name('api.admin.permisos.delete');
});

Route::prefix('api/user')->middleware(['auth', 'verified'])->group(function() {
	Route::get('/{id}', 'UserController@show')->name('api.user.show');
});
Route::prefix('api/oficio')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'OficioController@index')->name('oficio.index');
	Route::post('/', 'OficioController@reservarAutomaticamente')->name('api.oficio.asignar-automaticamente');
	Route::post('/reservar', 'OficioController@reservar')->name('api.oficio.reservar');
	Route::post('{id}/pdf', 'OficioController@pdf')->name('api.oficio.pdf.store');
});
Route::prefix('api/dictamen')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'DictamenController@index')->name('dictamen.index');
	Route::post('/', 'DictamenController@reservarAutomaticamente')->name('api.dictamen.asignar-automaticamente');
	Route::post('/reservar', 'DictamenController@reservar')->name('api.dictamen.reservar');
	Route::post('{id}/pdf', 'DictamenController@pdf')->name('api.dictamen.pdf.store');
});
Route::prefix('api/memorandum')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
	Route::post('/', 'MemorandumController@reservarAutomaticamente')->name('api.memorandum.asignar-automaticamente');
	Route::post('/reservar', 'MemorandumController@reservar')->name('api.memorandum.reservar');
	Route::post('{id}/pdf', 'MemorandumController@pdf')->name('api.memorandum.pdf.store');
});

Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
