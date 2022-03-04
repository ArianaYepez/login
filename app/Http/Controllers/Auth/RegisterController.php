<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

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

    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }*? 

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
        return view('user.createUser');
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

            //usando eloquent evitas inyeccion sql
            'email'=>'required|email|unique:App\User,email',
            //el ejemplo del profesor estaba directamente con la tabla de la bd
           // 'email'=>'required|email|unique:users',

            //contrasenia seguir politica de contrsenia fuerte:
            //no aceptar solo letras o numeros
            //min 10 caracteres
            //minimo una mayuscula
            ////minimo un caracter especial *?etc...
            'password'=>'required|alpha_num|min:10',

            //no permitir copy paste
            'passwordconfirm'=>'required|alpha_num|min:10',
            
            //solo numeros y simbolo '+'
            'phone'=>'nullable|numeric|min:9|max:12',

            'country'=>'nullable',

            //2letras 'ES',2 numeros, 4numeros,4numeros, 2numeros,10numeros ej: ES91 2100 0418 45 0200051332
            'iban'=>'required',

            
            'aboutme'=>'nullable|numeric|min:9|max:12',
           
        ]);
        $user= new User;
        $user->name= $name;
        $user->lastname= $lastname;
        $user->dni= $dni;
        $user->email= $email;
        $user->password= $password;
        $user->phone= $phone;
        $user->country= $country;
        $user->iban= $iban;
        $user->aboutme= $aboutme;

        $user->save();
        return redirect()->route('auth.register')->with('success', 'User created correctly');

    }
}
