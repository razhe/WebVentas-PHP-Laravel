<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;
use Config;

class ProductsController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }

    public function getProducts(Request $request)
    {
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        
        $getSubcategory = '';
        if (!empty($_GET['subcategory'])) {
            $getSubcategory = $_GET['subcategory'];
            $products = DB::table('products')
            ->join('brands', 'brands.id', '=', 'products.id_brand')
            ->join('subcategories', 'subcategories.id', '=', 'products.id_subcategory')
            ->select('products.id', 'products.name', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
            ->where('products.status', '1')
            ->where('subcategories.slug', $getSubcategory);

            $subcategoryId = Subcategory::where('slug',$getSubcategory)->get('id');
            $brands = DB::select('CALL select_brands_has_subcategories_catalog(?)',array($subcategoryId[0] -> id));
            
        } else {
            $products = DB::table('products')
            ->join('brands', 'brands.id', '=', 'products.id_brand')
            ->select('products.id', 'products.name', 'products.price', 'products.discount', 'products.slug', 'products.image1', 'brands.name as brand_name')
            ->where('products.status', '1');

            $brands = DB::select('CALL select_brands_catalog()');
        }


        if (!empty($_GET['brand'])) {
            $names = explode(',',$_GET['brand']);
            $brands_ids = Brand::select('id')-> whereIn('name',$names)->pluck('id')->toArray();
            $products= $products-> whereIn('id_brand',$brands_ids);
        }
        if (!empty($_GET['special'])) {
            if ($_GET['special'] == 'mas-vendido') {
                $productsBestSellers = DB::select('CALL select_best_sellers(?)', array(Config::get('configuracion-global.quant_best_sellers_catalog')));
                $diccionario = array();
                for ($i=0; $i < sizeof($productsBestSellers); $i++) { 
                    array_push($diccionario, $productsBestSellers[$i] -> id_product);
                }
                $products = $products -> whereIn('products.id',$diccionario);
            }
            if ($_GET['special'] == 'ofertas') {
                $products= $products-> where('discount','<>','0');
            }
        }
        if(!empty($_GET['sort-by'])){
            $sort = ($_GET['sort-by']);
            if ($sort == 'name-asc') {
                $products = $products
                ->orderBy('products.name','ASC');

            }
            if ($sort == 'name-desc') {
                $products = $products
                ->orderBy('products.name','DESC');
            }
            if ($sort == 'price-asc') {
                $products = $products
                ->orderBy('products.price','ASC');
            }
            if ($sort == 'price-desc') {
                $products = $products
                ->orderBy('products.price','DESC');
            }
        }
        if(!empty($_GET['min-price']) && empty($_GET['max-price'])){
            $products = $products
                ->where('products.price','>',$_GET['min-price'])
                ->paginate(Config('configuracion-global.products_per_page'));
        }
        elseif(empty($_GET['min-price']) && !empty($_GET['max-price'])){
            $products = $products
                ->where('products.price','<',$_GET['max-price'])
                ->paginate(Config('configuracion-global.products_per_page'));
        }
        elseif(!empty($_GET['min-price']) && !empty($_GET['max-price'])){
            $products = $products
                ->where('products.price','>',$_GET['min-price'])
                ->where('products.price','<',$_GET['max-price'])
                ->paginate(Config('configuracion-global.products_per_page'));
        }
        
        else{
            $products = $products
            ->paginate(Config('configuracion-global.products_per_page'));
        } 

        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
            'brands' => $brands,
            'subcategory_slug' => $getSubcategory,
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
    public function postShopFilter(Request $request)
    {
        $data = $request->all();
        $subcategoryUrl ='';
        //subcategory
        if (!empty($_GET['subcategory'])) {
            $subcategoryUrl ='&subcategory='.$_GET['subcategory'];
        }
        //special filter
        $specialUrl = '';
        if (!empty($data['special'])) {
            foreach($data['special'] as $special){
                if (empty($specialUrl)) {
                    $specialUrl .= '&special='.$special;
                }else{
                    $specialUrl .= ','.$special;
                }
            }
        }
        //Brand filter
        $brandUrl = '';

        if (!empty($data['brand'])) {
            foreach($data['brand'] as $brand){
                if (empty($brandUrl)) {
                    $brandUrl .='&brand='.$brand;
                }
                else{
                    $brandUrl .=','.$brand;
                }
            }
        }
        //sort filter
        $sortByUrl='';
        if(!empty($data['sort-by'])){
            $sortByUrl = '&sort-by='.$data['sort-by'];
        }
        //Price filter
        $minPriceRangeUrl = '';
        $maxPriceRangeUrl = '';
        if(!empty($data['min-price'])){
            $minPriceRangeUrl = '&min-price='.$data['min-price'];
        }
        if(!empty($data['max-price'])){
            $maxPriceRangeUrl = '&max-price='.$data['max-price'];
        }
        $rangePriceUrl = $minPriceRangeUrl.$maxPriceRangeUrl;

        return redirect()->route('products',$subcategoryUrl.$brandUrl.$sortByUrl.$rangePriceUrl.$specialUrl);

    }
}
