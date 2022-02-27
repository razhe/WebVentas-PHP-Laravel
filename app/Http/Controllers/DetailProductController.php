<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Product;
use App\Models\Category;
use Hash;

class DetailProductController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getDetailProduct(Request $request)
    {
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        $product = DB::select('CALL select_detail_product(?)', array($request['product']));

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
