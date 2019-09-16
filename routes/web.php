<?php

Auth::routes([
	'verify' => true,
	'register' => false
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('home', 'HomeController@home')->name('home');

Route::prefix('api/memorandum')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
	Route::post('/', 'MemorandumController@store')->name('memorandum.store');
	Route::post('{id}/{anio}', 'MemorandumController@asignar')->name('memorandum.update');
	Route::post('{id}/{anio}/pdf', 'MemorandumController@pdf')->name('memorandum.pdf.store');
});

Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
