<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//Transbank
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
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
        return 'hola soy controlador transbank';
    }
}
