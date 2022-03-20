<?php

namespace App\Http\Controllers;

//Peticiones desde el http
use Illuminate\Http\Request;
//Validacion de laravel, hash y auth
use Validator, Hash, Auth, Mail, Str, Session;
//Modelo de usuario
use \App\Models\User;
//Envio de correos
use App\Mail\UserSendRecover;
use Illuminate\Support\Facades\Crypt;
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
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']], false)):
                if(Auth::user()->status == 2):
                    return redirect('/logout');
                else:
                    
                    if (!empty($request['estance'])){ 
                        $decrypted_estance = Crypt::decryptString($request['estance']);
                        if($decrypted_estance == 'checkout') {
                            return redirect('/checkout/customer-information'); 
                        }
                    }
                    else{
                        return redirect('/'); 
                    }
                endif;
            else:
                return back()->with('MsgResponse','Correo electrónico o contraseña erronea')->with( 'typealert', 'danger');
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
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error')->with( 'typealert', 'danger');
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
                return redirect('/login')->with('MsgResponse', '¡Usuario creado con éxito! Ya puedes iniciar sesión!')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getLogout(){
        $status = Auth::user() -> status;
        if(Session::has('carrito')){
            session()->forget('carrito');
            session()->forget('totalCarrito');
        }
        Auth::logout();
        if ($status == 2): 
            return redirect('/login')->with('MsgResponse', 'Esta cuenta está suspendida.')->with('typealert', 'warning');
        endif;
        
        return redirect('/');
    }
    public function getRecover()
    {
        return view('Auth.recover'); 
    }
    public function postRecover(Request $request)
    {
        $rules = 
        [
            'email'    => 'required|email',
        ];
        $messages=
        [
            'email.required'    => 'Debe poner un correo electrónico.',
            'email.email'       => 'El formato de su correo electronico no es válido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            $user = User::where('email', $request['email']) -> count();
            if($user == 1):
                $user = User::where('email', $request['email']) -> first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'code'=> $code];

                $userUpdate = User::findOrFail($user->id);
                $userUpdate -> password_code =  $code;

                if($userUpdate->save());

                Mail::to($user->email)->send(new UserSendRecover($data));
                return redirect('/reset?email='.$user->email)-> with('MsgResponse','Se ha enviado un correo electrónico con la solicitud.')->with( 'typealert', 'success');
                //return view('Email.user_pass_recover', $data);
            else:
                return back() -> withErrors($validator)->with('MsgResponse','No existe ninguna cuenta asociada a este correo.')->with( 'typealert', 'danger');
            endif;
          
        endif;
    }

    public function getReset(Request $request){
        $data = ['email'=> $request['email']];
        return view('Auth.reset', $data);
    }
    public function postReset(Request $request){
        $rules = 
        [
            'email'    => 'required|email',
            'password_code'    => 'required|numeric',
        ];
        $messages=
        [
            'email.required'         => 'Debe poner un correo electrónico.',
            'email.email'            => 'El formato de su correo electronico no es válido.',
            'password_code.required' => 'Se requiere del código de verificación',
            'password_code.numeric'   => 'El código solo puede contener letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            $user = User::where('email', $request['email'])->where('password_code', $request['password_code'])->count();
            if($user == 1):
                $user = User::where('email', $request['email']) -> first();
                return redirect('/change-password')->with('email', $user->email);
            else:
                return back() -> withErrors($validator)->with('MsgResponse','El correo electrónico o código de verificación son inválidos.')->with( 'typealert', 'danger');
            endif;
        endif;
    }
    public function getChangePassword()
    {
        
        return view('Auth.change-password');
    }
    public function postChangePassword(Request $request)
    {
        $rules = 
        [
            'email'     => 'required|email',
            'password'  => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
        $messages=
        [
            'email.required'     => 'Debe poner un correo electrónico.',
            'email.email'        => 'El formato de su correo electronico no es válido.',
            'password.required'  => 'Por favor escriba una contraseña.',
            'password.min'       => 'la contraseña debe tener minimo 8 caracteres.',
            'cpassword.required' => 'Debe confirmar la contraseña.',
            'cpassword.min'      => 'la confirmación de la contraseña debe tener minimo 8 caracteres.',
            'cpassword.same'     => 'La contraseña y su confirmación deben ser identicas.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            //$user = User::where('email', $request['email']) -> first();
            $user = User::where('email', $request['email']) -> first();
            if($user -> password_code == null):
                return back() -> withErrors($validator)->with('MsgResponse','Esta cuenta no ha solicitado un cambio de contraseña.')->with( 'typealert', 'danger');
            else:
                $user -> password = Hash::make($request['password']);
                $user -> password_code = null;
                if($user -> save()):
                    session()->forget('email');
                    return redirect('/login')->with('MsgResponse', 'Contraseña actualizada éxitosamente')->with('typealert', 'success');
                endif;
            endif;
            
        endif;
    }

}
