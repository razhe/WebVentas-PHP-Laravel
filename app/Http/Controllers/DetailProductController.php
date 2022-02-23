<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Product;

class DetailProductController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getDetailProduct(Request $request)
    {
        $categories = DB::select('CALL select_subcategories_join_categories_products()');
        $subcategories = DB::select('CALL select_subcategories_public()');
        $product = DB::select('CALL select_detail_product(?,?)', array($request['selected'], $request['product']));
        //$productos = Product::where('slug','=' ,$request['product']) -> where('id', $request['selected']) -> get(['id','name','price','discount','description','stock','slug']);
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'product' => $product,
        ];
        //return $productos;
        return view('details-product', $data);
    }
}
