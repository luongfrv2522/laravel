<?php

Route::group(['prefix' => 'account'], function (){
	Route::get('/login', 'AccountController@login')->name('login');
	Route::post('/login', 'AccountController@postLogin')->name('loginpost');

	Route::get('/logout', 'AccountController@logout')->name('logout');
});

Route::group(['middleware'=>'myauth'],function(){

	Route::get('/', 'HomeController@welcome')->name('root');

	Route::group(['prefix' => 'home'], function (){
		Route::get('/welcome', 'HomeController@welcome')->name('welcome');
		Route::get('/index', 'HomeController@index')->name('home.index');
		Route::get('/index2', 'HomeController@index2')->name('home.index2');
	});

	Route::group(['prefix' => 'menu'], function (){
		Route::get('/index', 'MenuController@index')->name('menu.index');
	});
});