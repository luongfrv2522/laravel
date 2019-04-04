<?php
namespace App\Modules\Backend\Controllers;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller{
    private function showMenusRecursionOption($menus, $parent_id = 0, $lvl ='|--'){
        $rs = '';
        if($menus){
            foreach($menus as $key => $el){
                if($el->parent_id == $parent_id){
                    $rs .= '<option value="'.$el->id.'">'.$lvl.$el->name.'</option>';
                    unset($menus[$key]);
                    $dq = $this->showMenusRecursionOption($menus, $el->id, $lvl.'|--');
                    if($dq) $rs .= $dq;
                }
            } 
        }    
        return $rs;
    }
    public function index(Request $request){

    	$menus = Menu::where([
    		['deleted','=',0]
    	])->get();
        $rs = $this->showMenusRecursionOption($menus);
        return $this->view('menu.index',[
        	'menusOptions'=> $rs
        ]);
    }
    private function menusRecursion($menus, $parent_id){
        $rs = null;
        $childs = [];
        foreach ($menus as $key => $value) {
            if($parent_id === $value['parent_id']){
                $childs[] = $value;
                unset($menus[$key]);
            }
        }
        if($childs){
            foreach ($childs as $key => $value) {
                $item['id'] = $value['id'];
                $item['text'] = $value['name'];
                $item['state']['opened'] = true;
                $item['data']['route'] = $value['route'];
                $item['data']['icon_class'] = $value['icon_class'];
                $myChild = $this->menusRecursion($menus, $value['id']);
                if($myChild) $item['children'] = $myChild;
                else $item['icon'] = 'jstree-file';
                $rs[] = $item;
            }    
        }
        return $rs;
    }
    public function getJsonMenu(){

        $menus = Menu::where([
            ['deleted','=',0]
        ])->get();
        //#region test
        $rsCh = $this->menusRecursion($menus, 0);        
        //#endregion
        die(json_encode($rsCh));
        return response()->json($rsCh);
    }
    public function getPaging(Request $request){
        
        return $this->view('menu.getPaging');
    }

    public function postAddMenu(Request $request){
        return response()->json(["data"=>"add"]);
    }
    public function postUpdateMenu(Request $request){
        return response()->json(["data"=>"update"]);
    }
}