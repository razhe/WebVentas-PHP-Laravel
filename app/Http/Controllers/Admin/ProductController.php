<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator, File, DB, Toastr, Crypt;
//Paquete intervention images
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getProducts(){
        $products=DB::select('CALL select_products()');
        $metrics=DB::select('CALL select_metrics_products()');
        
        $productsArray=[
            'products'=> $products,'metrics' => $metrics
        ];

        return view('Admin.products',$productsArray);
    }
    public function getFindProduct($id)
    {
        $products = Product::findOrFail($id);
        return response()->json($products);   
    }
    public function postRemoveProduct(Request $request)
    {
        if (!empty($request['id'])) {
            try {
                $decrypted_id = Crypt::decryptString($request['id']);
            } catch(\Exception $exception){
                return view('errors.request-denied');
            }
            $product = Product::findOrFail($decrypted_id);
            $product -> status = '3';
            if ($product -> save()) {
                Toastr::success('Producto eliminado con Éxito', '¡Todo Listo!');
                return back();
            }
        }
        
    }
    public function postAddProduct(Request $request){
        $rules = 
        [
            'name'     => 'required',
            'price'    => 'required|numeric',
            'id_brand' => 'required|numeric',
            'stock'    => 'required|numeric',
            'sku'      => 'required',
            'slug'      => 'required|unique:products,slug',
            'status'   => 'required|numeric',
            'id_subcategory'   => 'required|numeric',
            'description'      => 'required',
            'image1'      => 'required|image',
            'image2'      => 'required|image',
            'image3'      => 'required|image',
            'image4'      => 'required|image',
        ];
        $messages =
        [
            'name.required'           => 'Se requiere de un nombre para el producto.',
            'status.required'         => 'Se requiere de un estado para el producto.',
            'status.numeric'          => 'Error al intentar ingresar una subcategoría.',
            'id_subcategory.required' => 'Se requiere de una categoría padre para la Subcategoría.',
            'sku.required'            => 'Se requiere del SKU del producto.',
            'slug.required'            => 'Se requiere del Slug del producto.',
            'slug.unique'            => 'Se requiere que el Slug del producto sea único.',
            'id_subcategory.numeric'  => 'Error al intentar ingresar una subcategoría',
            'id_brand.required'       => 'Se requiere un certificado para el producto.',
            'id_brand.numeric'        => 'Se requiere un certificado para el producto.',
            'price.required'          => 'Se requiere de un precio para el producto.',
            'price.numeric'           => 'El precio debe contener caracteres numéricos.',
            'description.required'    => 'El precio debe contener caracteres numéricos.',
            'stock.required'          => 'Se requiere del stock del producto.',
            'stock.numeric'           => 'El stock debe contener SOLO caracteres numéricos.',
            'image1.required'  => 'Se necesita la primera imagen secundaria para esta subcategoría.',
            'image2.required'  => 'Se necesita la segunda imagen secundaria para esta subcategoría.',
            'image3.required'  => 'Se necesita la tercera imagen secundaria para esta subcategoría.',
            'image4.required'  => 'Se necesita la cuarta imagen secundaria para esta subcategoría.',
            'image1.image'  => 'El archivo adjunto en la imagen uno, no es una imagen.',
            'image2.image'  => 'El archivo adjunto en la imagen dos, no es una imagen.',
            'image3.image'  => 'El archivo adjunto en la imagen uno, tres es una imagen.',
            'image4.image'  => 'El archivo adjunto en la imagen uno, cuatro es una imagen.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una subcategoría')->with( 'typealert', 'danger');
        else:
            //Ruta
            $pathImg     = 'img/products/';
            $pathDocs    = 'docs/products/';
            //Peticiones
            $fileDoc     = $request->file('certificate');
            $fileImg1    = $request->file('image1');
            $fileImg2    = $request->file('image2');
            $fileImg3    = $request->file('image3');
            $fileImg4    = $request->file('image4');

            //Nombres
            $file_certificate = time().'-'.$fileDoc->getClientOriginalName();
            $file_img1        = time().'-'.$fileImg1->getClientOriginalName();
            $file_img2        = time().'-'.$fileImg2->getClientOriginalName();
            $file_img3        = time().'-'.$fileImg3->getClientOriginalName();
            $file_img4        = time().'-'.$fileImg4->getClientOriginalName();

            $upload_file1 = ($pathImg. $file_img1);
            $upload_file2 = ($pathImg. $file_img2);
            $upload_file3 = ($pathImg. $file_img3);
            $upload_file4 = ($pathImg. $file_img4);

            $fileDoc -> move($pathDocs, $file_certificate);
            //mover la imagen con el paquete intervention image
            Image::make($fileImg1)
            -> resize(650, null, function ($constraint) {
                $constraint->aspectRatio();
            }) 
            -> save($upload_file1);

            Image::make($fileImg2)
            -> resize(650, null, function ($constraint) {
                $constraint->aspectRatio();
            }) 
            -> save($upload_file2);

            Image::make($fileImg3)
            -> resize(650, null, function ($constraint) {
                $constraint->aspectRatio();
            }) 
            -> save($upload_file3);

            Image::make($fileImg4)
            -> resize(650, null, function ($constraint) {
                $constraint->aspectRatio();
            }) 
            -> save($upload_file4);
            
            $product = new Product;

            $product->name           = e($request['name']);
            $product->price          = e($request['price']);
            if ($request['discount'] == '') {
                $product->discount = e(0);
            }else {
                $product->discount       = e($request['discount']);
            }
            $product->description    = $request['description'];
            $product->stock          = e($request['stock']);
            $product->sku            = e($request['sku'].time());
            $product->slug            = e($request['slug']);
            $product->status         = e($request['status']);
            $product->image1         = $pathImg.$file_img1;
            $product->image2         = $pathImg.$file_img2;
            $product->image3         = $pathImg.$file_img3;
            $product->image4         = $pathImg.$file_img4;
            $product->certificate    = $pathDocs.$file_certificate;
            $product->id_brand       = e($request['id_brand']);
            $product->id_subcategory = e($request['id_subcategory']);
            if ($product -> save()):
                Toastr::success('Producto guardado con Éxito', '¡Todo Listo!');
                return back();
            endif;
        endif;
    }
    public function postEditProduct(Request $request)
    {
        $rules = 
        [
            'name'     => 'required',
            'price'    => 'required|numeric',
            'id_brand' => 'required|numeric',
            'stock'    => 'required|numeric',
            'sku'      => 'required',
            'slug'      => 'required',
            'status'   => 'required|numeric',
            'id_subcategory'   => 'required|numeric',
            'description'      => 'required',
            'image1'      => 'image',
            'image2'      => 'image',
            'image3'      => 'image',
            'image4'      => 'image',
        ];
        $messages =
        [
            'name.required'           => 'Se requiere de un nombre para el producto.',
            'status.required'         => 'Se requiere de un estado para el producto.',
            'status.numeric'          => 'Error al intentar ingresar una subcategoría.',
            'id_subcategory.required' => 'Se requiere de una categoría padre para la Subcategoría.',
            'sku.required'            => 'Se requiere del SKU del producto.',
            'slug.required'            => 'Se requiere del Slug del producto.',
            'id_subcategory.numeric'  => 'Error al intentar ingresar una subcategoría',
            'id_brand.required'       => 'Se requiere un certificado para el producto.',
            'id_brand.numeric'        => 'Se requiere un certificado para el producto.',
            'price.required'          => 'Se requiere de un precio para el producto.',
            'price.numeric'           => 'El precio debe contener caracteres numéricos.',
            'description.required'    => 'El precio debe contener caracteres numéricos.',
            'stock.required'          => 'Se requiere del stock del producto.',
            'stock.numeric'           => 'El stock debe contener SOLO caracteres numéricos.',
            'image1.image'  => 'El archivo adjuntado en la imagen uno, no es una imagen.',
            'image2.image'  => 'El archivo adjuntado en la imagen dos, no es una imagen.',
            'image3.image'  => 'El archivo adjuntado en la imagen uno, tres es una imagen.',
            'image4.image'  => 'El archivo adjuntado en la imagen uno, cuatro es una imagen.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar este producto')->with( 'typealert', 'danger');
        else:
            //Ruta
            $pathImg     = 'img/products/';
            $pathDocs    = 'docs/products/';
            
            $product = Product::findOrFail($request['id']);
            if ($request['name'] != $product->name) {
                $product->name = e($request['name']);
            }
            if ($request['price'] != $product->price) {
                $product->price = e($request['price']);
            }
            
            if ($request['discount'] == '') {
                $product->discount = e(0);
            }else {
                $product->discount = e($request['discount']);
            }
            if ($request['description'] != $product->description) {
                $product->description = $request['description'];
            }
            if ($request['stock'] != $product->stock) {
                $product->stock = e($request['stock']);
            }
            if ($request['sku'] != $product->sku) {
                $product->sku = e($request['sku'].time());
            }
            if ($request['slug'] != $product->slug) {
                $product->slug = $request['slug'];
            }
            if ($request['status'] != $product->status) {
                $product->status = e($request['status']);
            }
            if ($request['id_brand'] != $product->id_brand) {
                $product->id_brand = e($request['id_brand']);
            }
            if ($request['id_subcategory'] != $product->id_subcategory) {
                $product->id_subcategory = e($request['id_subcategory']);
            }
            if ($request->hasFile('certificate')) {
                //peticion
                $fileDoc     = $request->file('certificate');
                //nombre
                $file_certificate   = time().'-'.$fileDoc->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($product -> certificate);
                $product -> certificate  = $pathDocs.$file_certificate;
                //Moviendo a la carpeta
                $fileDoc -> move($pathDocs, $file_certificate);
            }
            if ($request->hasFile('image1')) {
                //peticion
                $fileImg1    = $request->file('image1');
                //nombre
                $file_img1   = time().'-'.$fileImg1->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($product -> image1);
                $product -> image1  = $pathImg.$file_img1;
                //Creacion del archivo con el nombre y ruta
                $upload_file1 = ($pathImg. $file_img1);
                //mover la imagen con el paquete intervention image
                Image::make($fileImg1)
                -> resize(650, null, function ($constraint) {
                    $constraint->aspectRatio();
                }) 
                -> save($upload_file1);
            }
            if ($request->hasFile('image2')) {
                //peticion
                $fileImg2    = $request->file('image2');
                //nombre
                $file_img2   = time().'-'.$fileImg2->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($product -> image2);
                $product -> image2  = $pathImg.$file_img2;
                //Creacion del archivo con el nombre y ruta
                $upload_file2 = ($pathImg. $file_img2);
                //mover la imagen con el paquete intervention image
                Image::make($fileImg2)
                -> resize(650, null, function ($constraint) {
                    $constraint->aspectRatio();
                }) 
                -> save($upload_file2);
            }
            if ($request->hasFile('image3')) {
                //peticion
                $fileImg3    = $request->file('image3');
                //nombre
                $file_img3   = time().'-'.$fileImg3->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($product -> image3);
                $product -> image3  = $pathImg.$file_img3;
                //Creacion del archivo con el nombre y ruta
                $upload_file3 = ($pathImg. $file_img3);
                //mover la imagen con el paquete intervention image
                Image::make($fileImg3)
                -> resize(650, null, function ($constraint) {
                    $constraint->aspectRatio();
                }) 
                -> save($upload_file3);
            }
            if ($request->hasFile('image4')) {
                //peticion
                $fileImg4    = $request->file('image4');
                //nombre
                $file_img4   = time().'-'.$fileImg4->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($product -> image4);
                $product -> image4  = $pathImg.$file_img4;
                //Creacion del archivo con el nombre y ruta
                $upload_file4 = ($pathImg. $file_img4);
                //mover la imagen con el paquete intervention image
                Image::make($fileImg4)
                -> resize(650, null, function ($constraint) {
                    $constraint->aspectRatio();
                }) 
                -> save($upload_file4);
            }

            if ($product -> save()):
                Toastr::success('Producto modificado con Éxito', '¡Todo Listo!');
                return back();
            endif;
        endif;   
    }
}
