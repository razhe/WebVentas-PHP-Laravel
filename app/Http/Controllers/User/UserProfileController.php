<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator, Hash, Auth;

class UserProfileController extends Controller
{
    public function getProfile()
    {
        return view('User.profile');
    }
    public function postUpdateProfile(Request $request)
    {
        $rules = 
        [
            'name'      => 'required',
            'last_name' => 'required',
            'phone'     => 'required|numeric',
        ];
        $messages=
        [
            'name.required'      => 'Debe poner su nombre.',
            'last_name.required' => 'Debe poner su apellido.',
            'phone.required'     => 'Debe poner un numero de telefono',
            'phone.numeric'      => 'El telefono solo debe contener números',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','')->with( 'typealert', 'danger');
        else:
            if(Auth::user()->id != $request['codigo_usuario']):
                return back() -> withErrors($validator)->with('MsgResponse','Solicitud denegada.')->with( 'typealert', 'danger');
            else:
                $user = User::where('id', $request['codigo_usuario']) -> first();
                $user-> name      = e($request['name']);
                $user-> last_name = e($request['last_name']);
                $user-> phone     = e($request['phone']);
                $user-> address   = e($request['address']);
                if ($user -> save()):
                    return back()-> withErrors($validator)-> with('MsgResponse', '¡Usuario actualizado!')->with('typealert', 'success');
                endif;
            endif;
        endif;
    }
    public function postUpdatePassword(Request $request)
    {
        $rules = 
        [
            'apassword' => 'required|min:8',
            'password'  => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
        $messages=
        [
            'apassword.required' => 'Escriba su contraseña actual.',
            'apassword.min'      => 'la contraseña actual tiene mínimo 8 caracteres.',
            'password.required'  => 'Por favor escriba una contraseña.',
            'password.min'       => 'la contraseña debe tener minimo 8 caracteres.',
            'cpassword.required' => 'Debe confirmar la contraseña.',
            'cpassword.min'      => 'la confirmación de la contraseña debe tener minimo 8 caracteres.',
            'cpassword.same'     => 'La contraseña y su confirmación deben ser identicas.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','')->with( 'typealert', 'danger');
        else:
            $user = User::find(Auth::id());
            if(Hash::check($request['apassword'], $user -> password)):
                $user -> password = Hash::make($request['password']);
                if($user -> save()):
                    return back()->with('MsgResponse','Se ha actualizado su contraseña de manera exitosa.')->with( 'typealert', 'success');
                endif;
            else:
                return back()->with('MsgResponse','Su contraseña actual es incorrecta.')->with( 'typealert', 'danger');
            endif;
        endif;
    }
}
