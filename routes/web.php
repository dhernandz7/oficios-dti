<?php

Auth::routes([
	'verify' => true,
	'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api/memorandum')->middleware(['auth', 'verified', 'only.ajax'])->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
	Route::put('/{id}', 'MemorandumController@update');
});

//Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
Route::get('/{any}', 'AppController@any')->middleware(['auth', 'verified'])->where('any', '.*');
