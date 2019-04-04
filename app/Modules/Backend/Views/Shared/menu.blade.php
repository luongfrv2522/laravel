<?php 
use Carbon\Carbon;
use App\Menu;
use App\Commons\Configs;
$UI = '';
if(Cache::has(Configs::KEY_CACHE_MENU)){
	$UI = Cache::get(Configs::KEY_CACHE_MENU);
}else{
	$menus = Menu::where('deleted',0)->get();
	
	//region Đệ quy menu
	function showMenusRecursion1($menus, $parent_id = 0, $lvl = 0, &$UI){
		if($menus && !empty($menus)){
			$childs = [];
			foreach($menus as $key => $el){
				// Nếu là chuyên mục con thì hiển thị
				if($el->parent_id == $parent_id){
					$childs[] = $el;
					// Xóa chuyên mục đã lặp
					unset($menus[$key]);
				}

			}
			
			if($childs){
				if($lvl === 1){
					$UI.='<ul class="nav side-menu">';
				}elseif($lvl === 2){
					$UI.= '<ul class="nav child_menu">';
				}
				foreach($childs as $key => $el){
					if($lvl === 0){
						$UI.= '<div class="menu_section"><h3>'.htmlspecialchars($el->name).'</h3>';
					}elseif($lvl === 1){
						$url = ($el->route)? route(htmlspecialchars($el->route)) : '#';
						$UI.= ('<li><a href="'.$url.'"><i class="'.htmlspecialchars($el->icon_class).'"></i>'.htmlspecialchars($el->name).' <span class="fa fa-chevron-left"></span></a>');
					}elseif($lvl === 2){
						$UI.= '<li><a href="index.html">'.htmlspecialchars($el->name).'</a></li>';
					}
					showMenusRecursion1($menus, $el->id, $lvl+1, $UI);

					if($lvl === 0){
						$UI.= '</div>';
					}elseif($lvl === 1){
						$UI.= '</li>';
					}
				}

				if($lvl === 1 || $lvl === 2){
					$UI.= '</ul>';
				}
			}
		}
	}
	//endregion
	showMenusRecursion1($menus,0,0, $UI);
	$expiresAt = Carbon::now()->addDay(1);
	Cache::put(Configs::KEY_CACHE_MENU, $UI, $expiresAt);
}
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	{!! $UI !!}

</div>