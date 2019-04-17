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

Route::get('model/{fk_item_id?}/{fk_type_id?}',function($fk_item_id=null, $fk_type_id=null){
	$msg = 'Không vấn đề.';
	if ($fk_item_id) {
		$item = App\Item::find($fk_item_id);
		if($fk_type_id){
			$types = $item->types();
			if(!$types->find($fk_type_id)){
				$types->attach($fk_type_id);
			}else{
				$types->detach($fk_type_id);
			}
			
		}
		return json_encode($item->types->all());
	}
	$model = App\Item::all();
	return json_encode($model);
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
		Route::post('/add', 'MenuController@postAdd')->name('menu.add');
		Route::post('/update', 'MenuController@postUpdate')->name('menu.update');
		Route::get('/delete/{id}', 'MenuController@delete')->name('menu.delete');
	});
});