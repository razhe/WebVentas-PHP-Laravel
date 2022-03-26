<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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
        $ventas = Order::get();
        $data = [
            'ventas' => $ventas
        ];
        return view('Admin.sales', $data);
    }
}
