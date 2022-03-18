<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Product;
use App\Models\Category;
use Hash;
use Illuminate\Support\Facades\Crypt;
class DetailProductController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getDetailProduct(Request $request)
    {
        $slug = isset($_GET['s']) ? $_GET['s'] : '';
        if($slug == ''){
            return view('errors.request-denied');
        }else{
            try{
                $decrypted_slug = Crypt::decryptString($slug);
            }catch(\Exception $exception){
                return view('errors.request-denied');
            }
            
            $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
            $subcategories = DB::select('CALL select_subcategories_public()');
            $product = DB::select('CALL select_detail_product(?)', array($decrypted_slug));

            $data = 
            [
                'categories' => $categories,
                'subcategories' => $subcategories,
                'product' => $product,
            ];
            return view('details-product', $data);
            
        }
    }
}
