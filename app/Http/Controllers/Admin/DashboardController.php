<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getDashboard(){
        $metricas_ventas = DB::select('CALL select_metrics_on_dashboard_ventas()');
        $metricas_usuarios = DB::select('CALL select_metrics_on_dashboard_usuarios()');
        $data = [
            'metricasVentas' => $metricas_ventas,
            'metricasUsuarios' => $metricas_usuarios,
        ];
        return view('Admin.dashboard', $data);
    }
}
