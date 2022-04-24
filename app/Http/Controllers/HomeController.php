<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Brand;
use Config;
class HomeController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
        $this -> middleware('purchase.step-process');
    }
    public function getHome()
    {
        $categories = DB::select('CALL select_subcategories_join_categories_products()');
        $subcategories = DB::select('CALL select_subcategories_public()');
        $products = DB::select('CALL select_products_home()');
        $productsBestSellers = DB::select('CALL select_best_sellers(?)', array(Config::get('configuracion-global.quant_best_sellers_home')));
        $brands = Brand::where('status','1')->get(['name','image']);
        $diccionario = array();
        for ($i=0; $i < sizeof($productsBestSellers); $i++) { 
            array_push($diccionario, $productsBestSellers[$i] -> id_product);
        }
        
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
            'diccionario' => $diccionario,
            'brands' => $brands,
        ];
        //dd($data);
        return view('home', $data);
    }
}
