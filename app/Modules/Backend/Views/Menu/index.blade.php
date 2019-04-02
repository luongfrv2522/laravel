@extends('Backend::shared.layout')

@section('tittle','Quản trị hệ thống')

@section('styles')
	<link href="easy-tree/skin-win8/ui.easytree.css" rel="stylesheet" class="skins" type="text/css" />
@endsection

@section('body')
@php
	$menus = $_data['menus'];
	function showMenusRecursion($menus0, $parent_id = 0, $lvl = 0){
		if($menus0){
			$menus = [];
			foreach($menus0 as $key => $el){
				// Nếu là chuyên mục con thì hiển thị
				if($el->parent_id == $parent_id){
					array_push($menus, $el);
					// Xóa chuyên mục đã lặp
					unset($menus0[$key]);
				}

			} 
			
			if($menus){
				echo('<ul>');
				foreach($menus as $key => $el){
					echo '<li level="'.$lvl.'"><a href="#" onclick="return alert(\'a\')" url="'.htmlspecialchars($el->route).'">'.htmlspecialchars($el->name).'</a>';
					showMenusRecursion($menus0, $el->id, $lvl+1);
					echo '</li>';
				}	
				echo('</ul>');
			}
		}	 
	}
@endphp

<div id="demo1_menu">
    {{ showMenusRecursion($menus) }}
</div>


@endsection

@section('scripts')
<script src="easy-tree/jquery.easytree.min.js"></script>
	
<script>
	$('#demo1_menu').ul
	$('#demo1_menu').easytree();
</script>
@endsection