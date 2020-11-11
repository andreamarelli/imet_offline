<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
        logout as original_logout; //Todo: to be removed after translation of all administration area into Laravel
        login as original_login;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override default password validation rules
     *
     * @param Request $request
     * @param bool $upgrade
     */
    protected function validateLogin(Request $request, $upgrade = false)
    {
        $validation_rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        if(App::environment('production')){
            $validation_rules['g-recaptcha-response'] = 'required'; //'required|captcha';
        }
        $messages = [];

        if($upgrade){
            $validation_rules['password'] = User::password_rule;
            $messages = [
              'password.regex' => User::password_rule_msg
            ];
            unset($validation_rules['g-recaptcha-response']);
        }

        $this->validate($request, $validation_rules, $messages);
    }

    /**
     * Check if the password is still in old OFAC system and force to user to reset it
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        // Force upgrade of users' password (old OFAC system in md5)
        $user = User::where('email', $request->email)->first();
        if($user && $user->password===md5($request->password)){
            $email = $request->email;
            $prev_password = $request->password;
            return redirect('login_upgrade')
                ->with('email', $email)
                ->with('prev_password', $prev_password);
        }

        return $this->original_login($request);
    }

    /**
     * Show user the upgrade password form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upgrade(Request $request)
    {
        $email = $request->session()->has('email')
            ? $request->session()->get('email')
            : $request->old('email');
        $prev_password = $request->session()->has('prev_password')
            ? $request->session()->get('prev_password')
            : $request->old('prev_password');
        return view('auth.upgrade', compact(['email', 'prev_password']));
    }

    /**
     * Replace existing MD5 password with Bcrypt encoding
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function md5_to_bcrypt(Request $request)
    {
        $this->validateLogin($request, true);

        $user = User::where('email', $request->email)->where('password', md5($request->prev_password))->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->regenerate();
        return redirect('login');
    }

    /**
     * Clean session on logout
     * Todo: to be removed after translation of all administration area into Laravel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        session_unset();
        return $this->original_logout($request);
    }
}
