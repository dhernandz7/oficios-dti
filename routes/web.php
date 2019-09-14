<?php

Auth::routes([
	'verify' => true,
	'register' => false
]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('home', 'HomeController@home')->name('home');

Route::prefix('api/memorandum')->middleware(['auth', 'verified'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
	Route::put('/{id}/{anio}', 'MemorandumController@asignar')->name('memorandum.update');
});

Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
