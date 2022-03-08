<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use Auth,Validator,Session ;
use App\Models\Address;

class CheckoutController extends Controller
{
    public function __construct(){
        $this-> middleware('user.status');
        $this-> middleware('cart.count');
    }
    public function getCustomerInfo()
    {
        $address = '';
        if (Auth::guest()) {
            if (Session::has('user_checkout')) {
                session()->forget('user_checkout');//por seguridad reiniciar la variable
            }
            if (Session::has('guest_checkout')) {
                session()->forget('guest_checkout');//por seguridad reiniciar la variable
            }
        }else{
            $address = DB::table('address')
            ->select('address.id','address.address','address.residency','comuna.name as comuna_name','region.name as region_name')
            ->join('comuna','comuna.id', '=', 'address.id_comuna')
            ->join('region', 'region.id', '=', 'comuna.id_region')
            ->where('address.id_user',Auth::id()) -> get();
        }
        
        $data =[
            'address' => $address,
        ];
        return view('checkout.customer-information', $data);
    }
    public function getPaymentMethod()
    {
        return view('checkout.payment-method');
    }
    public function postSaveGuest(Request $request)
    {
        $rules = 
        [
            'name'      => 'required',
            'last_name' => 'required',
            'phone'     => 'required|numeric',
            'email'     => 'required|email',
            'address' => 'required',
            'residency'  => 'required|integer',
            'comuna'  => 'required|integer',
        ];
        $messages=
        [
            'name.required'      => 'Debe poner su nombre.',
            'last_name.required' => 'Debe poner su apellido.',
            'phone.required'     => 'Debe poner un numero de telefono',
            'phone.numeric'      => 'El telefono solo debe contener números',
            'email.required'     => 'Debe poner un correo electrónico.',
            'email.email'        => 'El formato de su correo electronico no es válido.',
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
            if (Session::has('user_checkout')) {
                session()->forget('user_checkout');//por seguridad reiniciar la variable
            }
            $arreglo[]=[
                'name' => $request['name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'address' => $request['address'],
                'residency' => $request['residency'],
                'comuna' => $request['comuna'],
            ];
            session(['guest_checkout' => $arreglo]);
            if (Session::has('guest_checkout')) {
                return redirect('/checkout/payment-method');
            }
        endif;
    }
    public function postSaveUser(Request $request)
    {
        $rules = 
        [
            'direccion'      => 'required',
        ];
        $messages=
        [
            'direccion.required'      => 'Debe seleccionar una dirección.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','')->with( 'typealert', 'danger');
        else:
            if (Session::has('guest_checkout')) {
                session()->forget('guest_checkout');//por seguridad reiniciar la variable
            }

            $veficacionDireccion = Address::where('id', $request['direccion'])
                                        ->where('id_user', Auth::user() -> id) -> get();
            if (!empty($veficacionDireccion)) {
                $preferences[]=[
                    'direccion_id' => $request['direccion'],
                ];
                session(['user_checkout' => $preferences]);
                if (Session::has('user_checkout')) {
                    return redirect('/checkout/payment-method');
                }
            }else{
                return back() ->with('MsgResponse','Esa dirección no éxiste o no pertenece a usted.')->with( 'typealert', 'danger');
            }

        endif;
    }
    public function postCheckoutPaymentMethod(Request $request)
    {
        if (Session::has('payment-billing')) {
            session()->forget('payment-billing');
        }

        if ($request['tipo_documento'] == 'boleta') {
            $arreglo[]=[
                'tipo_doc' => $request['tipo_documento'],
                'tipo_pago' => $request['tipo_pago'],
                'rut' => $request['rut'],
            ];
            session(['payment-billing' => $arreglo]);
        }
        if ($request['tipo_documento'] == 'factura') {
            $arreglo[]=[
                'tipo_doc' => $request['tipo_documento'],
                'tipo_pago' => $request['tipo_pago'],
                'razon_social' => $request['razon_social'],
                'rut' => $request['rut'],
                'giro' => $request['giro'],
                'ciudad' => $request['ciudad'],
                'comuna' => $request['comuna'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
            ];
            session(['payment-billing' => $arreglo]);
        }
        $data = [
            'facturacion' => session('payment-billing'),
        ];
        //return \response($data); redireccinar a resumen y pago
    }
}
