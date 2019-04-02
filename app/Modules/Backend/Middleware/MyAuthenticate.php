<?php

namespace App\Modules\Backend\Middleware;
use App\Commons\Configs;
use Closure;
use Log;
use Auth;
use Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class MyAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Log::info('MyAuthenticate - url: '.$url);
        //Log::info('MyAuthenticate/handle - check:'.(Auth::check()?1:0).Auth::user());
        if (!Auth::check()) {
            $url = $request->url();
            Session::put(Configs::URL_REDIRECT, $url);
            return redirect()->route('login');
        }
        return $next($request);
    }
}
