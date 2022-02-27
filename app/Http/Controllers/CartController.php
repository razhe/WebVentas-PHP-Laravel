<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Product;
use App\Models\Category;
use Session, Config;

class CartController extends Controller
{
    public function __Construct(){
        $this-> middleware('user.status');
    }
    public function getCart()
    {
        $categories = Category::where('categories.status', '=', '1') -> orderBy('on_display', 'DESC') -> get(['name']);
        $subcategories = DB::select('CALL select_subcategories_public()');
        $data = 
        [
            'categories' => $categories,
            'subcategories' => $subcategories
        ];
        return view('cart', $data);
    }
    public function postAddToCart(Request $request)
    {
        $producto = Product::where('slug', $request['product']) ->get(['id','name','price','discount', 'stock', 'image1']);
        //$request->session()->forget('carrito');
        if(Session::has('carrito')):
            $arreglo = session('carrito');
            $encontro = false;
            $numero = 0;
            for ($i=0; $i < sizeof($arreglo); $i++) { //For para encontrar el producto en el carrito
                if($arreglo[$i]['id'] == $request['selected']){
                    $encontro=true;
                    $numero=$i;
                }
            }
            if ($encontro == true) {//Encontro el producto
                if (($arreglo[$numero]['cantidad'] + $request['quant']) < $arreglo[$numero]['stock']) {
                    $arreglo[$numero]['cantidad'] = $arreglo[$numero]['cantidad'] + $request['quant'];
                    $arreglo[$numero]['subtotal'] = $arreglo[$numero]['cantidad'] * $arreglo[$numero]['precio'];
                    session(['carrito' => $arreglo]);    
                }           
            } else {//No lo encontró
                if($producto[0] -> stock > 0){
                    if ($request['quant'] < $producto[0] -> stock && $request['quant'] > 0) {
                        $nuevoArreglo = [
                            'id'     => $producto[0] -> id,
                            'nombre' => $producto[0] -> name,
                            'precio'    => $producto[0] -> price,
                            'descuento' => $producto[0] -> discount,
                            'imagen' => $producto[0] -> image1,
                            'stock' => $producto[0] -> stock,
                            'cantidad' => $request['quant'],
                            'subtotal' => $request['quant'] * $producto[0] -> price,

                        ];
                        array_push($arreglo, $nuevoArreglo);
                        session(['carrito' => $arreglo]);
                    }
                }
            }
            $this -> getTotalCart();
            return redirect('cart');
        else:
            if($producto[0] -> stock > 0){
                if ($request['quant'] < $producto[0] -> stock && $request['quant'] > 0) {
                    $arreglo[] = [
                        'id'     => $producto[0] -> id,
                        'nombre' => $producto[0] -> name,
                        'precio'    => $producto[0] -> price,
                        'descuento' => $producto[0] -> discount,
                        'imagen' => $producto[0] -> image1,
                        'stock' => $producto[0] -> stock,
                        'cantidad' => $request['quant'],
                        'subtotal' => $request['quant'] * $producto[0] -> price,
                    ];
                    session(['carrito' => $arreglo]);
                    $this -> getTotalCart();
                }
            }
            return redirect('cart');
        endif; 
    }

    public function getCartUpdate(Request $request){
        $arregloCarrito = session('carrito');
        $encontro = false;
        $numero = 0;
        for ($i=0; $i < sizeof($arregloCarrito); $i++) { //For para encontrar el producto en el carrito
            if($arregloCarrito[$i]['id'] == $request['codigo']){
                $encontro = true;
                $numero = $i;
            }
        }
        if ($encontro == true) {//Encontro el producto
            if (($request['cantidad']) <= $arregloCarrito[$numero]['stock'] && ($request['cantidad']) > 0) {
                $arregloCarrito[$numero]['cantidad'] = $request['cantidad'];
                $arregloCarrito[$numero]['subtotal'] = $arregloCarrito[$numero]['cantidad'] * $arregloCarrito[$numero]['precio'];
                session(['carrito' => $arregloCarrito]);
                $this -> getTotalCart();    
            }           
        }
    }

    public function getTotalCart(){
        $arregloCarrito = session('carrito');
        $totalNeto = 0;
        for ($i=0; $i < sizeof($arregloCarrito); $i++) {
            $totalNeto += $arregloCarrito[$i]['subtotal'];
        }
        $iva = $totalNeto * (Config('configuracion-global.iva') / 100);
        $total = $totalNeto + $iva;
        $arreglo[] = [
            'total_neto' => $totalNeto,
            'iva' => $iva,
            'total' => $total,
        ];
        session(['totalCarrito' => $arreglo]);
    }

    public function getListCart()
    {
        //Actualizar el total del carrito
        $data = [
            'carrito' => session('carrito'),
            'totalCarrito' => session('totalCarrito'),
        ];
        return response($data);
    }
}
