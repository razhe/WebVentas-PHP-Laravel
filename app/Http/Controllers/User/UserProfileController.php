<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator, Hash, Auth, Toastr;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use Illuminate\Support\Facades\Crypt;
use App\Models\Category;
use App\Models\Region;
use App\Models\Comuna;
use App\Models\Address;
use App\Models\Order;

class UserProfileController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
        $this -> middleware('purchase.step-process');
    }
    public function getProfile()
    {
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        $direcciones = DB::table('address')
                        ->select('address.id','address.address','address.residency','comuna.name as comuna_name','region.name as region_name')
                        ->join('comuna','comuna.id', '=', 'address.id_comuna')
                        ->join('region', 'region.id', '=', 'comuna.id_region')
                        ->where('address.id_user',Auth::id()) -> get();
        $ordenes = Order::where('id_user', Auth::user() -> id) -> paginate(4);
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'direcciones' => $direcciones,
            'ordenes' => $ordenes,
        ];
        return view('User.profile', $data);
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
            $user = User::where('id', Auth::user()->id) -> first();
            $user-> name      = e($request['name']);
            $user-> last_name = e($request['last_name']);
            $user-> phone     = e($request['phone']);
            if ($user -> save()):
                Toastr::success('Usuario actualizado con Éxito', '¡Todo Listo!');
                return back();
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
                    Toastr::success('Contraseña actualizada con Éxito', '¡Todo Listo!');
                    return back();
                endif;
            else:
                Toastr::error('Su contraseña actual es incorrecta', '¡Oops...!');
                return back();
            endif;
        endif;
    }

    public function postSaveAddress(Request $request)
    {
        $rules = 
        [
            'address' => 'required',
            'residency'  => 'required|integer',
            'comuna'  => 'required|integer',
        ];
        $messages=
        [
            'address.required' => 'Debe especificar una dirección.',
            'residency.required' => 'Debe especificar una dirección.',
            'residency.integer' => 'Error al intentar guardar la residencia.',
            'comuna.required' => 'Debe especificar una comuna.',
            'comuna.integer' => 'Error al intentar guardar la comuna.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','')->with( 'typealert', 'danger');
        else:
            $disponibilidad = DB::table('address')
                            ->where('id_user', Auth::id())
                            ->count();
            if ($disponibilidad < 2) {
                if ($request['comuna'] > 0 && $request['comuna'] < 347) {
                    $direccion = new Address;
                    $direccion ->address = e($request['address']);
                    switch ($request['residency']) {
                        case 8976:
                            $direccion ->residency = 'Casa';
                            break;
                        case 4932:
                            $direccion ->residency = 'Departamento';
                            break;
                        case 3456:
                            $direccion ->residency = 'Recinto empresarial';
                            break;
                        default:
                            $direccion ->residency = 'Sin especificar';
                            break;
                    }
                    $direccion ->id_comuna = e($request['comuna']);
                    $direccion ->id_user = Auth::id();
                    if($direccion -> save()):
                        Toastr::success('Se ha agregado exitosamente su dirección', '¡Todo Listo!');
                        return back();
                    endif;
                }else {
                    Toastr::error('Campo comuna no disponible', '¡Oops...!');
                    return back();
                }
            } else {
                Toastr::warning('Solo puede agregar un máximo de dos direcciones', '¡Atención!');
                return back();
            }
        endif;
    }
    public function postRemoveAddress(Request $request)
    {
        try{
            $decrypted_id = Crypt::decryptString($request['address']);
        }catch(\Exception $exception){
            return view('errors.request-denied');
        }
        
        $direccion = Address::findOrFail($decrypted_id);
        if($direccion->delete()){
            Toastr::success('Dirección eliminada exitosamente', '¡Todo Listo!');
            return back();
        }
    }
    public function getRegiones()
    {
        $region = Region::all();
        return response($region);
    }
    public function getComunas($id)
    {
        $comunas = Comuna::where('id_region',$id) -> get();
        return response($comunas);
    }
}
