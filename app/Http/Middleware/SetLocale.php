<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Session;
use App;
use Config;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Force Language to English
        if(is_imet_environment()) {
            App::setLocale('en');
        }

        // Switch locale (set in session)
        if(Request::has('lang') &&
            (Request::input('lang')==='fr' ||
                Request::input('lang')==='en')){
            Session::put('locale', Request::input('lang'));
        }

        // Set local from session
        if(Session::has('locale') && Session::get('locale')!==null){
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
