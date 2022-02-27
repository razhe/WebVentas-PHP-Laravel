<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Category;
use Config;
class ProductCatalogController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getProducts()
    {
        $categories =  Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        $products = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.id_brand')
        ->select('products.id', 'products.name', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
        ->where('products.status', '1')
        ->paginate(Config('configuracion-global.products_per_page'));
        
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ];
        return view('product-catalog', $data);
    }
    public function postSearchItem(Request $request)
    {
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        if($request['item'] != null):
            $search_item = preg_replace("/[^A-Za-z0-9 ]/", '', $request['item']);
            $products = DB::table('products')
            ->join('brands', 'brands.id', '=', 'products.id_brand')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
            ->where('products.name', 'like', '%'.e($search_item).'%')
            ->orWhere('products.description', 'like', '%'.e($search_item).'%')
            ->where('products.status', '1')
            ->paginate(Config('configuracion-global.products_per_page'));
        else:
            $products = DB::table('products')
            ->join('brands', 'brands.id', '=', 'products.id_brand')
            ->select('products.id', 'products.name', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
            ->where('products.status', '1')
            ->paginate(Config('configuracion-global.products_per_page'));
        endif;
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ];
        
        
        return view('product-catalog', $data);
    }
}
