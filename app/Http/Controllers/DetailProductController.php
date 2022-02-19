<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getDetailProduct()
    {
        return view('details-product');
    }
}
