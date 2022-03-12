<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//Transbank
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
//modelos
use App\Models\Order;
Use Carbon\Carbon;
use Session, Auth;
class TransbankController extends Controller
{
    public function __construct(){
        $this-> middleware('user.status');

        if(app() -> environment('production')){
            WebpayPlus::configureForProduction(
                env('WEBPAY_PLUS_COMERCE_CODE'),
                env('WEBPAY_PLUS_API_KEY')
            );
        }else{
            WebpayPlus::configureForTesting();
        }
    }
    public function postIniciarCompra(Request $request)
    {
        $sesionId = Session::getId();
        $orden = new Order;

        $date = Carbon::now();
        $date->toArray();

        $orden -> total_neto = session('totalCarrito')[0]['total_neto'];
        $orden -> iva = session('totalCarrito')[0]['iva'];
        $orden -> total = session('totalCarrito')[0]['total'];
        $orden -> fecha = Carbon::now()->toDateString();
        $orden -> id_session = $sesionId;
        $orden -> status = 1;
        if (!Auth::guest()) {
            $orden -> id_user = Auth::id();
        }
        return $orden;
    }
}
