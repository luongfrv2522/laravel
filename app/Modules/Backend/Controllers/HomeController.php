<?php
namespace App\Modules\Backend\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
    
    public function welcome(Request $request){
        
        return $this->view(
            'home.welcome',
            [
                'message' => 'Welcome to Backend'
            ]
        );
    }
    public function index(Request $request){
        
        return $this->view(
            'home.index',
            [
                'message' => 'Welcome to index'
            ]
        );
    }
    public function index2(Request $request){
        
        return $this->view(
            'home.index2',
            [
                'message' => 'Welcome to index2'
            ]
        );
    }
}