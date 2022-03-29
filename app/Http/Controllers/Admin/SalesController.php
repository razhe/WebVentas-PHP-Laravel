<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Pago;
use App\Models\Order_has_products;
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
            $actualizarVenta = Order::where('id', $decrypted_id) -> first();
            if($actualizarVenta->opened == 0){
                $actualizarVenta -> opened = true;
                $actualizarVenta -> save();
            }
            
            $venta = Order::where('id', $decrypted_id) -> get();
            
            $pago = Pago::where('id', $venta[0] -> id_pago) -> get();
            $Order_has_products = Order_has_products::where('id', $venta[0] -> id) -> get();

            $data = [
                'ventas' => $venta,
                'pagos' => $pago,
                'Order_has_products' => $Order_has_products,
            ];
        }
        
        return view('Admin.sale-detail', $data);
    }
}
