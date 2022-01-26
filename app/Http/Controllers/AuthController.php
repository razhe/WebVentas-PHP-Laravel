<?php

namespace App\Http\Controllers;

//Peticiones desde el http
use Illuminate\Http\Request;
//Validacion de laravel, hash y auth
use Validator, Hash, Auth;
//Modelo de usuario
use \App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        $this -> middleware('guest')->except(['getLogout']);
    }

    public function getLogin(){
        return view('Auth.login');
    }

    public function getRegister(){
        return view('Auth.register');
    }
    public function postLogin(Request $request){
        $rules = 
        [
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ];
        $messages=
        [
            'email.required'    => 'Debe poner un correo electrónico.',
            'email.email'       => 'El formato de su correo electronico no es válido.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min'      => 'la contraseña debe tener minimo 8 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('authMsgError','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']], true)):
                return redirect('/');
            else:
                return back()->with('authMsgError','Correo electrónico o contraseña erronea')->with( 'typealert', 'danger');
            endif;
        endif;

    }

    public function postRegister(Request $request){
        $rules = 
        [
            'name'      => 'required',
            'last_name' => 'required',
            'phone'     => 'required|numeric',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
        $messages=
        [
            'name.required'      => 'Debe poner su nombre.',
            'last_name.required' => 'Debe poner su apellido.',
            'phone.required'     => 'Debe poner un numero de telefono',
            'phone.numeric'      => 'El telefono solo debe contener números',
            'email.required'     => 'Debe poner un correo electrónico.',
            'email.email'        => 'El formato de su correo electronico no es válido.',
            'email.unique'       => 'Este correo electrónico ya ha sido registrado.',
            'password.required'  => 'Por favor escriba una contraseña.',
            'password.min'       => 'la contraseña debe tener minimo 8 caracteres.',
            'cpassword.required' => 'Debe confirmar la contraseña.',
            'cpassword.min'      => 'la confirmación de la contraseña debe tener minimo 8 caracteres.',
            'cpassword.same'     => 'La contraseña y su confirmación deben ser identicas.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('authMsgError','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            $user = new User;
            //"e" aplica un encode a los datos que enviamos para evitar que hagan inyecciones por scripts, o vulnerabilidades en general.
            $user-> name      = e($request['name']);
            $user-> last_name = e($request['last_name']);
            $user-> email     = e($request['email']);
            $user-> phone     = e($request['phone']);
            $user-> password  = Hash::make($request['password']);
            $user-> status    = e(1);
            $user-> id_tasks  = e(1);

            if($user -> save()):
                return redirect('/login')->with('authMsgError', '¡Usuario creado con éxito! Ya puedes iniciar sesión.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getLogout(){
        Auth::logout();
        return redirect('/');
    }
}
