<?php

namespace App\Http\Controllers\Auth;

use App\Models\Person\Person;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'country' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => User::password_rule
        ];
        if(App::environment('production')){
            $rules['g-recaptcha-response'] = 'required'; //'required|captcha';
        }
        $messages = [
            'password.regex' =>  User::password_rule_msg
        ];

        return Validator::make($data,
            $rules,
            $messages
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $person = Person::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'email' => $data['email'],
        ]);

        return User::create([
            'id' => $person->getKey(),
            'person_id' => $person->getKey(),
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
