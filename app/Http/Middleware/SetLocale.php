<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next, $guard = null)
    {
        // Switch locale (set in session)
        if (Request::has('lang') && in_array(Request::input('lang'), ['fr', 'en', 'sp', 'pt'])) {
            Session::put('locale', Request::input('lang'));
        }

        // Set local from session
        if (Session::has('locale') && Session::get('locale') !== null) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
