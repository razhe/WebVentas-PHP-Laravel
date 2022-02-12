<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function getProducts()
    {
        return view('product-catalog');
    }
}
