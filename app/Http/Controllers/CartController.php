<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use App\Models\Product;
use App\Models\Category;
use Session, Config, Toastr;
use Illuminate\Support\Facades\Crypt;

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
        try{
            $decrypted_id = Crypt::decryptString($request['p']);
        }catch(\Exception $exception){
            return view('errors.request-denied');
        }
        $producto = Product::where('id', $decrypted_id) ->get(['id','name','price','discount', 'stock', 'image1']);
        if(Session::has('carrito')):
            $arreglo = session('carrito');
            $encontro = false;
            $numero = 0;
            for ($i=0; $i < sizeof($arreglo); $i++) { //For para encontrar el producto en el carrito
                if(Crypt::decryptString($arreglo[$i]['id']) == $decrypted_id){
                    $encontro=true;
                    $numero=$i;
                }
            }
            if ($encontro == true) {//Encontro el producto
                if (($arreglo[$numero]['cantidad'] + $request['quant']) <= $arreglo[$numero]['stock']) {
                    $arreglo[$numero]['cantidad'] = $arreglo[$numero]['cantidad'] + $request['quant'];
                    $arreglo[$numero]['subtotal'] = round($arreglo[$numero]['cantidad'] * $arreglo[$numero]['precio']);
                    session(['carrito' => $arreglo]);    
                }else{
                    Toastr::warning('La cantidad especificada excede el stock máximo', '¡Atención!');
                    return back();
                }           
            } else {//No lo encontró
                if($producto[0] -> stock > 0){
                    if ($request['quant'] <= $producto[0] -> stock && $request['quant'] > 0) {
                        $nuevoArreglo = [
                            'id'     => Crypt::encryptString($producto[0] -> id),
                            'nombre' => $producto[0] -> name,
                            'precio'    => $producto[0] -> price,
                            'descuento' => $producto[0] -> discount,
                            'imagen' => $producto[0] -> image1,
                            'stock' => $producto[0] -> stock,
                            'cantidad' => $request['quant'],
                            'subtotal' => round($request['quant'] * $producto[0] -> price),

                        ];
                        array_push($arreglo, $nuevoArreglo);
                        session(['carrito' => $arreglo]);
                    }else{
                        Toastr::error('La cantidad especificada no está disponible', '¡Oops...!');
                        return back();
                    }
                }else{
                    Toastr::warning('La cantidad especificada excede el stock máximo', '¡Atención!');
                    return back();
                }
            }
            $this -> getTotalCart();
            return redirect('cart');
        else:
            if($producto[0] -> stock > 0){
                if ($request['quant'] <= $producto[0] -> stock && $request['quant'] > 0) {
                    $arreglo[] = [
                        'id'     => Crypt::encryptString($producto[0] -> id),
                        'nombre' => $producto[0] -> name,
                        'precio'    => $producto[0] -> price,
                        'descuento' => $producto[0] -> discount,
                        'imagen' => $producto[0] -> image1,
                        'stock' => $producto[0] -> stock,
                        'cantidad' => $request['quant'],
                        'subtotal' => round($request['quant'] * $producto[0] -> price),
                    ];
                    session(['carrito' => $arreglo]);
                    $this -> getTotalCart();
                }else{
                    Toastr::error('La cantidad especificada no está disponible', '¡Oops...!');
                    return back();
                }
            }else{
                Toastr::warning('La cantidad especificada excede el stock máximo', '¡Atención!');
                return back();
            }
            return redirect('cart');
        endif; 
    }

    public function getCartUpdate(Request $request){
        $arregloCarrito = session('carrito');
        $encontro = false;
        $numero = 0;
        try{
            $decrypted_id = Crypt::decryptString($request['codigo']);
        }catch(\Exception $exception){
            return view('errors.request-denied');
        }
        for ($i=0; $i < sizeof($arregloCarrito); $i++) { //For para encontrar el producto en el carrito
            if(Crypt::decryptString($arregloCarrito[$i]['id']) == $decrypted_id){
                $encontro = true;
                $numero = $i;
            }
        }
        if ($encontro == true) {//Encontro el producto
            if (($request['cantidad']) <= $arregloCarrito[$numero]['stock'] && ($request['cantidad']) > 0) {
                $arregloCarrito[$numero]['cantidad'] = $request['cantidad'];
                $arregloCarrito[$numero]['subtotal'] = round($arregloCarrito[$numero]['cantidad'] * $arregloCarrito[$numero]['precio']);
                session(['carrito' => $arregloCarrito]);
                $this -> getTotalCart();    
            }else{
                Toastr::error('La cantidad especificada no está disponible', '¡Oops...!');
                return back();
            }       
        }
    }

    public function getTotalCart(){
        $arregloCarrito = session('carrito');
        $totalNeto = 0;
        $cantidadTotal = 0;
        for ($i=0; $i < sizeof($arregloCarrito); $i++) {
            $totalNeto += $arregloCarrito[$i]['subtotal'];
            $cantidadTotal++;
        }
        $iva = round($totalNeto * (Config('configuracion-global.iva') / 100));
        $total = $totalNeto + $iva;
        $arreglo[] = [
            'total_neto' => $totalNeto,
            'iva' => $iva,
            'total' => $total,
            'cantidadProductos'=> $cantidadTotal,
        ];
        
        session(['totalCarrito' => $arreglo]);
    }
    public function getCartRemove(Request $request)
    {
        $carrito = session('carrito');
        $encontro = false;
        $numero = 0;
        
        try{
            $decrypted_id = Crypt::decryptString($request['codigo']);
        }catch(\Exception $exception){
            return view('errors.request-denied');
        }

        for ($i=0; $i < sizeof($carrito); $i++) { //For para encontrar el producto en el carrito
            if(Crypt::decryptString($carrito[$i]['id']) == $decrypted_id){
                $encontro = true;
                $numero = $i;
            }
        }
        if (empty($carrito)) {
            session()->forget('carrito');
            session()->forget('totalCarrito');
        } else {
            if ($encontro == true) {//Encontro el producto
                unset($carrito[$numero]);         
            }
            session(['carrito' => $carrito]);
            $this -> getTotalCart();
        }
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

