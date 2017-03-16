<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $rules;
    protected $messages;
    protected $failedLoginMessage;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->rules = [$this->username() => 'required', 'password' => 'required'];
        $this->messages = [
            $this->username().'.required' => 'Sie müssen eine E-Mail Adresse angeben!',
            'password.required' => 'Sie müssen ein Passwort angeben!',
        ];
        $this->failedLoginMessage = 'Die Angaben stimmen nicht';
    }
}
