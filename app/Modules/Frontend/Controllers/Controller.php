<?php
namespace App\Modules\Frontend\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function view($view,array $params)
    {
    	return view($this->getModuleName().'::'.$view, $params);
    }
    protected function getModuleName()
    {
    	return basename(dirname(__DIR__, 1));
    }
}