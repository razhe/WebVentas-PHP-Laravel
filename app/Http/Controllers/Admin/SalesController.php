<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Pago;
use App\Models\Boleta;
use App\Models\Factura;
use App\Models\Order_has_products;
use Illuminate\Support\Facades\Crypt;

use Validator, DB, Toastr;

//Correos
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderDetailsFromAdmin;

class SalesController extends Controller
{
    public function __construct()
    {
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
        $this -> middleware('purchase.step-process');
    }
    public function getSales()
    {
        $ventas = Order::orderBy('fecha', 'DESC')->get();
        $metrics = DB::select('CALL select_metrics_sales()');
        $data = [
            'ventas' => $ventas,
            'metrics' => $metrics
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
            if ($venta[0] -> id_boleta != null) {
                $documento = Boleta::where('id', $venta[0] -> id_boleta) -> get();
            }else{
                $documento = Factura::where('id', $venta[0] -> id_factura) -> get();
            }

            $pago = Pago::where('id', $venta[0] -> id_pago) -> get();
            $Order_has_products = Order_has_products::where('id', $venta[0] -> id) -> get();

            $data = [
                'ventas' => $venta,
                'pagos' => $pago,
                'Order_has_products' => $Order_has_products,
                'detalles_documento' => $documento,
            ];
        }
        
        return view('Admin.sale-detail', $data);
    }
    public function postChangeOrderStatusWebPay(Request $request)
    {
        if(!empty($request['cv']) && !empty($request['order_status'])){
            try{
                $decrypted_id = Crypt::decryptString($request['cv']);
            }catch(\Exception $exception){
                return view('errors.request-denied');
            }
            if($request['order_status'] == 1 || $request['order_status'] == 2 || $request['order_status'] == 3 || $request['order_status'] == 4 || $request['order_status'] == 5){
                $orden = Order::where('id',$decrypted_id) -> first();
                if($orden -> status == 1 && $request['order_status'] != 5){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                if($orden -> status == 2 && $request['order_status'] < 2 && $request['order_status'] > 5){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                if($orden -> status == 3 && $request['order_status'] < 2 && $request['order_status'] > 5){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                if($orden -> status == 4 && $request['order_status'] < 2 && $request['order_status'] > 4){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                $orden -> status = e($request['order_status']);
                $orden -> save();
                Toastr::success('El estado de la orden se ha actualizado correctamente', '¡Todo Listo!');
                return back();
            }else{
                Toastr::error('Petición denegada', '¡Oops...!');
                return back();
            }
        }else{
            return back();
        }
    }
    public function postChangeOrderStatusBankTransfer(Request $request)
    {
        if(!empty($request['cv']) && !empty($request['order_status'])){
            try{
                $decrypted_id = Crypt::decryptString($request['cv']);
            }catch(\Exception $exception){
                return view('errors.request-denied');
            }
            if($request['order_status'] == 1 || $request['order_status'] == 2 || $request['order_status'] == 3 || $request['order_status'] == 4 || $request['order_status'] == 5){
                $orden = Order::where('id',$decrypted_id) -> first();
                if($orden -> status == 1 && $request['order_status'] != 5 && $request['order_status'] != 2 ){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                if($orden -> status == 2 && $request['order_status'] < 2 && $request['order_status'] > 5){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                if($orden -> status == 3 && $request['order_status'] < 3 && $request['order_status'] > 5){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                if($orden -> status == 4 && $request['order_status'] < 3 && $request['order_status'] > 4){
                    Toastr::error('Petición denegada', '¡Oops...!');
                    return back();
                    exit;
                }
                //Se se autorizo la orden
                if ($request['order_status'] == 2) {
                    if (!empty($request['cv'])) {
                        try{
                            $decrypted_id = Crypt::decryptString($request['cv']);
                        }catch(\Exception $exception){
                            return view('errors.request-denied');
                        }

                        $venta = Order::where('id', $decrypted_id) -> get();
                        if ($venta[0] -> id_boleta != null) {
                            $documento = Boleta::where('id', $venta[0] -> id_boleta) -> get();
                        }else{
                            $documento = Factura::where('id', $venta[0] -> id_factura) -> get();
                        }
            
                        $pago = Pago::where('id', $venta[0] -> id_pago) -> get();
                        $pago -> estado_pago = 'CONFIRMED';
                        $pago -> save();

                        $Order_has_products = Order_has_products::where('id', $venta[0] -> id) -> get();
                        
                        
                        $data = [
                            'ventas' => $venta,
                            'pagos' => $pago,
                            'Order_has_products' => $Order_has_products,
                            'detalles_documento' => $documento,
                        ];
                        Mail::to($documento[0] -> email)->send(new SendOrderDetailsFromAdmin($data));
                    }else{
                        Toastr::error('Falta un parámetro para completar esta acción', 'Oops...');
                        return back();
                    }
                }
                $orden -> status = e($request['order_status']);
                $orden -> save();
                Toastr::success('El estado de la orden se ha actualizado correctamente', '¡Todo Listo!');
                return back();
            }else{
                Toastr::error('Petición denegada', '¡Oops...!');
                return back();
            }
        }else{
            return back();
        }
    }
}
