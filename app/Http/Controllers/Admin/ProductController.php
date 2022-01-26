<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
    }
    public function getProducts(){
        return view('Admin.products');
    }
    public function postAddProduct(){
        return 'Agregado!';
    }
}
