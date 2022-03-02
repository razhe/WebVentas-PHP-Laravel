<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Config;

class ProductsController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getProducts()
    {
        $brands = DB::select('CALL select_brands_catalog()');
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
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
            'brands' => $brands,
        ];
        
        return view('products', $data);
    }
    public function getProductsBySubcat($subcategory)
    {
        $products = DB::table('products')
            ->join('brands', 'brands.id', '=', 'products.id_brand')
            ->join('subcategories', 'subcategories.id', '=', 'products.id_subcategory')
            ->select('products.id', 'products.name', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
            ->where('products.status', '1')
            ->where('subcategories.slug', $subcategory)
            ->paginate(Config('configuracion-global.products_per_page'));
        
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        $brands = DB::select('CALL select_brands_catalog()');
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
            'brands' => $brands,
        ];
        return view('products', $data);
    }
    public function postSearchProducts(Request $request)
    {
        $search = preg_replace("/[^A-Za-z0-9 ]/", '', $request['search']);
        $products = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.id_brand')
        ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
        ->where('products.name', 'like', '%'.e($search).'%')
        ->orWhere('products.description', 'like', '%'.e($search).'%')
        ->where('products.status', '1')
        ->paginate(Config('configuracion-global.products_per_page'));

        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');

        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ];

        return view('product-search', $data);
    }
}
