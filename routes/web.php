<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
	'verify' => true,
	'register' => false
]);

Route::get('admin', function(){
	return view('layouts.admin');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api/memorandum')->group(function(){
	Route::get('/', 'MemorandumController@index')->name('memorandum.index');
});

Route::get('/{any}', function(){
	return view('index');
})->where('any', '.*');
