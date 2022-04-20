<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class DashboardController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
        $this -> middleware('purchase.step-process');
    }
    public function getDashboard(){
        $metricas_ventas = DB::select('CALL select_metrics_on_dashboard_ventas()');
        $metricas_usuarios = DB::select('CALL select_metrics_on_dashboard_usuarios()');
        $order = Order::where('status', '2') -> orderBy('fecha', 'DESC') -> take(6) -> get(['id','total', 'opened', 'order_number', 'fecha']);
        $data = [
            'metricasVentas' => $metricas_ventas,
            'metricasUsuarios' => $metricas_usuarios,
            'ordenes' => $order,    
        ];
        return view('Admin.dashboard', $data);
    }
    public function getSalesPerYear($year)
    {
        $data = DB::select('CALL select_sales_per_month(?)', array($year));
        return response() ->json($data) ;
        
    }
    public function getProductsSoldPerYear($year)
    {
        $data = DB::select('CALL select_products_sold(?)', array($year));
        return response() ->json($data) ;
    }
}
