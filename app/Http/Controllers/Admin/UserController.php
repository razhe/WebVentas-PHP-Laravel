<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator, Hash, DB, Toastr;

class UserController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getUsers(){
        $users = User::where('users.status', '<>', '3') -> orderBy('id', 'Asc')->get();
        $metrics = DB::select('call select_users_metrics()');
        $usersData = ['users' => $users,'metrics' => $metrics];
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
                Toastr::success('Usuario creado con Éxito', '¡Todo Listo!');
                return back();
            endif;
        endif;
    }
    public function postDeleteUser($id){
        $user = User::findOrFail($id);

        $user->status = e(3);

        if ($user -> save()) {
            Toastr::success('Usuario eliminado con Éxito', '¡Todo Listo!');
            return back();
        }
        else{
            Toastr::error('Ha ocurrido un error intentando eliminar este usuario', '¡Oops...!');
            return back();
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
            if ($request['name'] != $user->name) {
                $user->name = $request['name'];
            }
            if ($request['last_name'] != $user->last_name) {
                $user->last_name = $request['last_name'];
            }
            if ($request['email'] != $user->email) {
                $user->email = $request['email'];
            }
            if ($request['phone'] != $user->phone) {
                $user->phone = $request['phone'];
            }
            if ($request['status'] != $user->status) {
                $user->status = $request['status'];
            }
            if ($request['id_tasks'] != $user->id_tasks) {
                $user->id_tasks = $request['id_tasks'];
            }
            if($user -> save()):
                Toastr::success('Usuario modificado con Éxito', '¡Todo Listo!');
                return back();
            endif;
        endif;
    }
}
