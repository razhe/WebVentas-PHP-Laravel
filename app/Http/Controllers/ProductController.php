<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getDetailProduct()
    {
        return view('details-product');
    }
}
