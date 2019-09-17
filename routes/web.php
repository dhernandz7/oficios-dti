<?php

Auth::routes([
	'verify' => true
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('index', 'HomeController@index')->name('index');

Route::prefix('api/memorandum')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
	Route::post('/', 'MemorandumController@asignarAutomaticamente')->name('memorandum.asignar-automaticamente');
	Route::post('{id}/{anio}', 'MemorandumController@asignar')->name('memorandum.update');
	Route::post('{id}/{anio}/pdf', 'MemorandumController@pdf')->name('memorandum.pdf.store');
});

Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
