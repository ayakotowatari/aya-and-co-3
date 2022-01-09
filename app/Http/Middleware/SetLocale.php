<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Session::has('applocale')){
            // app()->setLocale(Session::get('applocale'));
            app()->setLocale(session('applocale'));
        }else{
            app()->setLocale(Config::get('app.fallback_locale'));
        }

        // DD(App::getLocale());
        
        return $next($request);
    }
}
