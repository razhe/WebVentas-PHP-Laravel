<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)

class DetailProductController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getDetailProduct()
    {
        $categories = DB::select('CALL select_subcategories_join_categories_products()');
        $subcategories = DB::select('CALL select_subcategories_public()');
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories
        ];
        return view('details-product', $data);
    }
}
