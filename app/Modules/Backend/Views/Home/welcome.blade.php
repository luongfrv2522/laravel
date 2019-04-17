
@extends('Backend::shared.layout')

@section('tittle','Quản lý nhóm')

@section('body')
<?php 
	use Carbon\Carbon;
	use App\Menu;
	$menus = Menu::all();
	
	/*if(Cache::has('menus')){
		$menus = Cache::get('menus');
		echo 'oke: '.$menus;
	}else{
		$menus = Menu::where('deleted',0)->get();
		$expiresAt = Carbon::now()->addDay(1);
		Cache::put('menus', $menus, $expiresAt);
		echo 'none: '.$menus;
	}*/

?>
<br>
<?php //showCategories($categories) ?>
<?php //showMenusRecursion($menus) ?>

@endsection