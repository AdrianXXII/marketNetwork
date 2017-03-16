<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
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
        return Validator::make($data, [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Sie müssen einen Namen angeben!',
            'name.max' => 'Der Name ist zu lang',
            'email.required' => 'Sie müssen eine E-Mail Adresse angeben!',
            'email.unique' => 'Die E-Mail Adresse kann nicht gebraucht werden',
            'email.email' => 'Die E-Mail Adresse muss eine valide E-Mail Adresse sein',
            'email.max' => 'Die E-Mail Adresse ist zu lang',
            'password.required' => 'Sie müssen ein Passwort angeben',
            'password.confirmed' => 'Die Passwörter stimmen nicht überein',
            'password.min' => 'Das Passwort muss mindestens Zeichen lang sein',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
