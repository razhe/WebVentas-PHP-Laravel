<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
//Transbank
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
//modelos
use App\Models\Order;
use App\Models\Order_has_products;
use App\Models\Factura;
use App\Models\Boleta;
use App\Models\Pago;
use App\Models\Address;

Use Carbon\Carbon;
use Session, Auth;
class TransbankController extends Controller
{
    public function __construct(){
        $this-> middleware('user.status');
        $this-> middleware('cart.count');

        if(app() -> environment('production')){
            WebpayPlus::configureForProduction(
                env('WEBPAY_PLUS_COMERCE_CODE'),
                env('WEBPAY_PLUS_API_KEY')
            );
        }else{
            WebpayPlus::configureForTesting();
        }
    }
    public function postIniciarCompra(Request $request)// inicia el proceso de compra
    {
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
        $response = self::startTransbankTransaction($orden);

        //Modelos
        $pago = new Pago;
        $boleta = new Boleta;
        $factura = new Factura;

        //Pago
        if (Session::has('payment-billing')) {
            $pago -> modo_pago = 'Pending';
            $pago -> medio_pago = session('payment-billing.0.medio_pago');
            $pago -> estado_pago = 'Pending';
            $pago -> token = $response[0]['token'];
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
                    $boleta -> phone = Auth::user()->phone;      
                    $boleta -> address = $address[0] -> full_address;
                }
                if(Session::has('guest_checkout')){
                    $boleta -> client = session('guest_checkout.0.name').' '.session('guest_checkout.0.last_name');
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
                }
                if(Session::has('guest_checkout')){
                    $factura -> cliente = session('guest_checkout.0.name').' '.session('guest_checkout.0.last_name');
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
        $arregloPagoPediente[] = [
            'token' => $pago -> token,
            'id_pago' => $pago -> id,
            'id_orden'=> $orden -> id,
        ];
        session(['pagoPendiente' => $arregloPagoPediente]);

        return redirect($response[0]['url'].'?token_ws='.$response[0]['token']);
    }

    public function startTransbankTransaction($orden){ // inicia el proceso de transaccion de dinero
        $transaction = (new Transaction)->create(
            $orden -> id, //buy order
            $orden -> id_session, //session id
            $orden -> total, //buy amount
            url('/checkout/purchase-detail') //return url
        );

        $array[] = [
            'url' => $transaction->url,
            'token' => $transaction->token,
        ];
        return $array;
    }
}
