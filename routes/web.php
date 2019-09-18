<?php

Auth::routes([
	'verify' => true
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('index', 'HomeController@index')->name('index');

// Rutas de administrador
Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
	Route::get('/', 'HomeController@admin')->name('admin.index')->middleware('role:admin');
	Route::resource('permisos', 'PermissionsController')->middleware('role:admin');
	Route::get('usuarios', 'UserController@asignacionUser')->name('admin.asignacion.usuarios')->middleware('permission:admin.asignacion.usuarios');
	Route::put('updateRol/{id}', 'UserController@updateRol')->name('admin.actualizar.rol')->middleware('permission:admin.actualizar.rol');
	Route::get('getPermisos', 'PermissionsController@getPermisos')->name('admin.get.permisos')->middleware('permission:admin.get.permisos');
	Route::get('getRoles', 'RoleController@getRoles')->name('admin.get.roles')->middleware('permission:admin.get.roles');
	Route::get('getGeneroUsers', 'UserController@getGeneroUsers')->name('admin.get.generos')->middleware('permission:admin.get.generos');
	Route::post('register', 'UserController@register')->name('admin.register')->middleware('permission:admin.registrar');
	Route::get('get/users','UserController@getUsers')->name('admin.get.users')->middleware('permission:admin.get.users');
	Route::get('intrusos', 'IntrusoController@index')->name('admin.intrusos.index')->middleware('permission:admin.intrusos.index');
	Route::get('get/intrusos', 'IntrusoController@getIntrusos')->name('admin.get.intrusos')->middleware('permission::admin.get.intrusos');

	//Roles
	Route::post('roles/store', 'RoleController@store')->name('admin.roles.store')->middleware('permission:admin.roles.create');
	Route::get('roles', 'RoleController@index')->name('admin.roles.index')->middleware('permission:admin.roles.index');
	Route::get('roles/create', 'RoleController@create')->name('admin.roles.create')->middleware('permission:admin.roles.create');
	Route::put('roles/{role}', 'RoleController@update')->name('admin.roles.update')->middleware('permission:admin.roles.edit');
	Route::get('roles/{id}', 'RoleController@show')->name('admin.roles.show')->middleware('permission:admin.roles.show');
	Route::delete('roles/{role}', 'RoleController@destroy')->name('admin.roles.destroy')->middleware('permission:admin.roles.destroy');
	Route::get('roles/{id}/edit', 'RoleController@edit')->name('admin.roles.edit')->middleware('permission:admin.roles.edit');
	
	// Usuarios
	Route::put('nuevoAdministrador', 'UserController@nuevoAdministrador')->name('admin.registrar.usuario')->middleware('permission:admin.registrar.usuario');
	Route::get('users', 'UserController@index')->name('admin.users.index')->middleware('permission:admin.users.index');
	Route::put('users/{user}', 'UserController@update')->name('admin.users.update')->middleware('permission:admin.users.edit');
	Route::get('users/{user}', 'UserController@show')->name('admin.users.show')->middleware('permission:admin.users.show');
	Route::delete('users/{user}', 'UserController@destroy')->name('admin.users.destroy')->middleware('permission:admin.users.destroy');
	Route::get('users/{user}/edit', 'UserController@edit')->name('admin.users.edit')->middleware('permission:admin.users.edit');
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
