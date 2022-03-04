<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
  
  
     /* protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }*/
    public function createUser(){
        return view('auth.register');
    }

    public function storeUser (Request $request){
        $name =$request->get('name');
        $lastname =$request->get('lastname');
        $dni =$request->get('dni');
        $email =$request->get('email');
        $password =$request->get('password');
        $passwordconfirm =$request->get('passwordconfirm');
        $phone =$request->get('phone');
        $country =$request->get('country');
        $iban =$request->get('iban');
        $aboutme =$request->get('aboutme');

        $request->validate([
           
            'name'=>'required|min:2|max:20|alpha',
            'lastname'=>'required|min:2|max:40|alpha',
            // 8 numeros seguidos de una letra: 12345678A
            'dni'=>'required|min:2|max:20|alpha_num',
            'email'=>'required|email|unique:App\User,email',

            //contrasenia seguir politica de contrsenia fuerte
            'password'=>'required|',
            //no permitir copy paste
            'passwordconfirm'=>'required|',
            
            //solo numeros y simbolo '+'
            'phone'=>'nullable|numeric|min:9|max:12',

            //2letras 'ES',2 numeros, 4numeros,4numeros, 2numeros,10numeros ej: ES91 2100 0418 45 0200051332
            'iban'=>'required',

            'country'=>'nullable',
            'aboutme'=>'nullable|numeric|min:9|max:12',
           
        ]);
        $user= new User;
        $user->name= $name;
        $user->save();
        return redirect()->route('home')->with('success', 'User created correctly');

    }
}
