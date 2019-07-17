<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // if (Auth::check() && Auth::user()->role->id == 1)
        // {
        //     $this->redirectTo = route('admin.dashboard');
        // } 
        // elseif (Auth::check() && Auth::user()->role->id == 2) 
        // {
        //     $this->redirectTo = route('author.dashboard');
        // } 
        // if (Auth::check() && Auth::user()->role->id == 3) 
        // {
        //     $this->redirectTo = route('user.account.user');
        // }
        if (Auth::check() && Auth::user()->role->id == 1)
        {
            $this->redirectTo = route('admin.dashboard');
        } else{
            $this->redirectTo = route('author.dashboard');
        } if (Auth::check() && Auth::user()->role->id == 3) {
            $this->redirectTo = route('account.user');
        }
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
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'role_id'   => 3,
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'username'  => str_slug($data['username']),
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        Profile::create([
            'user_id'       => $user->id,
            // 'profile_pics'  => '',
            'facebook'      => 'https://facebook.com/',
            'instagram'     => 'https://instagram.com/',
            'twitter'       => 'https://twitter.com/',
            'youtube'       => 'https://youtube.com/',
            'whatsapp'      => 'https://api.whatsapp.com/send?phone=',
        ]);

        return $user;
    }
}
