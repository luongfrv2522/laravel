<?php
namespace App\Modules\Backend\Controllers;
use App\Menu;
use Log;
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
            if($parent_id == $value['parent_id']){
                $childs[] = $value;
                unset($menus[$key]); 
            }
        }
        if($childs){
            foreach ($childs as $key => $value) {
                $item = [];
                $item['id'] = $value['id'];
                $item['text'] = $value['name'];
                $item['state']['opened'] = true;
                $item['data']['route'] = $value['route'];
                $item['data']['icon_class'] = $value['icon_class'];
                $item['icon'] = $value['icon_class'];
                $myChild = $this->menusRecursion($menus, $value['id']);
                if($myChild != null) {
                    $item['children'] = $myChild;
                }
                $rs[] = $item;
            }    
        }
        return $rs;
    }
    public function getJsonMenu(){

        $menus = Menu::where([
            ['deleted','=',0]
        ])->get();
        //return response()->json($menus);
        //#region test
        $rs = [];
        $rs['id'] = '0';
        $rs['text'] = 'root';
        $rs['state']['opened'] = true;

        $rsCh = $this->menusRecursion($menus, 0);
        if($rsCh) $rs['children'] = $rsCh;
        //#endregion
        return response()->json($rs);
    }
    public function getPaging(Request $request){
        
        return $this->view('menu.getPaging');
    }

    public function postAdd(Request $request){
        $data = [];
        $data['error'] = '0';
        $data['message'] = 'Thêm mới danh mục thành công.';
        try {
            $request = $request->all();
            $name = $request['name'];
            $parent_id = $request['parent_id'];
            $count = Menu::whereRaw('upper(name) = ?', [strtoupper($name)])
                        ->where('parent_id', $parent_id)
                        ->where('deleted', 0)
                        ->count();
            if($count > 0){
                $menu = new Menu();
                $menu->name = $name;
                $menu->route = $request['route'];
                $menu->parent_id = $parent_id;
                $menu->icon_class = $request['icon_class'];
                $menu->save();
            }else{
                $data['error'] = '-101';
                $data['message'] = 'Danh mục đã tồn tại.';
            }
            
        } catch (Exception $e) {
            $data['error'] = '-1';
            $data['message'] = 'Thêm mới danh mục thất bại';
            //Log::error('MenuController/postAddMenu'.$e);
        }
        return response()->json($data);
    }
    public function postUpdate(Request $request){
        $data = [];
        $data['error'] = '0';
        $data['message'] = 'Chỉnh sửa danh mục thành công.';
        try {
            $request = $request->all();

            $name = $request['name'];
            $parent_id = $request['parent_id'];
            $id = $request['id'];

            $count = Menu::whereRaw('upper(name) = ?', [strtoupper($name)])
                        ->where('parent_id', $parent_id)
                        ->where('id','<>',$id)
                        ->where('deleted', 0)
                        ->count();
            if($id){
                $menu = Menu::find($id);
                $menu->name = $request['name'];
                $menu->route = $request['route'];
                $menu->parent_id = $request['parent_id'];
                $menu->icon_class = $request['icon_class'];
                $menu->save(); 
            }else{
                $data['error'] = '-101';
                $data['message'] = 'Danh mục đã tồn tại.';
            }
        } catch (Exception $e) {
            $data['error'] = '-1';
            $data['message'] = 'Chỉnh sửa danh mục thất bại';
            //Log::error('MenuController/postUpdateMenu'.$e);
        }
        return response()->json($data);
    }
    public function delete($id){
        $data = [];
        $data['error'] = '0';
        $data['message'] = 'Chỉnh sửa danh mục thành công.';
        try {
            $menu = Menu::where('id',$id)->update(['deleted'=>1]);
            //Menu::destroy($id);
        } catch (Exception $e) {
            $data['error'] = '-1';
            $data['message'] = 'Chỉnh sửa danh mục thất bại';
        }
        return response()->json($data);
    }
}