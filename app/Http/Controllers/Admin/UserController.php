<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator, Hash;

class UserController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getUsers(){
        $users = User::where('users.status', '<>', '3') -> orderBy('id', 'Asc')->get();
        $usersData = ['users' => $users];
        return view('Admin.users', $usersData);
    }
    public function postAddUser(Request $request){
        $rules = 
        [
            'name'      => 'required',
            'last_name' => 'required',
            'phone'     => 'required|numeric',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
            'status'    => 'required',
            'id_tasks'  => 'required'
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
            'status.required'    => 'Debe asignarle un estado al usuario.',
            'id_tasks.required'  => 'Debe agregarle la tarea al usuario.',

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
            $user-> status    = e($request['status']);
            $user-> id_tasks  = e($request['id_tasks']);

            if($user -> save()):
                return back() -> withErrors($validator)-> with('MsgResponse', '¡El usuario se ha creado exitosamente!')->with('typealert', 'success');
            endif;
        endif;
    }
    public function postDeleteUser($id){
        $user = User::findOrFail($id);

        $user->status = e(3);

        if ($user -> save()) {
            return back() -> with('MsgResponse','Usuario eliminado Exitosamente!')->with( 'typealert', 'success');
        }
        else{
            return back() -> with('MsgResponse','Se ha producido un error al intentar borrar este usuario')->with( 'typealert', 'danger');
        }
    }
    public function getFindUser($id){
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    public function postEditUser(Request $request){
        $rules = 
        [
            'name'      => 'required',
            'last_name' => 'required',
            'phone'     => 'required|numeric',
            'email'     => 'required|email',
            'status'    => 'required',
            'id_tasks'  => 'required'
        ];
        $messages=
        [
            'name.required'      => 'Debe poner su nombre.',
            'last_name.required' => 'Debe poner su apellido.',
            'phone.required'     => 'Debe poner un numero de telefono',
            'phone.numeric'      => 'El telefono solo debe contener números',
            'email.required'     => 'Debe poner un correo electrónico.',
            'email.email'        => 'El formato de su correo electronico no es válido.',
            'status.required'    => 'Debe asignarle un estado al usuario.',
            'id_tasks.required'  => 'Debe agregarle la tarea al usuario.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error')->with( 'typealert', 'danger');
        else:
            $user = User::findOrFail($request['id']);
            //"e" aplica un encode a los datos que enviamos para evitar que hagan inyecciones por scripts, o vulnerabilidades en general.
            $user-> name      = e($request['name']);
            $user-> last_name = e($request['last_name']);
            $user-> email     = e($request['email']);
            $user-> phone     = e($request['phone']);
            $user-> status    = e($request['status']);
            $user-> id_tasks  = e($request['id_tasks']);

            if($user -> save()):
                return back() -> withErrors($validator)-> with('MsgResponse', '¡El usuario se ha modificado exitosamente!')->with('typealert', 'success');
            endif;
        endif;
    }
}
