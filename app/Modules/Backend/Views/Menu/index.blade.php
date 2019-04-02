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
					echo '<li class="">'.htmlspecialchars($el->name);
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
	//#region Tree build
	$('#demo1_menu li').has('ul').addClass('isFolder');
	$('#demo1_menu').easytree({
		allowActivate: true,
        //data: [],
        //dataUrl: '/server/treeData',
        //dataUrlJson: '{"page":"/"}',
        disabledDnd: false,
        disableIcons: false,
        ordering: 'ordered DESC',
        slidingTime: 0,
        minOpenLevels: 2
	});
	//#endregion
	//#region Tree evet
	getMenu = function(e){
		e.preventDefault();
	}
	//
</script>
@endsection