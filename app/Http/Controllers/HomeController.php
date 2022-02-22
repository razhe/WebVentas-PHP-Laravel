<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
class HomeController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getHome()
    {
        $categories = DB::select('CALL select_subcategories_join_categories_products()');
        $subcategories = DB::select('CALL select_subcategories_public()');
        $products = DB::select('CALL select_products_home()');
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ];
        //dd($data);
        return view('home', $data);
    }
}
