<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use Auth;

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
}
