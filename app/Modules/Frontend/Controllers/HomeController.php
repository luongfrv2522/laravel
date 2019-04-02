<?php
namespace App\Modules\Frontend\Controllers;

use Illuminate\Http\Request;
class HomeController extends Controller{
    
    // public function __construct(){
    //     parent::__construct();
    // }

    public function welcome(Request $request){
        
        return $this->view(
            'home.welcome',
            [
                'message' => 'Welcome to Frontend '
            ]
        );
    }
}