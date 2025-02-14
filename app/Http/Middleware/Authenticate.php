<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        // Force Authentication of user 0
        if(!\Illuminate\Support\Facades\Auth::check()){
            \Illuminate\Support\Facades\Auth::loginUsingId(0, true);
        }

        parent::__construct($auth);
    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request) : ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
