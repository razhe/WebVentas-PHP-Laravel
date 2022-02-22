<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Product;
use Config;
class MainController extends Controller
{
    /*
    public function getContentLoadProducts($section)
    {
        switch ($section) {
            case 'home':
                $products = DB::select('CALL select_products_home()');
                break;            
            default:
                # code...
                break;
        }
        $data = [
            'products' => $products,
            'config'   => Config('configuracion-global')
        ];
        return $data;
    }
    */
}
