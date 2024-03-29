<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use Auth,Validator,Session,Toastr;
//modelos
use App\Models\Order;
use App\Models\Order_has_products;
use App\Models\Factura;
use App\Models\Boleta;
use App\Models\Pago;
use App\Models\Address;

use Illuminate\Support\Facades\Crypt;
//Transbank
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
//Correos
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderDetails;
//carbon
Use Carbon\Carbon;

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
        //Validar las etapas de compra
        session(['estado-proceso-compra' => '1']);//Si es >= 2 que permita pasar a payment method. Crear middleware que elimine esta variable de sesion.

        return view('checkout.customer-information', $data);
    }
    public function getPaymentMethod()
    {
        if (Session::has('estado-proceso-compra')) {
            if (session('estado-proceso-compra') >= '2') {
                return view('checkout.payment-method');
            }else{
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
    public function getSummaryPayment()
    {
        if (Session::has('estado-proceso-compra')) {
            if (session('estado-proceso-compra') >= '3') {
                $arreglo = session('carrito');
                $data = [
                    'productos' => $arreglo
                ];
                session(['estado-proceso-compra' => '4']);
                return view('checkout.summary-payment', $data);
            }else{
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
    //customer info
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
                //Validar las etapas de compra
                session(['estado-proceso-compra' => '2']);
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
            try{
                $decrypted_address = Crypt::decryptString($request['direccion']);
            }catch(\Exception $exception){
                return view('errors.request-denied');
            }
            
            $veficacionDireccion = Address::where('id', $decrypted_address)
                                        ->where('id_user', Auth::user() -> id) -> get();
            if (!empty($veficacionDireccion)) {
                $preferences[]=[
                    'direccion_id' => $decrypted_address,
                ];
                session(['user_checkout' => $preferences]);
                if (Session::has('user_checkout')) {
                    //Validar las etapas de compra
                    session(['estado-proceso-compra' => '2']);
                    return redirect('/checkout/payment-method');
                }
            }else{
                return back() ->with('MsgResponse','Esa dirección no éxiste o no pertenece a usted.')->with( 'typealert', 'danger');
            }

        endif;
    }
    //Payment method
    public function postCheckoutPaymentMethod(Request $request)
    {
        if (Session::has('payment-billing')) {
            session()->forget('payment-billing');
        }

        if ($request['tipo_documento'] == 'boleta') {
            $arreglo[]=[
                'tipo_doc' => $request['tipo_documento'],
                'medio_pago' => $request['medio_pago'],
                'rut' => $request['rut'],
            ];
            session(['payment-billing' => $arreglo]);
        }elseif ($request['tipo_documento'] == 'factura') {
            $arreglo[]=[
                'tipo_doc' => $request['tipo_documento'],
                'medio_pago' => $request['medio_pago'],
                'razon_social' => $request['razon_social'],
                'rut' => $request['rut'],
                'giro' => $request['giro'],
                'ciudad' => $request['ciudad'],
                'comuna' => $request['comuna'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
            ];
            session(['payment-billing' => $arreglo]);
        }else{
            Toastr::error('Error con el documento de facturación.', 'Oops...');
            return back();
        }
        $data = [
            'facturacion' => session('payment-billing'),
        ];
        //Validar las etapas de compra
        session(['estado-proceso-compra' => '3']);
        $nextRequest = url('/checkout/summary-payment');
        
        return response($nextRequest);
    }
    //Copra con transferencia bancaria
    public function postBankTransfer(){
        if (session('estado-proceso-compra') >= '4') {
            if(Session::has('carrito')){
                //orden
                $orden = new Order;

                $orden -> total_neto = session('totalCarrito')[0]['total_neto'];
                $orden -> iva = session('totalCarrito')[0]['iva'];
                $orden -> total = session('totalCarrito')[0]['total'];
                $orden -> fecha = Carbon::now()->toDateString();
                $orden -> id_session = Session::getId();
                $orden -> status = 1;
                if (!Auth::guest()) {
                    $orden -> id_user = Auth::id();
                }
                $orden -> save();

                //Modelos
                $pago = new Pago;
                $boleta = new Boleta;
                $factura = new Factura;

                //Pago
                if (Session::has('payment-billing')) {
                    $pago -> modo_pago = 'Transferencia';
                    $pago -> medio_pago = session('payment-billing.0.medio_pago');
                    $pago -> estado_pago = 'Pending';
                    $pago -> token = 'Solo disponible para transbank.';
                    $pago -> save();
                }
                //Orden
                $orden -> order_number = strval(rand(0,9999)).strval($orden->id). strval(rand(0,9999));
                $orden -> id_pago = $pago -> id;

                //Boleta o factura
                if (Session::has('payment-billing')) {
                    if (session('payment-billing.0.tipo_doc') == 'boleta') {
                        //boleta
                        $boleta -> rut = session('payment-billing.0.rut');
                        if(Session::has('user_checkout')){
                            $address = DB::select('CALL select_full_addres_by_id(?)', array(session('user_checkout.0.direccion_id')));
            
                            $boleta -> client = Auth::user()->name.' '.Auth::user()->last_name;
                            $boleta -> email = Auth::user()->email;
                            $boleta -> phone = Auth::user()->phone;      
                            $boleta -> address = $address[0] -> full_address;
                        }
                        if(Session::has('guest_checkout')){
                            $boleta -> client = session('guest_checkout.0.name').' '.session('guest_checkout.0.last_name');
                            $boleta -> email = session('guest_checkout.0.email');
                            $boleta -> phone = session('guest_checkout.0.phone');
                            $boleta -> address = session('guest_checkout.0.address').' ('.session('guest_checkout.0.residency').'), '.session('guest_checkout.0.comuna').'.';
                        }
                        $boleta->save();
                        //Order
                        $orden -> id_boleta = $boleta -> id;
                    }
                    if (session('payment-billing.0.tipo_doc') == 'factura') {
                        //factura
                        $factura -> rut = session('payment-billing.0.rut');
                        $factura -> razon_social = session('payment-billing.0.razon_social');
                        $factura -> giro = session('payment-billing.0.giro');
                        $factura -> direccion = session('payment-billing.0.direccion');
                        $factura -> ciudad = session('payment-billing.0.ciudad');
                        $factura -> comuna = session('payment-billing.0.comuna');
                        $factura -> telefono = session('payment-billing.0.telefono');
                        if(Session::has('user_checkout')){
                            $factura -> cliente = Auth::user()->name.' '.Auth::user()->last_name;
                            $factura -> email = Auth::user()->email;
                        }
                        if(Session::has('guest_checkout')){
                            $factura -> cliente = session('guest_checkout.0.name').' '.session('guest_checkout.0.last_name');
                            $factura -> email = session('guest_checkout.0.email');
                        }
                        $factura -> save();
                        //Order
                        $orden -> id_factura = $factura -> id;
                    }
                }
                //Order Has Products
                if (Session::has('carrito')) {
                    $arreglo = session('carrito');
                    for ($i=0; $i < sizeof($arreglo); $i++) {
                        $orderHasProducts = new Order_has_products;
                        $orderHasProducts -> quantity = $arreglo[$i]['cantidad'];
                        $orderHasProducts -> price = $arreglo[$i]['precio'];
                        $orderHasProducts -> total_price = $arreglo[$i]['subtotal'];
                        $orderHasProducts -> product_name = $arreglo[$i]['nombre'];
                        $orderHasProducts -> id_product = Crypt::decryptString($arreglo[$i]['id']);
                        $orderHasProducts -> id_order = $orden -> id;
                        $orderHasProducts -> save();
                    }
                }
                //Orden
                $orden -> save();
                $data = [
                    'response' => 'OK',
                    'numero_orden' => $orden -> order_number,
                    'detalles_pago' => session('payment-billing'),
                    'productos' => session('carrito'),
                    'totales' => session('totalCarrito'),
                ];
                
                session()->forget('carrito');
                session()->forget('totalCarrito');
                session()->forget('estado-proceso-compra');

                return view('checkout.purchase-detail', $data);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
    //Detalle de la compra
    public function getPurchaseDetail(Request $request)
    {
        if (Session::has('pagoPendiente')) {
            if($request['token_ws']):
                $pago = Pago::where('id', session('pagoPendiente.0.id_pago'))
                            -> where('token', session('pagoPendiente.0.token'))
                            -> first();
                $token_match = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
                if (!$token_match) {
                    // Revisa más detalles en Revisar más detalles más arriba en los distintos flujos y ejemplos de código de esto en https://github.com/TransbankDevelopers/transbank-sdk-php/examples/webpay-plus/index.php
                    die ('No es un flujo de pago normal.');  
                }else{
                    $response = (new Transaction)->commit($request['token_ws']);
                    if ($response->status == 'AUTHORIZED' and $response -> responseCode == 0) {
                        $pago -> modo_pago = $this->validatePaymentType($response -> paymentTypeCode);
                        $pago -> estado_pago = $response -> status;

                        if($pago -> save()){
                            $orden = Order::where('id', session('pagoPendiente.0.id_orden')) -> first();
                            $orden -> status = 2;
                            $orden -> save();
                        }

                        $data = [
                            'response' => 'OK',
                            'detalles_pago' => session('payment-billing'),
                            'productos' => session('carrito'),
                            'totales' => session('totalCarrito'),
                        ];

                        if (Session::has('guest_checkout')) {
                            Mail::to(session('guest_checkout.0.email'))->send(new SendOrderDetails($data));
                            session()->forget('guest_checkout');
                        }
                        if(Session::has('user_checkout')){
                            Mail::to(Auth::user()->email)->send(new SendOrderDetails($data));
                            session()->forget('user_checkout');
                        }

                        session()->forget('pagoPendiente');
                        if(Session::has('carrito')){
                            session()->forget('carrito');
                            session()->forget('totalCarrito');
                        }
                        session()->forget('estado-proceso-compra');
                        return view('checkout.purchase-detail', $data);
                    }else{
                        $pago -> estado_pago = $response -> status;
                        $pago -> modo_pago = $this->validatePaymentType($response -> paymentTypeCode);
                        $pago -> save();
                        $data = [
                            'response' => 'ERROR'
                        ];
                        session()->forget('pagoPendiente');
                        if(Session::has('carrito')){
                            session()->forget('carrito');
                            session()->forget('totalCarrito');
                        }
                        session()->forget('estado-proceso-compra');
                        return view('checkout.purchase-detail', $data);
                    }   
                }
            else:
                return redirect('/');
            endif;
        }else{
            return redirect('/');
        }
    }

    public function validatePaymentType($valor){ // Valida el medio de pago
        switch ($valor) {
            case 'VN':
                return 'Crédito, pago en 1 cuota';
                break;
            case 'S2':
                return 'Crédito, pago en 2 cuotas iguales sin interés';
                break;
            case 'SI':
                return 'Crédito, pago en 3 cuotas iguales sin interés';
                break;
            case 'NC':
                return 'Crédito, pago entre 2 y 12 cuotas iguales sin interés';
                break;
            case 'VC':
                return 'Crédito, pago entre 2 y 48, interes a elección, pago diferido entre 1 a 3 meses a elección';
                break;
            case 'VD':
                return 'Contado, tarjeta de débito Redcompra';
                break;
            case 'VP':
                return 'Contado, tarjeta de débito Redcompra (venta prepago)';
                break;
        }
    }
}
