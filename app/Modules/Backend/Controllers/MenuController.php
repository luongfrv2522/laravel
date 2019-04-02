<?php
namespace App\Modules\Backend\Controllers;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller{
    
    public function index(Request $request){

    	$menus = Menu::where([
    		['deleted','=',0]
    	])->get();

        return $this->view('menu.index',[
        	'menus'=> $menus
        ]);
    }
    public function getPaging(Request $request){
        
        return $this->view('menu.getPaging');
    }
}