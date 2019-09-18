<?php

Auth::routes([
	'verify' => true
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('index', 'HomeController@index')->name('index');

Route::prefix('api/user')->middleware(['auth', 'verified'])->group(function() {
	Route::get('/{id}', 'UserController@show')->name('api.user.show');
});
Route::prefix('api/memorandum')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
	Route::post('/', 'MemorandumController@asignarAutomaticamente')->name('api.memorandum.asignar-automaticamente');
	Route::post('{id}/{anio}', 'MemorandumController@asignar')->name('api.memorandum.update');
	Route::post('{id}/{anio}/pdf', 'MemorandumController@pdf')->name('api.memorandum.pdf.store');
});

Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
