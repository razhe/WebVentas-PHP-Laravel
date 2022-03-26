<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Crypt;

class SalesController extends Controller
{
    public function __construct()
    {
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getSales()
    {
        $ventas = Order::orderBy('fecha', 'DESC')->get();
        $data = [
            'ventas' => $ventas
        ];
        return view('Admin.sales', $data);
    }
    public function getSaleDetail(Request $request)
    {
        if (!empty($request['cv'])) {
            try{
                $decrypted_id = Crypt::decryptString($request['cv']);
            }catch(\Exception $exception){
                return view('errors.request-denied');
            }
            $venta = Order::where('id', $decrypted_id);
            $data = [
                'venta' => $venta
            ];
        }
        
        return view('Admin.sale-detail', $data);
    }
}
