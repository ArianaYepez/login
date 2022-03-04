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
        $this->middleware('auth');
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
           /* 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],*/

            'name'=>'required|min:2|max:20|alpha',
            'lastname'=>'required|min:2|max:40|alpha',
            'dni'=>'required|min:2|max:20|new dniRule',

            //usando eloquent evitas inyeccion sql
            'email'=>'required|email|unique:App\User,email',
            //el ejemplo del profesor estaba directamente con la tabla de la bd
           // 'email'=>'required|email|unique:users',

           
            //minimo una mayuscula
            ////minimo un caracter especial *?etc...
            'password'=>'required|alpha_num|min:10|same:passwordconfirm|new AlphaNumericSymbol',

          
            'passwordconfirm'=>'required|alpha_num|min:10|new AlphaNumericSymbol',
            'phone'=>'nullable|numeric|min:9|max:12|new phoneRule',
            'country'=>'nullable',
            'iban'=>'required|new ibanRule',
            'aboutme'=>'nullable|numeric|min:9|max:12',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            'lastname'=> $data['lastname'],
            'dni'=> $data['dni'],
            'phone'=> $data['phone'],
            'country'=> $data['country'],
            'iban'=> $data['iban'],
            'aboutme'=> $data ['aboutme'],
    
        ]);
        return redirect()->route('auth.register')->with('success', 'User created correctly');
    }
   //EJEMPLO DEL PROFESOR
   /* public function createUser(){
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
            'dni'=>'required|min:2|max:20|new dniRule()',

            //usando eloquent evitas inyeccion sql
            'email'=>'required|email|unique:App\User,email',
            //el ejemplo del profesor estaba directamente con la tabla de la bd
           // 'email'=>'required|email|unique:users',

           
            //minimo una mayuscula
            ////minimo un caracter especial *?etc...
            'password'=>'required|alpha_num|min:10|same:passwordconfirm|new AlphaNumericSymbol()',

          
            'passwordconfirm'=>'required|alpha_num|min:10',
            'phone'=>'nullable|numeric|min:9|max:12|new phoneRule()',
            'country'=>'nullable',
            'iban'=>'required|new ibanRule()',
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

    }*/
}
