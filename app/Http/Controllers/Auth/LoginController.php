<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function storeUser (Request $request){
      
        $email =$request->get('email');
        $password =$request->get('password');
       
        $request->validate([
           
            'email'=>'required|email|unique:App\User,email',
            'password'=>'required|alpha_num|min:10|new validacionlogin()',

           
        ]);
       

        $user->save();
        return redirect()->route('auth.register')->with('success', 'User log in  correctly');

    }
}
