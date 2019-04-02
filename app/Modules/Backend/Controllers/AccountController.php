<?php
namespace App\Modules\Backend\Controllers;
use App\Commons\Configs;
use Session;
use Log;
use Auth;
use Hash;
use Validator;
use Illuminate\Http\Request;

class AccountController extends Controller{


    public function login(){
		$url = Session::get(Configs::URL_REDIRECT)??route('root');
		//Log::info('AccountController/login - check:'.(Auth::check()?1:0).'- user: '.Auth::user());
        if(Auth::check()){
            //Log::info('AccountController/login - url:'.$url);
            return redirect($url);
        }
    	//Log::info('AccountController/login - url: '.$url);
        return $this->view('account.login');	
    }

    public function postLogin(Request $request){
    	$url = Session::get(Configs::URL_REDIRECT)??route('root');
    	if(Auth::check()){
    		return redirect($url);
    	}
    	//Log::info('AccountController/postLogin - url: '.$url.' \n '.$request['username']);
    	$username = trim($request['username']);
    	$password = trim($request['password']);
    	$remember_me = $request['remember_me'];
		//Log::info('AccountController/postLogin - username: '.$username.' - password: '.$password.' - remember_me: '.$remember_me);
        
    	//region Validation
    	$validator = Validator::make($request->all(),
            [
                'username' => array('bail','required','min:4','max:50','regex:/^[a-zA-Z0-9_]*$/'),
                'password' => 'bail|required|min:4|max:50'
            ],
            [
                'username.required' => 'Tên đăng nhập không được để trống',
                'username.min' => 'Tên đăng nhập quá ngắn',
                'username.max' => 'Tên đăng nhập quá dài',
                'username.regex' => 'Tên đăng nhập chứa ký tự không hợp lệ',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu quá ngắn',
                'password.max' => 'Mật khẩu quá dài'
            ]
        );
    	//endregion

        $validator->after(function($validator) use ($username, $password,$remember_me){
            //Log::info('error:'.$username.'-'.$password);
            $flag = Auth::attempt([
                'username' => $username,
                'password' => $password
            ], $remember_me);
            if(!$flag){
                Log::info('fail');
                $validator->errors()->add('password', 'Tài khoản hoặc mật khẩu không chính xác');
            }
            
        });
    	//region Login thành công
    	if($validator->passes()){
            return redirect($url);
        }
        //endregion        
        return $this->view('account.login')->withErrors($validator);
    }

    public function register(){
        Auth::logout();
        return redirect()->route('root');
    }
    public function postRegister(){
        Auth::logout();
        return redirect()->route('root');
    }

    public function logout(){
    	Auth::logout();
        Session::flush();
        return redirect()->route('root');
    }
}