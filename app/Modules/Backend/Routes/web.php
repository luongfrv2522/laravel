<?php

// Route::get('/table',function(){
// 	Schema::create('menu_types',function($table){
// 		$table->increments('id');
// 		$table->string('name',100);
// 		//$table->timestamps();
// 	});
// 	echo "tạo bảng menu_types";
// });

Route::get('test',function(){
	return view('Backend::test');
});

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
		Route::get('/json-menu', 'MenuController@getJsonMenu')->name('menu.json-menu');
		Route::post('/add-menu', 'MenuController@postAddMenu')->name('menu.add-menu');
		Route::post('/update-menu', 'MenuController@postUpdateMenu')->name('menu.update-menu');

	});
});