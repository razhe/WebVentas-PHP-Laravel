<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
class ProductCatalogController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getProducts()
    {
        $categories = DB::select('CALL select_subcategories_join_categories_products()');
        $subcategories = DB::select('CALL select_subcategories_public()');
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories
        ];
        return view('product-catalog', $data);
    }
}
